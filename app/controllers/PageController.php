<?php

use Parkcms\Models\Page;

use Parkcms\Template\AttributeParser as Parser;

//use App;

class PageController extends BaseController {
	
	protected $parser;
	
	public function __construct(Parser $parser) {
		$this->parser = $parser;
	}
	
	public function showPage($route)
	{
		$lang = 'de'; // magic to get lang
		
		$root = Page::roots()->where('title', $lang)->first();
		
		App::instance('Parkcms\Models\Page', $root);
		
		$page = $root->children()->where('alias', $route)->first();
		
		if($page !== null) {
			// var_dump($this->_route->page->route);
			
			// var_dump($this->_route->params());
			
			$view = View::make('layout')->nest('body', 'page_templates.' . $page->template)->render();
			
			$this->parser->setSource($view);
			
			$this->parser->pushHandler(function($type, $identifier, $data, $nodeValue) {
				if($program = ProgramManager::load($type, $identifier, $data)) {
					return $program->content();
				}
				return null;
			});
			
			return $this->parser->parse();
		}
	}
}
