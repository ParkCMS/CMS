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

        $form = $this->makeField('Form');

        $form->setAction('update');
        $form->setMethod('put');

        $form->addFields(function($f) use ($properties, $model) {

            if (isset($properties['global']) && $properties['global'] === 'global') {
                $value = 'global';
            } else {
                $value = $properties['page'];
            }

            $page = $f->addField('Text', array(
                'name' => 'page',
                'value' =>  $value,
                'label' => 'Page:'
            ));

            $page->setAttribute('disabled', 'disabled');

            $identifier = $f->addField('Text', array(
                'name' => 'identifier',
                'value' =>  $properties['identifier'],
                'label' => 'Identifier:'
            ));

            $identifier->setAttribute('disabled', 'disabled');

            $content = $f->addField('Content', array(
                'name' => 'content',
                'value' =>  $model->text,
                'label' => 'Content:'
            ));
        });

        $form->addSubmit('Save');

        return $form;
    }

    public function create()
    {
        return 'Create';
    }
}