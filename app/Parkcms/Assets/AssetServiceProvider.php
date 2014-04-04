<?php

namespace Parkcms\Assets;

use Illuminate\Support\ServiceProvider;

use Event;

class AssetServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app['parkcms.asset'] = $this->app->share(function() {
            return new Asset();
        });

        $app = $this->app;
        Event::listen('parkcms.parser.post', function($dom) use($app) {
            foreach($dom('pcms-styles') as $styles) {
                $stylesheets = '';
                foreach($this->app['parkcms.asset']->styles() as $node) {
                    $stylesheets .= $node;
                }
                $styles->setOuterText($stylesheets);
            }

            foreach($dom('pcms-scripts') as $scripts) {
                $scriptsTags = '';
                foreach($this->app['parkcms.asset']->scripts() as $node) {
                    $scriptsTags .= $node;
                }
                $scripts->setOuterText($scriptsTags);
            }
        });
    }
}
