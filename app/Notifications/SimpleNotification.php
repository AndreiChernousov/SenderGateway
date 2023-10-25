<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\SenderClient\SenderClient;
use NotificationChannels\SenderClient\SenderClientChannel;

class SimpleNotification extends Notification
{

    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [SenderClientChannel::class];
    }

    public function toSender(object $notifiable): SenderClient
    {
        return (new SenderClient(
            'Message text',
            'telegram',
        ));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }

}
