<?php

namespace Parkcms;

use Parkcms\Models\Page;

use Request;

class Context {
    
    protected $route;
    protected $page;
    protected $ajax;
    
    /**
     * [__construct description]
     * @param string $route
     * @param Page   $page
     */
    public function __construct($route, Page $page) {
        $this->route = $route;
        $this->page = $page;
        
        $this->ajax = Request::ajax();
    }
    
    /**
     * returns the route from the given context
     * @return string
     */
    public function route() {
        return $this->route;
    }
    
    /**
     * returns the page object from the given context
     * @return Parkcms\Models\Page
     */
    public function page() {
        return $this->page;
    }
    
    /**
     * determine whether the given context is called via ajax or not
     * @return bool
     */
    public function ajax() {
        return $this->ajax;
    }
    
}
