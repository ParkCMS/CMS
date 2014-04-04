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
			'meta' => '',
			'unpublished' => 0,
		));
		$de = Page::create(array(
			'type' => 'lang',
			'title' => 'de',
			'meta' => '',
			'unpublished' => 0,
		));
		
		$en->children()->create(array(
			'alias'		=> 'home',
			'template'	=> 'home',
			'title'		=> 'Home',
			'unpublished' => 0,
		));
		$de->children()->create(array(
			'alias'		=> 'home',
			'template'	=> 'home',
			'title'		=> 'Startseite',
			'unpublished' => 0,
		));
		
		$en->children()->create(array(
			'alias'		=> 'contact',
			'template'	=> 'contact',
			'title'		=> 'Contact',
			'unpublished' => 0,
		));
		$de->children()->create(array(
			'alias'		=> 'contact',
			'template'	=> 'contact',
			'title'		=> 'Kontakt',
			'unpublished' => 0,
		));
		
		$aboutus_en = $en->children()->create(array(
			'alias'		=> 'aboutus',
			'template'	=> 'default',
			'title'		=> 'About us',
			'unpublished' => 0,
		));
		$aboutus_de = $de->children()->create(array(
			'alias'		=> 'aboutus',
			'template'	=> 'default',
			'title'		=> 'Über uns',
			'unpublished' => 2,
		));
		
		$aboutus_en->children()->create(array(
			'alias'		=> 'friedrich',
			'template'	=> 'default',
			'title'		=> 'Friedrich',
			'unpublished' => 0,
		));
		$aboutus_de->children()->create(array(
			'alias'		=> 'friedrich',
			'template'	=> 'default',
			'title'		=> 'Overlord',
			'unpublished' => 1,
		));
		
		$aboutus_en->children()->create(array(
			'alias'		=> 'david',
			'template'	=> 'default',
			'title'		=> 'David',
			'unpublished' => 0,
		));
		$aboutus_de->children()->create(array(
			'alias'		=> 'david',
			'template'	=> 'default',
			'title'		=> 'David',
			'unpublished' => 1,
		));
		
	}

}