<?php

if(!function_exists('theme_path')) {
    function theme_path($path = '') {
        return URL::to('themes/' . App::make('current_theme_name') . '/' . $path);
    }
}
