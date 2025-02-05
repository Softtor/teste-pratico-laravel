<?php

use App\Models\User;

use function Pest\Laravel\assertDatabaseHas;
use function  Pest\Laravel\postJson;

test('usuário pode se registrar', function () {
    $response = postJson('/api/register', [
        'name' => 'John Doe',
        'email' => 'johndoe@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ]);

    $response->assertStatus(201)
        ->assertJsonStructure([
            'user' => [
                'id',
                'name',
                'email',
                'created_at',
                'updated_at',
            ],
            'token'
        ]);

    assertDatabaseHas('users', [
        'email' => 'johndoe@example.com',
    ]);
});
