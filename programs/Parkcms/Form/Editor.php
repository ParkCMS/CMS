<?php

namespace Programs\Parkcms\Form;

use Parkcms\Programs\Admin\Editor as BaseEditor;

use Programs\Parkcms\Form\Models\Form;

use Validator;

class Editor extends BaseEditor
{
    public function register()
    {
        $this->addEndpoint('index', 'index', 'get');
        $this->addEndpoint('update', 'update', 'put');
    }

    public function index($properties)
    {
        $page = (isset($properties['global']) && $properties['global'] === 'global') ? false : $properties['page'];
        $contact = Form::byContext($properties['lang'], $page, $properties['identifier'])->first();

        if ($contact === null) {
            $contact = new Form;
            $contact->identifier = $contact->createIdentifier($properties['lang'], $page, $properties['identifier']);
            $contact->email = 'mail@example.com';
            $contact->subject = 'Mail Subject';
            $contact->rules = '{"name":"required|min:5","email":"required|email","comment":"required|min:10"}';
            $contact->attributes = '';
            $contact->save();
        }

        $form = $this->makeField('Form');
        $form->setAction('update');
        $form->setMethod('put');

        $form->addFields(function ($form) use ($contact) {
            $form->addField('Text', array(
                'name'  => 'email',
                'value' => $contact->email,
                'label' => 'E-Mail',
                'type'  => 'email'
            ));

            $form->addField('Text', array(
                'name'  => 'subject',
                'value' => $contact->subject,
                'label' => 'Subject'
            ));
        });
        $form->addSubmit('Save');
        return $form;
    }

    public function update($properties)
    {
        $form = $properties['form'];

        $page = (isset($properties['global']) && $properties['global'] === 'global') ? false : $properties['route'];

        $model = Form::byContext($properties['lang'], $page, $properties['identifier'])->first();

        if ($model === null) {
            return Response::json(array('error' => array('title' => 'Form Editor Error', 'message' => 'The given form was not found!')), 404);
        }

        $rules = array(
            'email'     => 'required|email',
            'subject'   => 'required'
        );

        $validator = Validator::make($properties['form'], $rules);

        if (!$validator->fails()) {
            $model->email = $form['email'];
            $model->subject = $form['subject'];

            $model->save();

            return array('success' => array('message' => 'Form updated successfully'), 'redirect' => 'index');
        } else {
            return array('error' => array('message' => 'Validation failed', 'errors' => json_encode($validator->messages()->all())));
        }
    }
}