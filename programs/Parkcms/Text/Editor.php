<?php

namespace Programs\Parkcms\Text;

use Parkcms\Programs\Admin\Editor as BaseEditor;

class Editor extends BaseEditor
{
    public function register()
    {
        $this->addEndpoint('index', 'index');
        $this->addEndpoint('update', 'update');
    }

    public function index($properties)
    {
        
        $page = (isset($properties['global']) && $properties['global'] === 'global') ? false : $properties['page'];

        $model = Model::byContext($properties['lang'], $page, $properties['identifier'])->first();

        if ($model === null) {
            // Install
            $model = new Model;
            $model->identifier = $model->createIdentifier($properties['lang'], $page, $properties['identifier']);
            $model->text = "";

            $model->save();
        }

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
                'name' => 'text',
                'value' =>  $model->text,
                'label' => 'Content:'
            ));
        });

        $form->addSubmit('Save');

        return $form;
    }

    public function update($properties)
    {
        $form = $properties['form'];

        $page = (isset($properties['global']) && $properties['global'] === 'global') ? false : $properties['route'];

        $model = Model::byContext($properties['lang'], $page, $properties['identifier'])->first();

        $model->text = $form['text'];

        $model->save();

        return array('message' => 'Field updated successfully', 'type' => 'success', 'redirect' => 'index');
    }
}