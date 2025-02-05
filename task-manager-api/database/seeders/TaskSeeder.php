<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

        User::all()->each(function ($user) use ($categories) {
            Task::factory(10)->create([
                'user_id' => $user->id,
                'category_id' => $categories->random()->id, 
            ]);
        });
    }
}
