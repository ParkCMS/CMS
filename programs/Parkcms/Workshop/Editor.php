<?php

namespace Programs\Parkcms\Workshop;

use Parkcms\Programs\Admin\Editor as BaseEditor;

use Programs\Parkcms\Workshop\Models\Workshop as Model;
use Programs\Parkcms\Workshop\Models\Part;

class Editor extends BaseEditor {
    public function register()
    {
        $this->addResourceEndpoint('', $this);

        $this->addEndpoint('settings', 'settings', 'get');
        $this->addEndpoint('updateSettings', 'updateSettings', 'put');
    }

    public function index($properties)
    {
        $workshop = $this->getWorkshop($properties);
        $toolbar = $this->makeField('Toolbar');
        // $toolbar->addButton('New Workshop', 'file', array('load-action' => 'createW'));
        $toolbar->addButton('Settings', 'cog', array('load-action' => 'settings'));
        $toolbar->addButton('New Part', 'file', array('load-action' => 'create'));

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

        $table->setRows($workshop->parts);

        return $toolbar->render() . $table->render();
    }

    public function settings($properties)
    {
        $workshop = $this->getWorkshop($properties);

        $form = $this->makeField('Form');

        $form->setAction('updateSettings');
        $form->setMethod('put');

        $form->addFields(function($form) use ($workshop) {
            $title = $form->addField('Text', array(
                'name'  => 'title',
                'value' => '',
                'label' => 'Title:'
            ));

            $content = $form->addField('Content', array(
                'name'  => 'content',
                'value' => '',
                'label' => 'Content:'
            ));

            $terms = $form->addField('Content', array(
                'name'  => 'terms',
                'value' => '',
                'label' => 'Terms:'
            ));

            $registration_mail = $form->addField('Content', array(
                'name'  => 'registration_mail',
                'value' => '',
                'label' => 'Registration Mail:'
            ));

            $date = $form->addField('Text', array(
                'name'  => 'date',
                'type'  => 'date',
                'value' => '',
                'label' => 'Date:'
            ));
            
            $seats = $form->addField('Text', array(
                'name'  => 'seats',
                'type'  => 'number',
                'value' => '',
                'label' => 'Seats:'
            ));

            if ($workshop !== null)
            {
                $title->setValue($workshop->title);
                $content->setValue($workshop->content);
                $terms->setValue($workshop->terms);
                $registration_mail->setValue($workshop->registration_mail);
                $date->setValue($workshop->date->format('Y-m-d'));
                $seats->setValue($workshop->seats);

                $id = $form->addField('Text', array(
                    'type'  => 'hidden',
                    'name'  => 'id',
                    'value' => $workshop->id
                ));
            }
        });

        $form->addSubmit('Save');
        $form->addButton('Cancel', 'abort', 'index');

        return $form;
    }

    public function updateSettings($properties)
    {
        $form = $properties['form'];

        $workshop = Model::find($form['id']);

        $workshop->title = $form['title'];
        $workshop->content = $form['content'];
        $workshop->terms = $form['terms'];
        $workshop->registration_mail = $form['registration_mail'];
        $workshop->date = $form['date'];
        $workshop->seats = $form['seats'];

        if ($workshop->save()) {
            return array('message' => 'Workshop updated successfully', 'type' => 'success', 'redirect' => 'index');
        } else {
            return array('message' => 'The settings could not be saved!', 'type' => 'error', 'redirect' => 'index');
        }
    }

    public function create()
    {
        return $this->generateItemForm('store', 'post');
    }

    public function edit($properties)
    {
        $item = Part::find($properties['id']);

        if ($item === null) {
            return Response::json(array('error' => array('title' => 'Workshop Editor Error', 'message' => 'The given item with ID #' . $properties['id'] . ' was not found in the database!')), 404);
        }

        return $this->generateItemForm('update', 'put', $item);
    }

    public function update($properties)
    {
        $form = $properties['form'];

        $item = Part::find($form['id']);
        if ($item === null) {
            return Response::json(array('error' => array('title' => 'Workshop Editor Error', 'message' => 'The given item with ID #' . $properties['id'] . ' was not found in the database!')), 404);
        }

        $item->title = $form['title'];
        $item->description = $form['description'];
        $item->price = $form['price'];
        $item->part_type = $form['part_type'];
        $item->select_values = $form['select_values'];
        $item->connected_with_seats = $form['connected_with_seats'];
        $item->order = $form['order'];

        if ($item->save()) {
            return array('message' => 'Field updated successfully', 'type' => 'success', 'redirect' => 'index');
        } else {
            return array('message' => 'The given item could not be saved!', 'type' => 'error', 'redirect' => 'index');
        }
    }

    public function store($properties)
    {
        $form = $properties['form'];

        $workshop = $this->getWorkshop($properties);

        $item = new Part;

        $item->title = $form['title'];
        $item->description = $form['description'];
        $item->price = $form['price'];
        $item->part_type = $form['part_type'];
        $item->select_values = $form['select_values'];
        $item->connected_with_seats = $form['connected_with_seats'];
        $item->order = $form['order'];

        $item->workshop_id = $workshop->id;

        if ($item->save()) {
            return array('message' => 'Field created successfully', 'type' => 'success', 'redirect' => 'index');
        } else {
            return array('message' => 'The given item could not be saved!', 'type' => 'error', 'redirect' => 'index');
        }
    }

    public function delete($properties)
    {
        $item = Part::find($properties['id']);

        if ($item === null) {
            return Response::json(array('error' => array('title' => 'Workshop Editor Error', 'message' => 'The given item with ID #' . $properties['id'] . ' was not found in the database!')), 404);
        }

        $item->registrations()->detach();

        if ($item->delete()) {
            return array('message' => 'Part deleted successfully', 'type' => 'success', 'redirect' => 'index');
        } else {
            return array('message' => 'The given item could not be deleted!', 'type' => 'error', 'redirect' => 'index');
        }
    }

    private function getWorkshop($properties)
    {
        return Model::with('parts')->where('identifier', $properties['identifier'])->where('active', 1)->first();
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

            $price = $form->addField('Text', array(
                'name'  => 'price',
                'value' => '0.0',
                'label' => 'Price:'
            ));

            $part_type = $form->addField('Text', array(
                'name'  => 'part_type',
                'value' => '1',
                'label' => 'Part type:'
            ));

            $select_values = $form->addField('Text', array(
                'name'  => 'select_values',
                'value' => '',
                'label' => 'Select values:'
            ));

            $connected_with_seats = $form->addField('CheckBox', array(
                'name'  => 'connected_with_seats',
                'label' => 'Connected with seats',
                'value' => 1
            ));

            $order = $form->addField('Text', array(
                'name'  => 'order',
                'value' => 1,
                'label' => 'Order:'
            ));

            if ($item !== null)
            {
                $title->setValue($item->title);
                $description->setValue($item->description);
                $price->setValue($item->price);
                $part_type->setValue($item->part_type);
                $select_values->setValue($item->select_values);
                $connected_with_seats->setValue($item->connected_with_seats);
                $order->setValue($item->order);

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
