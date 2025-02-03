<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * O namespace padrão para os controladores.
     *
     * @var string|null
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Definir as rotas do aplicativo.
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Registrar as rotas da aplicação.
     */
    public function map()
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
    }

    /**
     * Definir as rotas da API.
     */
    protected function mapApiRoutes()
    {
        Route::middleware('api')
            ->prefix('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }

    /**
     * Definir as rotas web.
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }
}
