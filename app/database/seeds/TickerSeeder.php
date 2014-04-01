<?php

use Programs\Parkcms\Ticker\Models\Ticker;
use Programs\Parkcms\Ticker\Models\Item;

class TickerSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        $en = Ticker::create(array(
            'identifier'  => 'de-home-ticker',
            'title'       => 'Ticker',
            'description' => 'A cool ticker!',
        ));
        $de = Ticker::create(array(
            'identifier' => 'de-home-ticker',
            'title'       => 'Ticker',
            'description' => 'Ein cooler Ticker!',
        ));

        $en->items()->save(new Item(array(
            'title'       => 'Item #1',
            'description' => 'A cool item!',
        )));
        $en->items()->save(new Item(array(
            'title'       => 'Item #2',
            'description' => 'Another cool item!',
        )));

        $de->items()->save(new Item(array(
            'title'       => 'Item #1',
            'description' => 'Ein cooles Item!',
        )));
        $de->items()->save(new Item(array(
            'title'       => 'Item #2',
            'description' => 'Ein anderes cooles Item!',
        )));
    }
}