<?php

use Parkcms\Models\Page;
use Parkcms\Context;
use Parkcms\Programs\Manager;

class ProgramController extends Controller {

    protected $manager;
    protected $root;
    protected $page;
    protected $program;

    public function __construct(Manager $manager) {
        $this->manager = $manager;
    }

    public function render($lang, $route, $type, $identifier, $attributes = null) {
        if($attributes !== null) {
            $attributes = explode('/', $attributes);
        } else {
            $attributes = array();
        }

        $this->lookupRoot($lang);

        $this->lookupPage($route, $attributes);

        $this->lookupProgram($type, $identifier);

        return $this->program->render();
    }

    protected function lookupRoot($lang) {
        $this->root = Page::roots()->where('title', $lang)->first();

        if($this->root === null) {
            App::abort(404);
        }

        App::setLocale($this->root->title);
    }

    protected function lookupPage($route, $attributes) {
        $this->page = $this->root->descendants()->where('alias', $route)->first();
        
        if(is_null($this->page)) {
            App::abort(404);
        }

        App::instance('Parkcms\Context', new Context($route, $this->page, $attributes));
    }

    protected function lookupProgram($type, $identifier) {
        $this->program = $this->manager->lookup($type, $identifier, array());

        if(is_null($this->program)) {
            App::abort(404);
        }
    }
}
