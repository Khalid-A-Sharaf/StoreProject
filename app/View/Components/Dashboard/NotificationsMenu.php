<?php

namespace App\View\Components\Dashboard;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class NotificationsMenu extends Component
{
    public $notifications;
    public $newCount;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
        $admin = Auth::guard('admin')->user();
        $this->notifications = $admin->notifications()->take(10)->get();
        $this->newCount = $admin->unreadNotifications()->count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.notifications-menu');
    }
}
