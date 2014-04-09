<?php

use Programs\Parkcms\Dirlist\Models\Dirlist;

class DirlistSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        Dirlist::create(array(
            'identifier'  => 'de-global-flyer',
            'title'  => 'Flyer',
            'folder' => '/flyer',
            'filter' => '*.pdf'
        ));
    }
}
