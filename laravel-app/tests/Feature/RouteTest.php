<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class RouteTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_routes_are_accessible()
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $response = $this->get('/cats');
        $response->assertStatus(200);

        $response = $this->get('/events');
        $response->assertStatus(200);

        $response = $this->get('/donations');
        $response->assertStatus(200);
    }

    public function test_auth_routes_redirect_guests()
    {
        $response = $this->get('/reports/create');
        $response->assertStatus(302); // Redirect to login
    }

    public function test_admin_dashboard_access()
    {
        $user = User::factory()->create(['role' => 'user']);
        $admin = User::factory()->create(['role' => 'admin']);

        // User cannot access admin
        $response = $this->actingAs($user)->get('/admin/dashboard');
        $response->assertStatus(403);

        // Admin can access admin
        $response = $this->actingAs($admin)->get('/admin/dashboard');
        $response->assertStatus(200);
    }
}
