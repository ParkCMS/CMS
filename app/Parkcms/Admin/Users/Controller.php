<?php

namespace Parkcms\Admin\Users;

use Controller as BaseController;
use Parkcms\Auth\Models\User;

use Validator;
use Sentry;
use Input;
use Response;

class Controller extends BaseController
{
    public function getUserList()
    {
        return User::all();
    }

    public function create()
    {
        $user = Input::all();

        $rules = array(
            'username'  => 'required|unique:users',
            'email'     => 'required|email',
            'first_name'=> 'required',
            'last_name' => 'required',
            'activated' => 'required|in:true,false',
            'password'  => 'required|confirmed'
        );

        $validation = Validator::make($user, $rules);

        if (!$validation->fails()) {
            $user = Sentry::createUser(Input::except('password_confirmation'));
            return Response::json(array('success' => array('message' => 'User was successfully created!')));
        } else {
            return Response::json(array('error' => array('message' => 'Validation failed', 'errors' => $validation->messages()->all())), 500);
        }
    }

    public function update()
    {
        $userData = Input::all();

        $user = User::find($userData['id']);
    }
}