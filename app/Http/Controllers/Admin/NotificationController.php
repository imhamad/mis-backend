<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        // get all notifications for the logged in user for last 30 days ordered by created_at desc
        $notifications = Notification::where('user_id', NULL)
            ->whereDate('created_at', '>=', now()->subDays(60))
            ->where('status', 'unread')
            ->orderBy('created_at', 'desc')->get()
            ->map(function ($notification) {
                $notification->created_date = $notification->created_at->format('d M, Y');
                $notification->created_time = $notification->created_at->format('h:i A');
                return $notification;
            });

        return response()->json($notifications);
    }

    public function mark_read()
    {
        $unread_notifications = Notification::where('user_id', NULL)->where('status', 'unread')->get();

        foreach ($unread_notifications as $notification) {
            $notification->update(['status' => 'read']);
        }

        return response()->json(['msg' => 'Notifications marked as read.']);
    }
}
