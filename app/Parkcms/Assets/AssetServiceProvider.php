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
            foreach($dom->getElementsByTagName('pcms-styles') as $styles) {
                foreach($this->app['parkcms.asset']->styles($dom) as $node) {
                    $styles->parentNode->insertBefore($node);
                }
                $styles->parentNode->removeChild($styles);
            }

            foreach($dom->getElementsByTagName('pcms-scripts') as $scripts) {
                foreach($this->app['parkcms.asset']->scripts($dom) as $node) {
                    $scripts->parentNode->insertBefore($node);
                }
                $scripts->parentNode->removeChild($scripts);
            }
        });
    }
}
