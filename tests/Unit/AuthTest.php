<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Laravel\Passport\Passport;

use App\Models\User;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Artisan::call('db:seed');
        Artisan::call('passport:install');
    }

    /**
     * Login success test for staff
     *
     * @return void
     */
    public function test_staff_can_login()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->post('/api/auth/login', [
            'email' => 'staff@gmail.com',
            'password' => 'dummydummy'
        ]);

        $response->assertStatus(200);
    }

    /**
     * Login failed test for staff
     *
     * @return void
     */
    public function test_staff_can_not_login()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->post('/api/auth/login', [
            'email' => 'staff@gmail.com',
            'password' => 'dummydu'
        ]);

        $response->assertStatus(401);
    }

    public function test_staff_can_logout()
    {
        Passport::actingAs(
            User::find(2)
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->post('/api/auth/logout');

        $response->assertStatus(200);
    }

    public function test_customer_can_login()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->post('/api/auth/login', [
            'email' => 'customer@gmail.com',
            'password' => 'dummydummy'
        ]);

        $response->assertStatus(200);
    }

    public function test_customer_can_not_login()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->post('/api/auth/login', [
            'email' => 'customer@gmail.com',
            'password' => 'dummydu'
        ]);

        $response->assertStatus(401);
    }

    public function test_customer_can_logout()
    {
        Passport::actingAs(
            User::find(2)
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->post('/api/auth/logout');

        $response->assertStatus(200);
    }
}
