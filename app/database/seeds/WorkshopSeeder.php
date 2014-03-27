<?php

use Parkcms\Programs\Workshop\Models\Workshop;
use Parkcms\Programs\Workshop\Models\Part;
use Parkcms\Programs\Workshop\Models\Registration;

class WorkshopSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        $w1 = Workshop::create(array(
            'identifier' => 'workshop',
            'title' => '1st Workshop',
            'content' => '',
            'registration_mail' => 'Thank you for registration',
            'date' => '2013/01/01',
            'seats' => '50',
            'active' => '0'
        ));
        $w2 = Workshop::create(array(
            'identifier' => 'workshop',
            'title' => '2nd Workshop',
            'content' => '',
            'registration_mail' => 'Thank you for registration',
            'date' => new \DateTime('+1 month'),
            'seats' => '50',
            'active' => '1'
        ));

        $w1->parts()->save(new Part(array(
            'title' => 'Workshop',
            'description' => '',
            'price' => 59.95,

            'part_type' => 1,
            'select_values' => '',

            'connected_with_seats' => true,
            'order' => 1
        )));
        $w1->parts()->save(new Part(array(
            'title' => 'Evening program',
            'description' => '',
            'price' => 29.95,

            'part_type' => 1,
            'select_values' => '',

            'connected_with_seats' => false,
            'order' => 2
        )));


        $w2->parts()->save(new Part(array(
            'title' => 'Workshop',
            'description' => '',
            'price' => 59.95,

            'part_type' => 1,
            'select_values' => '',

            'connected_with_seats' => true,
            'order' => 1
        )));
        $w2->parts()->save(new Part(array(
            'title' => 'Evening program',
            'description' => 'How many will come?',
            'price' => 29.95,

            'part_type' => 2,
            'select_values' => '0,1,2',

            'connected_with_seats' => false,
            'order' => 2
        )));
    }
}