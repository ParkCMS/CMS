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
        //$identifier = $properties['lang'] . $properties['page'] . '-' . $properties['identifier'];
        
        $page = (isset($properties['global'])) ? false : $properties['page'];

        $model = Model::byContext($properties['lang'], $page, $properties['identifier'])->first();

        $page = $this->makeField('Text');

        $identifier = $this->makeField('Text');

        $content = $this->makeField('Content');

        if (isset($properties['global']) && $properties['global'] === 'global') {
            $value = 'global';
        } else {
            $value = $properties['page'];
        }

        $page->create(array('name' => 'page', 'value' =>  $value, 'label' => 'Page:', 'disabled' => true));

        $identifier->create(array('name' => 'identifier', 'value' =>  $properties['identifier'], 'label' => 'Identifier:', 'disabled' => true));
        $content->create(array('name' => 'content', 'value' =>  $model->text, 'label' => 'Content:'));

        return $page->render() . $identifier->render() . $content->render();
    }

    public function create()
    {
        return 'Create';
    }
}