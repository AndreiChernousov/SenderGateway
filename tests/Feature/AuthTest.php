<?php

namespace Tests\Feature;

use App\Enum\ResponseCodeEnums;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_auth(): void
    {
        $user = User::factory()->create([
          'name' => 'testServer',
          'email' => 'testserver@server.com',
          'password' => bcrypt(
            'password'
          ),
        ]);

        $response = $this->postJson(
          '/api/v1/user/auth',
          [
            'email' => $user->email,
            'password' => 'password',
            'device_name' => 'testDevice',
          ]
        );

        $response->assertStatus(200)->assertJsonFragment(
          ['message' => ResponseCodeEnums::AUTH_OK->name]
        );
    }

    public function test_error_auth(): void
    {
        $user = User::factory()->create();

        $response = $this->postJson(
          '/api/v1/user/auth',
          [
            'email' => $user->email,
            'password' => 'password11',
            'device_name' => 'testDevice',
          ]
        );

        $response->assertStatus(401)->assertJsonFragment(
          ['message' => ResponseCodeEnums::CREDENTIALS_ERROR->name]
        );
    }

    public function test_no_email_error_auth(): void
    {
        $user = User::factory()->create();

        $response = $this->postJson(
          '/api/v1/user/auth',
          [
            'password' => 'password11',
            'device_name' => 'testDevice',
          ]
        );

        $response->assertStatus(422);
    }

}
