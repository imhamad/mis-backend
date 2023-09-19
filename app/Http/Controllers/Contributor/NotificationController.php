<?php

namespace App\Http\Controllers\Contributor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        // get all notifications for the logged in user for last 30 days ordered by created_at desc
        $notifications = $request->user()->notifications()
            ->whereDate('created_at', '>=', now()->subDays(30))
            ->orderBy('created_at', 'desc')->get()
            ->map(function ($notification) {
                $notification->created_date = $notification->created_at->format('d M, Y');
                $notification->created_time = $notification->created_at->format('h:i A');
                return $notification;
            });

        return response()->json($notifications);
    }
}
