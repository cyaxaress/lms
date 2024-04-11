<?php

namespace Cyaxaress\Common\Http\Controllers;

use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();

        return back();
    }
}
