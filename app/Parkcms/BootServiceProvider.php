<?php

namespace Parkcms;

use Illuminate\Support\ServiceProvider;

class BootServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        if(!isset($theme) || is_null($theme)) {
            $theme = 'default';
        }

        $this->app['current_theme'] = public_path('themes/' . $theme . '/views/');
        $this->app['default_theme'] = public_path('themes/default/views/');

        $this->app->make('view')->addNamespace(
            'parkcms-views',
            array($this->app['current_theme'], $this->app['default_theme'])
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

}
