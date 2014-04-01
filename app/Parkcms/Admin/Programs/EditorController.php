<?php

namespace Parkcms\Admin\Programs;

use App;
use Input;
use Controller;
use Response;
use Request;

class EditorController extends Controller
{
    public function index()
    {
        // Get attributes
        $type = null;
        if (Input::has('type')) {
            $type = Input::get('type');
        } else {
            return Response::json(array('message' => 'No type has been specified!'), 400);
        }

        $class = $this->checkForClass($type);

        if ($class === null) {
            return Response::json(array('message' => 'No editor was found'), 404);
        }

        $editor = App::make($class);

        $action = 'index';
        if (Input::has('action')) {
            $action = Input::get('action');
        }

        $editor->register();

        return $editor->route($action, Request::method(), Input::except('type', 'action'));
    }

    public function convertRequestTypeToClass($type)
    {
        return implode('\\', array_map(function($el) {
            return ucfirst($el);
        }, explode('-', $type)));
    }

    private function checkForClass($type)
    {
        $class = null;
        if (class_exists('Programs\\' . $this->convertRequestTypeToClass($type) . '\\Editor')) {
            $class = 'Programs\\' . $this->convertRequestTypeToClass($type) . '\\Editor';
        } else if (class_exists('Programs\\Parkcms\\' . $this->convertRequestTypeToClass($type) . '\\Editor')) {
            $class = 'Programs\\Parkcms\\' . $this->convertRequestTypeToClass($type) . '\\Editor';
        }

        return $class;
    }
}