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
        // $this->addEndpoint('index', 'index');
        // $this->addEndpoint('update', 'update');
        $this->addResourceEndpoint('', $this);
    }

    public function index($properties)
    {
        //$identifier = $properties['lang'] . $properties['page'] . '-' . $properties['identifier'];

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

            $link = $form->addField('Text', array(
                'name'  => 'link',
                'value' => $item->link,
                'label' => 'Link:'
            ));
        });

        $form->addSubmit('Save');
        $form->addButton('Cancel', 'abort', 'index');

        return $form;
    }

    public function update($properties)
    {
        return "<p>Update</p>";
    }
}