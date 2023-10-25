<?php

namespace App\Services\Notification;

use DefStudio\Telegraph\Facades\Telegraph;

class NotificationTelegram extends NotificationAbstract implements
  NotificationInterface
{

    /**
     * @throws \Exception
     */
    public function send(string $message): bool
    {
        if (!$this->recipient->telegram_id) {
            throw new \Exception('Undefined telegram_id');
        }

        $response = Telegraph::chat($this->recipient->telegram_id)->message(
          $message
        )->send();

        if ($response->telegraphError()) {
            throw new \Exception('Cant send telegram message');
        }

        return $response->telegraphOk();
    }

}
