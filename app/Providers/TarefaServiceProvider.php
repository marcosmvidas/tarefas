<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\TarefaService;
use App\Services\TarefaValidatorService;

class TarefaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Bind TarefaService to the service container
        $this->app->singleton(TarefaService::class, function ($app) {
            return new TarefaService($app->make(TarefaValidatorService::class));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Bootstrapping services if needed
    }
}
