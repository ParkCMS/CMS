<?php

namespace Programs\Parkcms\Text;

use Parkcms\Programs\Admin\Editor as BaseEditor;

class Editor extends BaseEditor
{
    public function register()
    {
        $this->addEndpoint('index', 'index');
    }

    public function index($properties)
    {
        $page = isset($properties['page']) ? $properties['page'] : 0;
        return 'Texteditor auf Seite ' . $page;
    }

    public function create()
    {
        return 'Create';
    }
}