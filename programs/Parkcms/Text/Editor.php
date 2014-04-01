<?php

namespace Programs\Parkcms\Text;

use Parkcms\Programs\Admin\Editor as BaseEditor;

class Editor extends BaseEditor
{
    public function register()
    {
        $this->addEndpoint('index', 'index');
        $this->addResourceEndpoint('part', $this);
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