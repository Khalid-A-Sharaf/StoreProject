<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MarkNotificationAsRead
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // $user = Auth::user();
        // if($request->has('notification_id')){}
        $notification_id = $request->query('notification_id');
        if ($notification_id) {
            $user = $request->user();
            if ($user) {
                $notification = $user->unreadNotifications()->find($notification_id);
                if ($notification) {
                    $notification->markAsRead();
                    // $notification->markAsUnread();
                }
            }
        }
        return $next($request);
    }
}
