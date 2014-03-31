<?php

namespace Parkcms\Assets;

use Illuminate\Support\Facades\Facade;

class AssetFacade extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return "parkcms.asset";
    }
}