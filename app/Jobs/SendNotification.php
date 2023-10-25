<?php

namespace App\Jobs;

use App\Models\Recipient;
use App\Services\NotificationFactory;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendNotification implements ShouldQueue
{

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
      public Recipient $recipient,
      public string $message,
      public string $type = '',
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        NotificationFactory::send($this->recipient, $this->message);
    }

}
