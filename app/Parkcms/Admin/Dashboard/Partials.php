<?php

namespace Parkcms\Admin\Dashboard;

use Controller;
use View;
use App;

class Partials extends Controller
{
    public function show($name)
    {
        $view = 'admin.partials.'.$name;
        if (View::exists($view)) {
            return View::make($view);
        }
        App::abort(404);
    }
}