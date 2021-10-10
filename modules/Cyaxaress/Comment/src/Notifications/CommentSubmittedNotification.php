<?php

namespace Cyaxaress\Comment\Notifications;

use Cyaxaress\Comment\Mail\CommentSubmittedMail;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class CommentSubmittedNotification extends Notification
{
    use Queueable;

    public $comment;

    public function __construct($comment)
    {
        $this->comment = $comment;
    }

    public function via($notifiable): array
    {
        return ['mail', TelegramChannel::class];
    }

    public function toMail($notifiable)
    {
        return (new CommentSubmittedMail($this->comment))->to($notifiable->email);
    }

    public function toTelegram($notifiable)
    {
        return TelegramMessage::create()
            // Optional recipient user id.
            ->to(118718802)
            // Markdown supported.
            ->content("یک دیدگاه جدید برای دوره ی شما در وب آموز ارسال شده است.")

            // (Optional) Blade template for the content.
            // ->view('notification', ['url' => $url])

            // (Optional) Inline Buttons
            ->button('مشاهده دوره', $this->comment->commentable->path())
            ->button('مدیریت دیدگاه ها', route("comments.index"));
    }

    public function toArray($notifiable): array
    {
        return [
            //
        ];
    }
}
