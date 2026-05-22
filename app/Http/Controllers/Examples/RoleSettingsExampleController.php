<?php

namespace App\Http\Controllers\Examples;

use App\Http\Controllers\Controller;
use App\Models\RoleSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Example Controller - Demonstrating Role Settings Usage
 *
 * This controller shows various ways to use role settings
 * in your application. Remove or modify as needed.
 */
class RoleSettingsExampleController extends Controller
{
    /**
     * Example 1: Create event with role permission check
     */
    public function createEvent(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        // Method 1: Using user trait method
        if (!$user->hasRolePermission('can_create_event')) {
            return response()->json([
                'error' => 'Anda tidak memiliki akses untuk membuat event'
            ], 403);
        }

        // Proceed with event creation
        // $event = Event::create(...);

        return response()->json(['message' => 'Event created successfully']);
    }

    /**
     * Example 2: View dashboard with role-based content
     */
    public function dashboard()
    {
        /** @var User $user */
        $user = Auth::user();

        // Get all settings for current user's role
        $roleSettings = $user->getRoleSettings();

        // Check specific permissions
        $canManageUsers = $user->hasFeature('manage_users');
        $canApproveEvents = $user->hasFeature('approve_events');
        $canCreateEvent = $user->hasFeature('create_event');

        return view('dashboard', [
            'roleSettings' => $roleSettings,
            'canManageUsers' => $canManageUsers,
            'canApproveEvents' => $canApproveEvents,
            'canCreateEvent' => $canCreateEvent,
        ]);
    }

    /**
     * Example 3: Get setting value with default
     */
    public function getEventLimit()
    {
        /** @var User $user */
        $user = Auth::user();

        // Get event limit for current user's role
        $eventLimit = $user->getPermission('event_limit', 'unlimited');

        return response()->json([
            'role' => $user->role,
            'event_limit' => $eventLimit
        ]);
    }

    /**
     * Example 4: Query role settings directly
     */
    public function viewAllRolePermissions()
    {
        // Get all active settings for admin role
        $adminPermissions = RoleSetting::byRole('admin')
            ->active()
            ->pluck('value', 'key');

        // Get all settings grouped by role
        $allSettings = RoleSetting::active()
            ->get()
            ->groupBy('role');

        return response()->json([
            'admin_permissions' => $adminPermissions,
            'all_settings_by_role' => $allSettings->map(function ($items) {
                return $items->pluck('value', 'key');
            })
        ]);
    }

    /**
     * Example 5: Approve event with admin check
     */
    public function approveEvent(Request $request, $eventId)
    {
        /** @var User $user */
        $user = Auth::user();

        // Check if user is admin and has permission to approve
        if ($user->role !== 'admin' || !$user->hasRolePermission('can_approve_events')) {
            return response()->json([
                'error' => 'Only admins can approve events'
            ], 403);
        }

        // Approve event logic
        // $event = Event::find($eventId);
        // $event->update(['status' => 'approved']);

        return response()->json(['message' => 'Event approved']);
    }

    /**
     * Example 6: View active/inactive settings
     */
    public function manageSetting($role, $key)
    {
        // Find setting
        $setting = RoleSetting::where('role', $role)
            ->where('key', $key)
            ->first();

        if (!$setting) {
            return response()->json(['error' => 'Setting not found'], 404);
        }

        return response()->json($setting);
    }

    /**
     * Example 7: Toggle setting status (requires auth as admin)
     */
    public function toggleSetting(Request $request, $id)
    {
        // Only admin can change settings
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $setting = RoleSetting::find($id);
        $setting->update([
            'is_active' => !$setting->is_active
        ]);

        return response()->json([
            'message' => 'Setting updated',
            'setting' => $setting
        ]);
    }

    /**
     * Example 8: Bulk check permissions
     */
    public function checkMultiplePermissions(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        $permissions = $request->input('permissions', []);

        $results = [];
        foreach ($permissions as $permission) {
            $results[$permission] = $user->hasRolePermission($permission);
        }

        return response()->json(['permissions' => $results]);
    }

    /**
     * Example 9: Check permission for specific role
     */
    public function checkRolePermission($role, $key)
    {
        $setting = RoleSetting::where('role', $role)
            ->where('key', $key)
            ->where('is_active', true)
            ->first();

        $permission = $setting ? $setting->value : 'not_found';

        return response()->json([
            'role' => $role,
            'key' => $key,
            'value' => $permission,
            'has_permission' => $permission == '1'
        ]);
    }

    /**
     * Example 10: List all permissions for a role
     */
    public function listRolePermissions($role)
    {
        $settings = RoleSetting::byRole($role)
            ->active()
            ->get()
            ->map(function ($setting) {
                return [
                    'key' => $setting->key,
                    'value' => $setting->value,
                    'description' => $setting->description,
                ];
            });

        return response()->json([
            'role' => $role,
            'permissions' => $settings
        ]);
    }
}
