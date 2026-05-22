<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\User;
use App\Models\RoleApplication;

class DashboardController extends Controller
{
    public function index()
    {
        // Get published events count
        $publishedEventsCount = Event::where('status', 'approved')->count();

        // Get pending events count
        $pendingEventsCount = Event::where('status', 'pending')->count();

        // Get total active users (excluding admins or role-based filtering)
        $usersCount = User::count();

        // Get events grouped by category for the chart
        $eventsByCategory = Event::where('status', 'approved')
            ->select('category')
            ->selectRaw('count(*) as count')
            ->groupBy('category')
            ->orderByDesc('count')
            ->get();

        // Get category names and counts for the bar chart
        $categories = $eventsByCategory->pluck('category')->take(4)->toArray();
        $categoryCounts = $eventsByCategory->pluck('count')->take(4)->toArray();

        // Calculate ratio for pie chart
        $totalEvents = $publishedEventsCount + $pendingEventsCount;
        $publishedPercentage = $totalEvents > 0 ? ($publishedEventsCount / $totalEvents) * 100 : 0;
        $pendingPercentage = $totalEvents > 0 ? ($pendingEventsCount / $totalEvents) * 100 : 0;

        // Get recent pending events for the sidebar
        $upcomingPendingEvents = Event::where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Get recent published events
        $recentPublishedEvents = Event::where('status', 'approved')
            ->orderBy('date', 'desc')
            ->take(5)
            ->get();

        return view('Admin.Dashboard', [
            'publishedEventsCount' => $publishedEventsCount,
            'pendingEventsCount' => $pendingEventsCount,
            'usersCount' => $usersCount,
            'categories' => $categories,
            'categoryCounts' => $categoryCounts,
            'publishedPercentage' => $publishedPercentage,
            'pendingPercentage' => $pendingPercentage,
            'totalEvents' => $totalEvents,
            'upcomingPendingEvents' => $upcomingPendingEvents,
            'recentPublishedEvents' => $recentPublishedEvents,
        ]);
    }
}
