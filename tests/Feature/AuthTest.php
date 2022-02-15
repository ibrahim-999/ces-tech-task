<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function login_redirects_successfully()
    {
        // Create a user
        factory(User::class)->create([
            'email' => 'admin@admin.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/login', ['email' => 'admin@admin.com', 'password' => 'password123']);

        $response->assertStatus(302);
        $response->assertRedirect('/home');
    }


    /** @test */
    public function unauthenticated_user_cannot_access_dashboard()
    {
        $response = $this->get('/home');

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }
}
