<?php

namespace Tests\Feature;

use App\Models\Recipient;
use App\Models\User;
use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Models\TelegraphBot;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MessageSendTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $bot = TelegraphBot::create([
          'token' => 'testToken',
          'name' => 'test',
        ]);
    }

    public function test_message_send(): void
    {
        Telegraph::fake();

        $user = User::factory()->create();
        $recipient = Recipient::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/v1/message/send', [
          'recipient' => 'TestBot',
          'message' => 'test',
        ]);

        $response->assertStatus(200);
    }

    public function test_token_error(): void
    {
        Telegraph::fake();

        $recipient = Recipient::factory()->create();

        $response = $this->postJson('/api/v1/message/send', [
          'recipient' => 'TestBot',
          'message' => 'test',
        ]);

        $response->assertStatus(401);
    }

    public function test_recipient_error(): void
    {
        Telegraph::fake();

        $user = User::factory()->create();
        $recipient = Recipient::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/v1/message/send', [
          'message' => 'test',
        ]);

        $response->assertStatus(422);
    }

    public function test_message_error(): void
    {
        Telegraph::fake();

        $user = User::factory()->create();
        $recipient = Recipient::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/v1/message/send', [
          'recipient' => 'TestBot',
        ]);

        $response->assertStatus(422);
    }

    public function test_recipient_and_message_error(): void
    {
        Telegraph::fake();

        $user = User::factory()->create();
        $recipient = Recipient::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/v1/message/send', []
        );

        $response->assertStatus(422);
    }

}
