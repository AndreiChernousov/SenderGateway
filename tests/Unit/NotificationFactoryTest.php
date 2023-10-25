<?php

namespace Tests\Unit;

use App\Models\Recipient;
use App\Services\NotificationFactory;
use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Models\TelegraphBot;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NotificationFactoryTest extends TestCase
{

    use RefreshDatabase;

    public function test_telegram_type_message_send(): void
    {
        Telegraph::fake();
        $bot = TelegraphBot::create([
            'token' => 'testToken',
            'name' => 'test',
        ]);
        $recipient = Recipient::factory()->create();
        NotificationFactory::send($recipient, 'test', 'telegram');

        Telegraph::assertSent('test');
    }

    public function test_default_type_message_send(): void
    {
        Telegraph::fake();
        $bot = TelegraphBot::create([
            'token' => 'testToken',
            'name' => 'test',
        ]);
        $recipient = Recipient::factory()->create();
        NotificationFactory::send($recipient, 'test');

        Telegraph::assertSent('test');
    }

}
