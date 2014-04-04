<?php

namespace Programs\Parkcms\Ticker;

use Parkcms\Programs\Admin\Editor as BaseEditor;

use Programs\Parkcms\Ticker\Models\Ticker;
use Programs\Parkcms\Ticker\Models\Item;

use Response;

class Editor extends BaseEditor
{
    public function register()
    {
        $this->addResourceEndpoint('', $this);
    }

    public function index($properties)
    {

        $page = (isset($properties['global']) && $properties['global'] === 'global') ? false : $properties['page'];

        if ($page) {
            $ticker = Ticker::where('identifier', $properties['lang'] . '-' . $properties['page'] . '-' . $properties['identifier'])->with('items')->first();
        } else {
            $ticker = Ticker::where('identifier', $properties['lang'] . '-' . $properties['identifier'])->with('items')->first();
        }

        $table = $this->makeField('Table');

        $table->setHeaders(array('title' => 'Title', 'description' => 'Description'));

        $table->setButtons(array(
            array(
                'action'    => 'edit',
                'title'     => 'Edit',
                'content'   => 'Edit'
            ),
            array(
                'action'    => 'delete',
                'title'     => 'Delete',
                'content'   => 'Delete'
            )
        ));

        $table->setRows($ticker->items);

        return $table;
    }

    public function create()
    {
        return 'Create';
    }

    public function edit($properties)
    {
        $item = Item::find($properties['id']);

        if ($item === null) {
            return Response::json(array('error' => array('title' => 'Ticker Editor Error', 'message' => 'The given item with ID #' . $properties['id'] . ' was not found in the database!')), 404);
        }

        $form = $this->makeField('Form');

        $form->setAction('update');
        $form->setMethod('put');

        $form->addFields(function($form) use ($properties, $item) {
            $title = $form->addField('Text', array(
                'name'  => 'title',
                'value' => $item->title,
                'label' => 'Title:'
            ));

            $description = $form->addField('Content', array(
                'name'  => 'description',
                'value' => $item->description,
                'label' => 'Description:'
            ));

            $file = $form->addField('FileSelect', array(
                'name'  => 'fileselect',
                'label' => 'Select Image or Media Preview:',
                'value' => $item->media_preview
            ));

            $link = $form->addField('Text', array(
                'name'  => 'link',
                'value' => $item->link,
                'label' => 'Link:'
            ));

            $id = $form->addField('Text', array(
                'type'  => 'hidden',
                'name'  => 'id',
                'value' => $item->id
            ));
        });

        $form->addSubmit('Save');
        $form->addButton('Cancel', 'abort', 'index');

        return $form;
    }

    public function update($properties)
    {
        $form = $form = $properties['form'];

        $item = Item::find($form['id']);
        if ($item === null) {
            return Response::json(array('error' => array('title' => 'Ticker Editor Error', 'message' => 'The given item with ID #' . $properties['id'] . ' was not found in the database!')), 404);
        }

        $item->title = $form['title'];
        $item->description = $form['description'];
        $item->media_preview = $form['fileselect'];
        $item->link = $form['link'];

        if ($item->save()) {
            return array('message' => 'Field updated successfully', 'type' => 'success', 'redirect' => 'index');
        } else {
            return array('message' => 'The given item could not be saved!', 'type' => 'error', 'redirect' => 'index');
        }
    }
}