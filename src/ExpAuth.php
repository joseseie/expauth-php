<?php

namespace Explicador\Authentication;


use Illuminate\Support\ServiceProvider;

class ExpAuth extends ServiceProvider 
{
    public function boot(){
    $this->publishes([
        __DIR__.'/controllers' => app_path('Http/Controllers/'),
    ]);
    $this->publishes([
        __DIR__.'/Traits' => app_path('Traits'),
    ]);
    $this->publishes([
        __DIR__ . '/config' => config_path('/')
    ]);
    $this->publishes([
        __DIR__.'/exp-auth' => app_path('resources'),
    ]);

    $this->mergeConfigFrom(
        __DIR__.'/services.php', 'services'
    );

    $this->loadRoutesFrom(__DIR__.'/routes.php');

    $this->loadMigrationsFrom(__DIR__.'/migrations');

    $this->loadViewsFrom(__DIR__.'/exp-auth', 'expauth');

    }

    public function register()
    {
        
    }
}
