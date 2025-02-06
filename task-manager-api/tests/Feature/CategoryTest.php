<?php

use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\deleteJson;
use function Pest\Laravel\getJson;
use function Pest\Laravel\postJson;
use function Pest\Laravel\putJson;
use function Pest\Laravel\seed;

uses(RefreshDatabase::class);

beforeEach(function () {
    seed(\Database\Seeders\UserSeeder::class);
    seed(\Database\Seeders\CategorySeeder::class);
});

test('usuário pode criar uma categoria', function () {
    $user = User::first();
    actingAs($user);

    $response = postJson('/api/categories', [
        'name' => 'Nova Categoria',
    ]);

    $response->assertStatus(201)
        ->assertJsonStructure([
            'id',
            'name',
            'created_at',
            'updated_at'
        ]);

    assertDatabaseHas('categories', [
        'name' => 'Nova Categoria',
    ]);
});

test('usuário pode visualizar todas as categorias', function () {
    $user = User::first();
    actingAs($user);

    $response = getJson('/api/categories');

    $response->assertStatus(200)
        ->assertJsonCount(Category::count());
});

test('usuário pode visualizar uma categoria específica', function () {
    $user = User::first();
    actingAs($user);

    $category = Category::first();

    $response = getJson("/api/categories/{$category->id}");

    $response->assertStatus(200)
        ->assertJson([
            'id' => $category->id,
            'name' => $category->name,
        ]);
});

test('usuário pode atualizar uma categoria', function () {
    $user = User::first();
    actingAs($user);

    $category = Category::first();

    $response = putJson("/api/categories/{$category->id}", [
        'name' => 'Categoria Atualizada',
    ]);

    $response->assertStatus(200);

    assertDatabaseHas('categories', [
        'id' => $category->id,
        'name' => 'Categoria Atualizada',
    ]);
});


test('usuário pode excluir uma categoria', function () {
    $user = User::first();
    actingAs($user);

    $category = Category::first();

    $response = deleteJson("/api/categories/{$category->id}");

    $response->assertStatus(200);

    assertDatabaseMissing('categories', [
        'id' => $category->id,
    ]);
});
