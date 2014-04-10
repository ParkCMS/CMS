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
        $this->addEndpoint('settings', 'settings', 'get');
        $this->addEndpoint('settings_save', 'saveSettings', 'post');
    }

    public function index($properties)
    {
        $ticker = $this->getTicker($properties);
        $toolbar = $this->makeField('Toolbar');
        $toolbar->addButton('New Item', 'file', array('load-action' => 'create'));
        $toolbar->addButton('Settings', 'cog', array('load-action' => 'settings'));

        $table = $this->makeField('Table');

        $table->setHeaders(array('title' => 'Title', 'description' => 'Description'));

        $table->setButtons(array(
            array(
                'load-action'    => 'edit',
                'title'     => 'Edit',
                'content'   => 'Edit'
            ),
            array(
                'confirm-action'    => 'delete',
                'confirm-message'   => 'Do you really want to delete the selected entry?',
                'title'     => 'Delete',
                'content'   => 'Delete'
            )
        ));

        $table->setRows($ticker->items);

        return $toolbar->render() . $table->render();
    }

    public function settings($properties)
    {
        $ticker = $this->getTicker($properties);

        $form = $this->makeField('Form');

        $form->setAction('settings_save');
        $form->setMethod('post');

        $form->addFields(function($form) use ($ticker) {
            $form->addField('Text', array(
                'name'  => 'title',
                'value' => $ticker->title,
                'label' => 'Title:'
            ));

            $form->addField('Content', array(
                'name'  => 'description',
                'value' => $ticker->description,
                'label' => 'Description:'
            ));
        });

        $form->addSubmit('Save');

        return $form;
    }

    public function saveSettings($properties)
    {
        $ticker = $this->getTicker($properties);

        if ($ticker === null) {
            return Response::json(array('error' => array('title' => 'Ticker Editor Error', 'message' => 'The given ticker was not found!')), 404);
        }

        $form = $properties['form'];

        $ticker->title = $form['title'];
        $ticker->description = $form['description'];

        if ($ticker->save()) {
            return array('success' => array('message' => 'Ticker updated successfully'), 'redirect' => 'index');
        } else {
            return array('error' => array('message' => 'The given ticker could not be saved!'), 'redirect' => 'index');
        }
    }

    public function create()
    {
        return $this->generateItemForm('store', 'post');
    }

    public function edit($properties)
    {
        $item = Item::find($properties['id']);

        if ($item === null) {
            return Response::json(array('error' => array('title' => 'Ticker Editor Error', 'message' => 'The given item with ID #' . $properties['id'] . ' was not found in the database!')), 404);
        }

        return $this->generateItemForm('update', 'put', $item);
    }

    public function update($properties)
    {
        $form = $properties['form'];

        $item = Item::find($form['id']);
        if ($item === null) {
            return Response::json(array('error' => array('title' => 'Ticker Editor Error', 'message' => 'The given item with ID #' . $properties['id'] . ' was not found in the database!')), 404);
        }

        $item->title = $form['title'];
        $item->description = $form['description'];
        $item->media_preview = $form['fileselect'];
        $item->link = $form['link'];

        if ($item->save()) {
            return array('success' => array('message' => 'Field updated successfully'), 'redirect' => 'index');
        } else {
            return array('error' => array('message' => 'The given item could not be saved!'), 'redirect' => 'index');
        }
    }

    public function store($properties)
    {
        $form = $properties['form'];

        $ticker = $this->getTicker($properties);

        $item = new Item;

        $item->title = $form['title'];
        $item->description = $form['description'];
        $item->media_preview = $form['fileselect'];
        $item->link = $form['link'];
        $item->ticker_id = $ticker->id;

        if ($item->save()) {
            return array('success' => array('message' => 'Field created successfully'), 'redirect' => 'index');
        } else {
            return array('error' => array('message' => 'The given item could not be saved!'), 'redirect' => 'index');
        }
    }

    public function delete($properties)
    {
        $item = Item::find($properties['id']);

        if ($item === null) {
            return Response::json(array('error' => array('title' => 'Ticker Editor Error', 'message' => 'The given item with ID #' . $properties['id'] . ' was not found in the database!')), 404);
        }

        if ($item->delete()) {
            return array('success' => array('message' => 'Item deleted successfully'), 'redirect' => 'index');
        } else {
            return array('error' => array('message' => 'The given item could not be deleted!'), 'redirect' => 'index');
        }
    }

    private function getTicker($properties)
    {
        $page = (isset($properties['global']) && $properties['global'] === 'global') ? false : $properties['page'];

        if ($page) {
            $ticker = Ticker::where('identifier', $properties['lang'] . '-' . $properties['page'] . '-' . $properties['identifier'])->with('items')->first();
        } else {
            $ticker = Ticker::where('identifier', $properties['lang'] . '-' . $properties['identifier'])->with('items')->first();
        }

        return $ticker;
    }

    private function generateItemForm($action, $method, $item = null)
    {
        $form = $this->makeField('Form');

        $form->setAction($action);
        $form->setMethod($method);

        $form->addFields(function($form) use ($item) {
            $title = $form->addField('Text', array(
                'name'  => 'title',
                'value' => '',
                'label' => 'Title:'
            ));

            $description = $form->addField('Content', array(
                'name'  => 'description',
                'value' => '',
                'label' => 'Description:'
            ));

            $file = $form->addField('FileSelect', array(
                'name'  => 'fileselect',
                'label' => 'Select Image or Media Preview:',
                'value' => ''
            ));

            $link = $form->addField('Text', array(
                'name'  => 'link',
                'value' => '',
                'label' => 'Link:'
            ));

            if ($item !== null)
            {
                $title->setValue($item->title);
                $description->setValue($item->description);
                $file->setValue($item->media_preview);
                $link->setValue($item->link);
                $id = $form->addField('Text', array(
                    'type'  => 'hidden',
                    'name'  => 'id',
                    'value' => $item->id
                ));
            }
        });

        $form->addSubmit('Save');
        $form->addButton('Cancel', 'abort', 'index');

        return $form;
    }
}