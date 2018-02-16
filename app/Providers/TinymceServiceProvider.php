<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TinymceServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        // load views
        $this->loadViewsFrom(base_path('resources/views/posts/tinymce'), 'mceImageUpload');

        // ability to publish view
        $this->publishes([
            __DIR__.'/views' => base_path('resources/views/posts/tinymce'),
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // load routes
        include __DIR__.'/tinymce/routes.php';
		
		
        // load controller
        $this->app->make('App\Http\Controllers\TinymceController');

        // load helper
        include __DIR__.'/tinymce/helpers.php';
    }

}