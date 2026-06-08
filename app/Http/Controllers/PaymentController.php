<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\Ticket;
use App\Models\Event;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;

class PaymentController extends Controller
{
    public function __construct()
    {
        Config::$serverKey    = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized  = config('midtrans.is_sanitized');
        Config::$is3ds        = config('midtrans.is_3ds');
    }

    /**
     * Dipanggil via AJAX dari detail.blade.php saat tombol "Beli Tiket" ditekan.
     * Membuat Order + Snap Token lalu mengembalikan token ke frontend.
     */
    public function createSnapToken(Request $request, Event $event)
    {
        $request->validate([
            'ticket_type' => 'required|string',
            'quantity'    => 'required|integer|min:1',
            'price'       => 'required|numeric|min:0',
        ]);

        $user        = auth()->user();
        $quantity    = (int) $request->quantity;
        $price       = (float) $request->price;
        $totalAmount = $price * $quantity;
        $orderCode   = Order::generateOrderCode();

        // Buat order dengan status pending
        $order = Order::create([
            'user_id'          => $user->id,
            'event_id'         => $event->id,
            'order_code'       => $orderCode,
            'ticket_type'      => $request->ticket_type,
            'quantity'         => $quantity,
            'price_per_ticket' => $price,
            'total_amount'     => $totalAmount,
            'status'           => 'pending',
            'expired_at'       => now()->addHours(24),
        ]);

        // Parameter Midtrans
        $params = [
            'transaction_details' => [
                'order_id'     => $orderCode,
                'gross_amount' => (int) $totalAmount,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email'      => $user->email,
            ],
            'item_details' => [
                [
                    'id'       => $request->ticket_type,
                    'price'    => (int) $price,
                    'quantity' => $quantity,
                    'name'     => $event->name . ' - ' . $request->ticket_type,
                ],
            ],
            'callbacks' => [
                'finish'  => route('payment.success'),
                'unfinish'=> route('payment.failed'),
                'error'   => route('payment.failed'),
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);

            $order->update(['snap_token' => $snapToken]);

            return response()->json([
                'snap_token' => $snapToken,
                'order_id'   => $order->id,
            ]);
        } catch (\Exception $e) {
            $order->update(['status' => 'failed']);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Dipanggil via AJAX setelah Snap popup berhasil (onSuccess callback).
     * Generate tiket digital dan ubah status order → paid.
     */
    public function handleSuccess(Request $request)
    {
        $request->validate([
            'order_id'       => 'required|integer',
            'transaction_id' => 'required|string',
            'payment_type'   => 'required|string',
        ]);

        $order = Order::where('id', $request->order_id)
                      ->where('user_id', auth()->id())
                      ->firstOrFail();

        // Jika sudah diproses sebelumnya, langsung kembalikan sukses
        if ($order->status === 'paid') {
            return response()->json(['success' => true, 'already_paid' => true]);
        }

        // Update order
        $order->update([
            'status'         => 'paid',
            'transaction_id' => $request->transaction_id,
            'payment_type'   => $request->payment_type,
            'paid_at'        => now(),
        ]);

        // Generate tiket digital sebanyak quantity
        $tickets = [];
        for ($i = 0; $i < $order->quantity; $i++) {
            $qrCode = strtoupper(Str::random(12)); // kode unik untuk QR

            $ticket = Ticket::create([
                'user_id'       => $order->user_id,
                'event_id'      => $order->event_id,
                'order_id'      => $order->id,
                'ticket_type'   => $order->ticket_type,
                'status'        => 'Active',
                'purchase_date' => now(),
                'qr_code'       => $qrCode,
            ]);

            $tickets[] = $ticket;
        }

        return response()->json([
            'success'    => true,
            'order_code' => $order->order_code,
            'tickets'    => $tickets,
        ]);
    }

    /**
     * Webhook dari server Midtrans (tanpa auth, via CSRF exception).
     * Menangani notifikasi pembayaran secara server-to-server.
     */
    public function notification(Request $request)
    {
        try {
            $notification = new Notification();

            $orderId           = $notification->order_id;
            $transactionStatus = $notification->transaction_status;
            $fraudStatus       = $notification->fraud_status;
            $paymentType       = $notification->payment_type;
            $transactionId     = $notification->transaction_id;

            $order = Order::where('order_code', $orderId)->first();

            if (!$order) {
                return response()->json(['message' => 'Order not found'], 404);
            }

            // Tentukan status berdasarkan notifikasi Midtrans
            if ($transactionStatus === 'capture') {
                $status = ($fraudStatus === 'accept') ? 'paid' : 'failed';
            } elseif ($transactionStatus === 'settlement') {
                $status = 'paid';
            } elseif (in_array($transactionStatus, ['cancel', 'deny', 'expire'])) {
                $status = $transactionStatus === 'expire' ? 'expired' : 'failed';
            } elseif ($transactionStatus === 'pending') {
                $status = 'pending';
            } else {
                $status = 'failed';
            }

            $order->update([
                'status'         => $status,
                'transaction_id' => $transactionId,
                'payment_type'   => $paymentType,
                'paid_at'        => $status === 'paid' ? now() : null,
            ]);

            // Jika paid dan belum ada tiket, generate tiket
            if ($status === 'paid' && $order->tickets()->count() === 0) {
                for ($i = 0; $i < $order->quantity; $i++) {
                    Ticket::create([
                        'user_id'       => $order->user_id,
                        'event_id'      => $order->event_id,
                        'order_id'      => $order->id,
                        'ticket_type'   => $order->ticket_type,
                        'status'        => 'Active',
                        'purchase_date' => now(),
                        'qr_code'       => strtoupper(Str::random(12)),
                    ]);
                }
            }

            return response()->json(['message' => 'OK']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Halaman sukses (redirect dari Midtrans)
     */
    public function success(Request $request)
    {
        return redirect()->route('pembeli.myticket')->with('success', 'Pembayaran berhasil! Tiket kamu sudah tersedia.');
    }

    /**
     * Halaman gagal (redirect dari Midtrans)
     */
    public function failed(Request $request)
    {
        return redirect()->route('pembeli.event')->with('error', 'Pembayaran gagal atau dibatalkan.');
    }
}
