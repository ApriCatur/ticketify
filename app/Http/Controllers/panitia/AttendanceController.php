<?php

namespace App\Http\Controllers\Panitia;

use App\Http\Controllers\Controller;
use App\Http\Requests\VerifyTicketRequest;
use App\Models\Ticket;
use App\Services\AttendanceService;
use App\Services\StatisticsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function __construct(
        protected AttendanceService $attendanceService,
        protected StatisticsService $statisticsService,
    ) {}

    public function index()
    {
        $panitia = Auth::user();
        $userEvents = $panitia->events()->where('status', 'published')->get() ?? collect();

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

    public function verifyTicket(VerifyTicketRequest $request)
    {
        try {
            $result = $this->attendanceService->verify(
                $request->ticket_id,
                $request->event_id
            );

            $statusCode = $result['success'] ? 200 : ($result['type'] === 'error' ? 404 : 200);

            return response()->json($result, $statusCode);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                'type' => 'error',
            ], 500);
        }
    }

    public function getStatistics(Request $request)
    {
        $panitia = Auth::user();
        $eventId = $request->query('event_id');
        $panitia->events()->findOrFail($eventId);

        $stats = $this->statisticsService->getAttendanceStats($eventId);

        return response()->json($stats);
    }

    public function showAttendees($id)
    {
        $event = Auth::user()->events()->findOrFail($id);

        $attendees = Ticket::where('event_id', $id)
            ->whereNotNull('order_id')
            ->with('user:id,name,email,phone_number')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('panitia.customerdata', compact('event', 'attendees'));
    }
}
