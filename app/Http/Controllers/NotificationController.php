<?php

namespace App\Http\Controllers;

use App\Notifications\SimpleNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // NotificationController.php
    public function index()
    {
        // Auth::user()->notify(new SimpleNotification('gjw9 '));
        $notifications = Auth::user()->notifications()
            ->orderByRaw('read_at IS NULL DESC') // Unread first
            ->orderBy('created_at', 'desc') // Then by creation date
            ->paginate(7);

        return view('gazole.notifications', compact('notifications'));
    }

    public function markAsRead($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->markAsRead();
        return redirect()->back()->with('success', 'Notification marked as read.');
    }

    public function delete($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->delete();
        return redirect()->back()->with('success', 'Notification deleted successfully.');
    }
    // NotificationController.php
    public function deleteAll()
    {
        Auth::user()->notifications()->delete();
        return redirect()->back()->with('success', 'All notifications deleted successfully.');
    }
}
