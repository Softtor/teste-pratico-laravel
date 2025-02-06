<?php

use App\Models\User;
use function  Pest\Laravel\postJson;

test('usuário pode fazer login com credenciais corretas', function () {
    User::factory()->create([
        'email' => 'johndoe@example.com',
        'password' => bcrypt('password123'),
    ]);

    $response = postJson('/api/login', [
        'email' => 'johndoe@example.com',
        'password' => 'password123',
    ]);

    $response->assertStatus(200)
        ->assertJsonStructure([
            'user' => ['id', 'name', 'email', 'created_at', 'updated_at'],
            'token'
        ]);
});

test('usuário não pode fazer login com senha incorreta', function () {
    $user = User::factory()->create([
        'email' => 'johndoe@example.com',
        'password' => bcrypt('password123'),
    ]);

    $response = postJson('/api/login', [
        'email' => 'johndoe@example.com',
        'password' => 'wrongpassword',
    ]);

    $response->assertStatus(401)
        ->assertJson([
            'message' => 'Credenciais inválidas.'
        ]);
});
