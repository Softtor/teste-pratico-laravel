<?php

use App\Models\User;
use App\Models\Category;
use App\Models\Task;
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
    seed(\Database\Seeders\TaskSeeder::class);
});

test('usuário pode criar uma tarefa', function () {
    $user = User::first();
    $category = Category::first();

    actingAs($user);
    $response = postJson('/api/tasks', [
        'title' => 'Minha primeira tarefa',
        'description' => 'Descrição da tarefa',
        'status' => 'pending',
        'category_id' => $category->id,
        'user_id' => $user->id,
    ]);

    $response->assertStatus(201)
        ->assertJsonStructure([
            'id',
            'title',
            'description',
            'status',
            'category_id',
            'user_id',
            'created_at',
            'updated_at'
        ]);

    assertDatabaseHas('tasks', [
        'title' => 'Minha primeira tarefa',
        'user_id' => $user->id,
        'category_id' => $category->id,

    ]);
});

test('usuário pode visualizar suas tarefas', function () {
    $user = User::first();
    actingAs($user);

    $response = getJson('/api/tasks');

    $response->assertStatus(200)
        ->assertJsonCount(10);
});




test('usuário pode atualizar uma tarefa', function () {
    $user = User::first();
    $task = Task::where('user_id', $user->id)->first();
    $category = Category::first();

    actingAs($user);

    $response = putJson("/api/tasks/{$task->id}", [
        'title' => 'Tarefa Atualizada',
        'description' => 'Nova descrição',
        'status' => 'in progress',
        'category_id' => $category->id,
        'user_id' => $user->id,
    ]);

    $response->assertStatus(200);

    assertDatabaseHas('tasks', [
        'id' => $task->id,
        'title' => 'Tarefa Atualizada',
        'description' => 'Nova descrição',
        'status' => 'in progress',
        'category_id' => $category->id,
        'user_id' => $user->id,
    ]);
});

test('usuário pode excluir uma tarefa', function () {
    $user = User::first();
    $task = Task::where('user_id', $user->id)->first();

    actingAs($user);

    $response = deleteJson("/api/tasks/{$task->id}");

    $response->assertStatus(200);

    assertDatabaseMissing('tasks', [
        'id' => $task->id,
    ]);
});
