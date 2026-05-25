<?php

namespace App\Http\Controllers\Panitia;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    /**
     * Display attendance page for panitia
     */
    public function index()
    {
        // Ambil panitia yang sedang login
        $panitia = Auth::user();

        // Ambil event milik panitia ini
        $userEvents = $panitia->events()->where('status', 'published')->get() ?? collect();

        // Ambil recent attendance scans (5 terakhir)
        $recentAttendances = collect();
        if ($userEvents->count() > 0) {
            $recentAttendances = Ticket::whereIn('event_id', $userEvents->pluck('id'))
                ->where('is_attended', true)
                ->with('user:id,name')
                ->orderBy('attended_at', 'desc')
                ->take(5)
                ->get();
        }

        return view('Panitia.Attendance', compact('userEvents', 'recentAttendances'));
    }

    /**
     * Verify ticket by ticket ID (manual input atau scan)
     */
    public function verifyTicket(Request $request)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'ticket_id' => 'required|string',
                'event_id' => 'required|integer|exists:events,id'
            ]);

            // Cari ticket berdasarkan ID
            $ticket = Ticket::where('id', $validated['ticket_id'])
                ->where('event_id', $validated['event_id'])
                ->with(['user:id,name,email', 'event:id,name'])
                ->first();

            // Jika ticket tidak ditemukan
            if (!$ticket) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ticket tidak ditemukan atau invalid',
                    'type' => 'error'
                ], 404);
            }

            // Jika ticket sudah di-scan sebelumnya
            if ($ticket->is_attended) {
                return response()->json([
                    'success' => false,
                    'message' => 'Peserta sudah melakukan checkin sebelumnya',
                    'data' => [
                        'name' => $ticket->user->name,
                        'email' => $ticket->user->email,
                        'event' => $ticket->event->name,
                        'ticket_type' => $ticket->ticket_type,
                        'attended_at' => $ticket->attended_at ? $ticket->attended_at->format('H:i:s') : 'N/A'
                    ],
                    'type' => 'warning'
                ]);
            }

            // Update ticket sebagai sudah di-attend
            $ticket->update([
                'is_attended' => true,
                'attended_at' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Checkin berhasil!',
                'data' => [
                    'name' => $ticket->user->name,
                    'email' => $ticket->user->email,
                    'event' => $ticket->event->name,
                    'ticket_type' => $ticket->ticket_type,
                    'attended_at' => now()->format('H:i:s')
                ],
                'type' => 'success'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                'type' => 'error'
            ], 500);
        }
    }

    /**
     * Get attendance statistics
     */
    public function getStatistics(Request $request)
    {
        $panitia = Auth::user();
        $eventId = $request->query('event_id');

        $event = $panitia->events()->findOrFail($eventId);

        $totalTickets = $event->tickets()->count();
        $attendedTickets = $event->tickets()->where('is_attended', true)->count();
        $attendanceRate = $totalTickets > 0 ? round(($attendedTickets / $totalTickets) * 100, 1) : 0;

        return response()->json([
            'total_tickets' => $totalTickets,
            'attended_tickets' => $attendedTickets,
            'attendance_rate' => $attendanceRate
        ]);
    }
}
