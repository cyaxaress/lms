<?php

namespace Cyaxaress\User\Notifications;

use Cyaxaress\User\Mail\VerifyCodeMail;
use Cyaxaress\User\Services\VerifyCodeService;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class VerifyMailNotification extends Notification
{
    use Queueable;

    public function __construct()
    {
        //
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $code = VerifyCodeService::generate();
        VerifyCodeService::store($notifiable->id, $code, now()->addDay());

        return (new VerifyCodeMail($code))->to($notifiable->email);
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
