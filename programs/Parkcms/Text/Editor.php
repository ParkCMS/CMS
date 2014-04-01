<?php

namespace Programs\Parkcms\Text;

use Parkcms\Programs\Admin\Editor as BaseEditor;

class Editor extends BaseEditor
{
    public function register()
    {
        $this->addEndpoint('index', 'index');
    }

    public function index()
    {
        return 'Texteditor';
    }

    public function create()
    {
        return 'Create';
    }
}