<?php

if(!function_exists('theme_path')) {
    function theme_path($path = '') {
        return URL::to('themes/' . App::make('current_theme_name') . '/' . $path);
    }
}

if(!function_exists('current_lang')) {
    function current_lang($path = '') {
        if($context = App::make('Parkcms\Context')) {
            return $context->lang();
        } else {
            return Config::get('parkcms.lang');
        }
    }
}
