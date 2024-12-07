<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function adminNotifications()
    {
        if (!Auth::check()) {
            // User is not logged in, redirect to login page or handle accordingly
            return redirect()->route('login');
        }

        $user = Auth::user();
        if (!$user->isAdmin()) {
            // User is not an admin, handle accordingly (e.g., show error message, redirect, etc.)
            return redirect()->back()->with('error', 'You are not authorized to access this page.');
        }

        $notifications = $user->unreadNotifications;
        return view('admin.notifications', compact('notifications'));
    }

    public function userNotifications()
    {
        if (!Auth::check()) {
            // User is not logged in, redirect to login page or handle accordingly
            return redirect()->route('login');
        }

        $user = Auth::user();
        $notifications = $user->unreadNotifications;
        return view('user.notifications', compact('notifications'));
    }
}
