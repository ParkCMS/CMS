<?php

use Programs\Parkcms\Text\Model as Text;

class TextSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        Text::create(array(
            'identifier' => 'en-contact-content',
            'text' => '<p>Our contact informationen...</p>'
        ));
        Text::create(array(
            'identifier' => 'de-contact-content',
            'text' => '<p>Unsere Kontaktinformationen...</p>'
        ));


        Text::create(array(
            'identifier' => 'en-global-footer',
            'text' => '<p>english footer...</p>'
        ));
        Text::create(array(
            'identifier' => 'de-global-footer',
            'text' => '<p>Deutscher Footer...</p>'
        ));
    }
}