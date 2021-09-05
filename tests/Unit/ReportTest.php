<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Laravel\Passport\Passport;

use App\Models\User;
use App\Models\Report;

class ReportTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Artisan::call('db:seed');
        Artisan::call('passport:install');
    }

    public function test_customer_can_report_user()
    {
        $user = User::create([
            'user_type_id' => 1,
            'email'      => 'customer2@gmail.com',
            'password'   => '$2y$12$7zw.h44/b1dE2b1pQbze/OAo.AUJaNuz9b7ENPcpnWmtifIL3rD3C',
        ]);

        Passport::actingAs(
            User::find(1)
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->post('/api/reports', [
            'content' => 'Customer kasar',
            'user_id' => $user->id
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('reports', [
            'content' => 'Customer kasar',
            'user_id' => $user->id
        ]);
    }

    public function test_customer_can_report_bug()
    {
        Passport::actingAs(
            User::find(1)
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->post('/api/reports', [
            'content' => 'Tidak bisa buka chat',
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('reports', [
            'content' => 'Tidak bisa buka chat',
        ]);
    }
}
