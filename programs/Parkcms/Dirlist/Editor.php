<?php

namespace Programs\Parkcms\Dirlist;

use Parkcms\Programs\Admin\Editor as BaseEditor;

use Programs\Parkcms\Dirlist\Models\Dirlist as Model;

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

        $model = $this->getModel($properties);

        $form = $this->makeField('Form');

        $form->setAction('update');
        $form->setMethod('put');

        $form->addFields(function($f) use ($properties, $model) {
            $title = $f->addField('Text', array(
                'name' => 'title',
                'value' =>  $model->title,
                'label' => 'Title:'
            ));

            $folder = $f->addField('FileSelect', array(
                'name' => 'folder',
                'value' =>  $model->folder,
                'select'=> 'directories',
                'label' => 'Folder:'
            ));

            $filter = $f->addField('Text', array(
                'name' => 'filter',
                'value' =>  $model->filter,
                'label' => 'Filter:'
            ));
        });

        $form->addSubmit('Save');

        return $form;
    }

    public function create()
    {
        return 'Create';
    }

    public function update($properties)
    {
        $form = $properties['form'];

        $model = $this->getModel($properties);

        $model->title = $form['title'];
        $model->folder = $form['folder'];
        $model->filter = $form['filter'];

        $model->save();

        return array('message' => 'Field updated successfully', 'type' => 'success', 'redirect' => 'index');
    }

    public function getModel($properties) {
        if(strpos($properties['identifier'], "global") === 0) {
            return Model::where(
                'identifier', $properties['lang'] . '-' . $properties['identifier']
            )->first();
        } else {
            return Model::where(
                'identifier', $properties['lang'] . '-' . $properties['page'] . '-' . $properties['identifier']
            )->first();
        }
    }
}