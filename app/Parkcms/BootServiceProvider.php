<?php

namespace Parkcms;

use Illuminate\Support\ServiceProvider;

use Asset;
use Config;
use Lang;

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
        $theme = Config::get('parkcms.theme');

        $this->app['current_theme_name'] = $theme;

        $this->app['current_theme'] = public_path('themes/' . $theme . '/views/');
        $this->app['default_theme'] = public_path('themes/default/views/');

        $this->app->make('view')->addNamespace(
            'parkcms-views',
            array($this->app['current_theme'], $this->app['default_theme'])
        );

        Asset::add('main', 'themes/' . $theme . '/css/main.css');

        Asset::add('jquery', 'themes/default/js/jquery.min.js');
        Asset::add('bootstrap', 'themes/default/js/bootstrap.min.js', array('jquery'));
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
