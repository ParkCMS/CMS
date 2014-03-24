<?php

use Parkcms\Models\Page;

use Parkcms\Context;
use Parkcms\Template\AttributeParser as Parser;
use Parkcms\Programs\Manager;

/**
 * 
 */
class PageController extends BaseController {
    
    protected $parser;
    protected $manager;

    protected $page;

    /**
     * 
     * @param Parser  $parser
     * @param Manager $manager
     */
    public function __construct(Parser $parser, Manager $manager) {
        $this->parser = $parser;
        $this->manager = $manager;
        
        $this->parser->setPrefix('pcms-');
    }
    
    /**
     * display the page, found by given route
     * @param  string $route page route (e.g. home)
     * @param  string $attributes atributes slash imploded (e.g. year/2014)
     * @return string rendered page
     */
    public function showPage($route, $attributes = null)
    {
        if($attributes !== null) {
            $attributes = explode('/', $attributes);
        }
        
        // @TODO: determine real user language
        $lang = 'de';
        
        // look up page tree root determined by user language
        $root = Page::roots()->where('title', $lang)->first();
        
        // look up 
        $this->page = $root->descendants()->where('alias', $route)->first();
        
        // Register objects to the IoC
        App::instance('Parkcms\Models\Page', $this->page);
        App::instance('Parkcms\Context', new Context($route, $this->page));
        

        if($this->page !== null) {
            return $this->renderTemplate();
        }
    }

    protected function renderTemplate() {
        $view = View::make('layout')->nest('body', 'page_templates.' . $this->page->template)->render();

        $this->parser->setSource($view);

        $that = $this;
        $this->parser->pushHandler(function($type, $identifier, $data, $nodeValue) use($that) {
            if($program = $that->manager->lookup($type, $identifier, $data)) {
                return $program->render();
            }
            return null;
        });

        return $this->parser->parse();
    }
}
