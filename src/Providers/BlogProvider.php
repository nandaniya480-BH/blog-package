<?php

namespace Nandaniya480\Blog\Providers;

use Illuminate\Support\ServiceProvider;

class BlogProvider extends ServiceProvider
{
    // public function boot()
    // {
    //     if ($this->app->runningInConsole()) {
    //         $this->registerPublishing();
    //     }

    //     $this->registerResources();
    // }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/migrations');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'Blog');
    }

    /**
     * Register the package resources.
     *
     * @return void
     */
    // private function registerResources()
    // {
    //     $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    //     $this->loadViewsFrom(__DIR__ . '/../resources/views', 'Blog');

    //     $this->registerRoutes();
    // }

    // /**
    //  * Register the package routes.
    //  *
    //  * @return void
    //  */
    // protected function registerRoutes()
    // {
    //     $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
    // }

    // protected function registerPublishing()
    // {
    //     $this->publishes([
    //         __DIR__ . '/Console/stubs/BlogProvider.php' => app_path('Providers/BlogProvider.php'),
    //     ], 'blog-provider');
    // }
}
