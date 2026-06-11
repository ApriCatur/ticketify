@php
    $navSections = [
        [
            'items' => [
                ['label' => 'Dashboard', 'route' => route('admin.dashboard'), 'icon' => 'fa-chart-line', 'active' => 'admin.dashboard'],
                ['label' => 'Published Events', 'route' => route('admin.PublishedEvent'), 'icon' => 'fa-calendar-check', 'active' => 'admin.PublishedEvent'],
                ['label' => 'Pending Events', 'route' => route('admin.PendingEvent'), 'icon' => 'fa-clock', 'active' => 'admin.PendingEvent'],
                ['label' => 'Manage Users', 'route' => route('admin.users'), 'icon' => 'fa-users', 'active' => 'admin.users'],
                ['label' => 'Role Applications', 'route' => route('admin.role-applications'), 'icon' => 'fa-user-tie', 'active' => 'admin.role-applications'],
                ['label' => 'Event Categories', 'route' => route('admin.categories'), 'icon' => 'fa-layer-group', 'active' => 'admin.categories'],
            ],
        ],
        [
            'title' => 'Other',
            'items' => [
                ['label' => 'Statistik Event', 'route' => route('admin.event-statistics'), 'icon' => 'fa-chart-pie', 'active' => 'admin.event-statistics*'],
                ['label' => 'Settings', 'route' => route('admin.Settings'), 'icon' => 'fa-gear', 'active' => 'admin.Settings'],
            ],
        ],
    ];
@endphp

<x-sidebar :navSections="$navSections" roleLabel="ADMINISTRATOR" avatarClass="bg-amber-600" roleTextClass="text-amber-500" logoutFormId="logout-form-admin" />
