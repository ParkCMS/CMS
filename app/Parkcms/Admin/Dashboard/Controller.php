<?php

namespace Parkcms\Admin\Dashboard;

use View;
use Sentry;

class Controller extends \Controller
{
    public function index()
    {
        return View::make('admin.dashboard')->with('user', Sentry::getUser());
    }
}