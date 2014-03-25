<?php

use Parkcms\Models\Page;

class PageSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
		
		
		$en = Page::create(array(
			'type' => 'lang',
			'title' => 'en',
			'meta' => ''
		));
		$de = Page::create(array(
			'type' => 'lang',
			'title' => 'de',
			'meta' => ''
		));
		
		$en->children()->create(array(
			'alias'		=> 'home',
			'template'	=> 'default',
			'title'		=> 'Home',
		));
		$de->children()->create(array(
			'alias'		=> 'home',
			'template'	=> 'default',
			'title'		=> 'Startseite',
		));
		
		$en->children()->create(array(
			'alias'		=> 'contact',
			'template'	=> 'contact',
			'title'		=> 'Contact',
		));
		$de->children()->create(array(
			'alias'		=> 'contact',
			'template'	=> 'contact',
			'title'		=> 'Kontakt',
		));
		
		$aboutus_en = $en->children()->create(array(
			'alias'		=> 'aboutus',
			'template'	=> 'default',
			'title'		=> 'About us',
		));
		$aboutus_de = $de->children()->create(array(
			'alias'		=> 'aboutus',
			'template'	=> 'default',
			'title'		=> 'Über uns',
		));
		
		$aboutus_en->children()->create(array(
			'alias'		=> 'friedrich',
			'template'	=> 'default',
			'title'		=> 'Friedrich',
		));
		$aboutus_de->children()->create(array(
			'alias'		=> 'friedrich',
			'template'	=> 'default',
			'title'		=> 'Overlord',
		));
		
		$aboutus_en->children()->create(array(
			'alias'		=> 'david',
			'template'	=> 'default',
			'title'		=> 'David',
		));
		$aboutus_de->children()->create(array(
			'alias'		=> 'david',
			'template'	=> 'default',
			'title'		=> 'David',
		));
		
	}

}