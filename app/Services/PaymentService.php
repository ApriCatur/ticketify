<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Ticket;
use Illuminate\Support\Str;

class PaymentService
{
    public function createTickets(Order $order): array
    {
        $tickets = [];

        for ($i = 0; $i < $order->quantity; $i++) {
            $ticket = Ticket::create([
                'user_id' => $order->user_id,
                'event_id' => $order->event_id,
                'order_id' => $order->id,
                'ticket_type' => $order->ticket_type,
                'status' => 'Active',
                'purchase_date' => now(),
                'qr_code' => Str::random(12),
            ]);

            $tickets[] = $ticket;
        }

        $this->decrementStock($order);

        return $tickets;
    }

    public function decrementStock(Order $order): void
    {
        $template = Ticket::where('event_id', $order->event_id)
            ->where('ticket_type', $order->ticket_type)
            ->whereNull('order_id')
            ->first();

        if ($template) {
            $template->decrement('stock', $order->quantity);
        }
    }
}
