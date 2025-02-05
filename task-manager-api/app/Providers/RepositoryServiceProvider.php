<?php

namespace App\Providers;

use App\Contracts\CategoryRepositoryContract;
use App\Contracts\TaskRepositoryContract;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\TaskRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->app->bind(TaskRepositoryContract::class, TaskRepository::class);
        $this->app->bind(CategoryRepositoryContract::class, CategoryRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
