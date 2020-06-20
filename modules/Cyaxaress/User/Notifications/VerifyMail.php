<?php

namespace Cyaxaress\User\Notifications;

use Cyaxaress\User\Mail\VerifyCodeMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerifyMail extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {

        $code = random_int(100000, 999999);

        cache()->set(
            'verify_code_' . $notifiable,
            $code,
            now()->addDay()
        );

        return (new VerifyCodeMail($code))
            ->to($notifiable->email)
            ->subject('وب آموز | کد فعالسازی');
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
