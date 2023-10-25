<?php

namespace App\Services;

use App\Models\Recipient;
use App\Services\Notification\NotificationTelegram;

class NotificationFactory
{

    /**
     * @param \App\Models\Recipient $recipient
     * @param string $message
     * @param string $type
     *
     * @return void
     * @throws \Exception
     */
    public static function send(
      Recipient $recipient,
      string $message,
      string $type = ''
    ): void {
        if ($type !== '') {
            match ($type) {
                'telegram' => (new NotificationTelegram($recipient))->send(
                  $message
                ),
                default => (new NotificationTelegram($recipient))->send(
                  $message
                ),
            };
        } else {
            if ($recipient->telegram_id) {
                (new NotificationTelegram($recipient))->send($message);
            }
        }
    }

}
