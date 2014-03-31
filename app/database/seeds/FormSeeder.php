<?php

use Parkcms\Programs\Form\Models\Form;
use Parkcms\Programs\Form\Models\Field;

class FormSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        
        $en = Form::create(array(
            'identifier' => 'en-contact-contact',
            'email' => 'parkcms.team@gmail.com',
            'subject' => 'Contact form'
        ));
        $de = Form::create(array(
            'identifier' => 'de-contact-contact',
            'email' => 'parkcms.team@gmail.com',
            'subject' => 'Kontakt formular'
        ));
        
        $en->fields()->create(array(
            'type'     => 'email',
            'name'  => 'email',
            'values'     => '',
            'attributes' => '{"placeholder": "E-Mail"}'
        ));
        $de->fields()->create(array(
            'type'     => 'email',
            'name'  => 'email',
            'values'     => '',
            'attributes' => '{"placeholder": "E-Mail"}'
        ));
        
        $en->fields()->create(array(
            'type'     => 'text',
            'name'  => 'name',
            'values'     => '',
            'attributes' => '{"placeholder": "Name"}'
        ));
        $de->fields()->create(array(
            'type'     => 'text',
            'name'  => 'name',
            'values'     => '',
            'attributes' => '{"placeholder": "Name"}'
        ));
        
    }

}