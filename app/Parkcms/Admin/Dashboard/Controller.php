<?php

namespace Parkcms\Admin\Dashboard;

use View;

class Controller extends \BaseController
{
    public function index()
    {
        return View::make('admin.dashboard');
    }
}