<?php

namespace Parkcms\Admin\Dashboard;

use View;

class Controller extends \Controller
{
    public function index()
    {
        return View::make('admin.dashboard');
    }
}