<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
          'name' => 'testServer',
          'email' => 'testserver@server.com',
          'password' => bcrypt(
            'sew23we7ysadqwenuygasb7qe6bd865asfqwedastfbq23481c'
          ),
        ]);
    }

}
