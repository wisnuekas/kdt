<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Laravel\Passport\Passport;

use App\Models\User;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Artisan::call('db:seed');
        Artisan::call('passport:install');
    }

    public function test_staff_can_see_all_customer()
    {
        Passport::actingAs(
            User::find(2),
            ['see-customers', 'delete-customers']
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->get('/api/customers');

        $response
            ->assertStatus(200)
            ->assertJson([
                ['email' => 'customer@gmail.com']
            ]);
    }

    public function test_staff_can_delete_customer()
    {
        Passport::actingAs(
            User::find(2),
            ['see-customers', 'delete-customers']
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->delete('/api/customers/delete/1');

        $response->assertStatus(200);
    }

    public function test_staff_can_not_delete_staff()
    {
        Passport::actingAs(
            User::find(2),
            ['see-customers', 'delete-customers']
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->delete('/api/customers/delete/2');

        $response->assertStatus(401);
    }

    public function test_customer_can_not_see_all_customer()
    {
        Passport::actingAs(
            User::find(1)
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->get('/api/customers');

        $response->assertStatus(403);
    }

    public function test_customer_can_not_delete_customer()
    {
        Passport::actingAs(
            User::find(1)
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->delete('/api/customers/delete/1');

        $response->assertStatus(403);
    }

    public function test_customer_can_not_delete_staff()
    {
        Passport::actingAs(
            User::find(1)
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->delete('/api/customers/delete/2');

        $response->assertStatus(403);
    }
}
