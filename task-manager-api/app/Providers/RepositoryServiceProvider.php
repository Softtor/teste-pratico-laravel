<?php

namespace App\Providers;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskController;
use App\Repositories\CategoryRepository;
use App\Repositories\Contracts\Repository;
use App\Repositories\TaskRepository;
use App\Repositories\TaskRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->app->when(TaskController::class)
            ->needs(TaskRepositoryInterface::class)
            ->give(TaskRepository::class);

        $this->app->when(CategoryController::class)
            ->needs(Repository::class)
            ->give(CategoryRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
