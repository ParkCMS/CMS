<?php

use Programs\Parkcms\Ekomi\Models\Ekomi;

class EkomiSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        Ekomi::create(array(
            'identifier'  => 'global-ekomi',
            'link'  => '',
            'name' => 'Example',
            'source' => 'Example123|abc1234567890',
            'rating'=> 0,
            'count' => 0,
            'created_at' => new \DateTime('-1 month'),
            'updated_at' => new \DateTime('-1 month'),
        ));
    }
}