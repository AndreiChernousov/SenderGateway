<?php

namespace Tests\Unit;

use App\Models\Recipient;
use App\Services\Notification\NotificationTelegram;
use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Models\TelegraphBot;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NotificationTelegramTest extends TestCase
{

    use RefreshDatabase;

    public function test_notification_send(): void
    {
        Telegraph::fake();

        $bot = TelegraphBot::create([
            'token' => 'testToken',
            'name' => 'test',
        ]);

        $recipient = Recipient::factory()->create();
        (new NotificationTelegram($recipient))->send('test');

        Telegraph::assertSent('test');
    }

    public function test_notification_error_no_telegram_id(): void
    {
        Telegraph::fake();

        $bot = TelegraphBot::create([
            'token' => 'testToken',
            'name' => 'test',
        ]);

        $recipient = Recipient::factory()->create();
        $recipient->telegram_id = '';

        (new NotificationTelegram($recipient))->send('test');
    }

}
