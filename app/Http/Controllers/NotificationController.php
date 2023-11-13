<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications;

        return view('notification', compact('notifications'));
    }

    public function markAsRead($id)
    {
        // Find the notification by its ID
        $notification = Notification::find($id);

        // Ensure the notification exists and belongs to the currently authenticated user
        if (!$notification || $notification->notifiable_id !== auth()->id()) {
            return redirect()->route('notifications.index')->with('error', 'Invalid notification.');
        }

        // Mark the notification as read
        $notification->update(['read' => true]);

        return redirect()->route('notifications.index')->with('success', 'Notification marked as read.');
    }
}
