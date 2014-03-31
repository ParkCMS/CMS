<?php

use Programs\Parkcms\Form\Models\Form;
use Programs\Parkcms\Form\Models\Field;

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
            'subject' => 'Contact form',
            'rules' => json_encode(array(
                'name' => 'required|min:5',
                'email' => 'required|email',
            )),
        ));
        $de = Form::create(array(
            'identifier' => 'de-contact-contact',
            'email' => 'parkcms.team@gmail.com',
            'subject' => 'Kontakt formular',
            'rules' => json_encode(array(
                'name' => 'required|min:5',
                'email' => 'required|email',
            )),
        ));

    }

}