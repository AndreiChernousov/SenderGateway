<?php

namespace App\Services\Notification;

use App\Models\Recipient;

class NotificationAbstract
{

    public function __construct(
      protected readonly Recipient $recipient
    ) {}

}
