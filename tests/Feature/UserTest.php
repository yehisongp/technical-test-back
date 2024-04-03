<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Laravel\Passport\ClientRepository;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_login(): void
    {
        $this->test_register();

        // Test login successfully
        $this->post('/api/login', [
            'email' => 'admin@mail.com',
            'password' => 'Qwe123@@'
        ])
            ->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    'token',
                    'user'
                ],
                'message'
            ]);
    }
    public function createPersonalAccessClient()
    {
        $clientRepository = new ClientRepository();
        $client = $clientRepository->createPersonalAccessClient(
            null,
            'Test Personal Access Client',
            'http://localhost'
        );
    }
    public function test_register(): void
    {
        $this->createPersonalAccessClient();
        Artisan::call('migrate');

        $this->post('/api/register', [
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => 'Qwe123@@',
            'password_confirmation' => 'Qwe123@@'
        ])
            ->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    'token',
                    'user'
                ],
                'message'
            ]);
    }
}
