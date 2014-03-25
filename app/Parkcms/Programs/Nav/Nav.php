<?php

namespace Parkcms\Programs\Nav;

use Parkcms\Programs\ProgramInterface;
use Parkcms\Models\Page;
use Parkcms\Context;

use URL;

class Nav implements ProgramInterface {

    protected $context;
    protected $content;

    public function __construct(Context $context) {
        $this->context = $context;
    }
    
    public function initialize($identifier, array $params) {

        $root = Page::roots()->where('title', $this->context->lang())->first();

        $descendants = $root->descendants();

        $this->content = '<div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Brand</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">';

        $depth = 0;
        foreach($descendants->get() as $descendant) {
            
            $this->closeLIUL($depth, $descendant->depth);

            $this->content.= '<li' . $this->classes($descendant) . '>';
            $this->content.= '<a href="' . URL::to($this->context->lang() . '/' . $descendant->alias) . '"';

            if($this->hasChildren($descendant)) {
                $this->content.= ' class="dropdown-toggle" data-toggle="dropdown"';
            }
            $this->content.= '>' . $descendant->title;

            if($this->hasChildren($descendant)) {
                $this->content.= ' <b class="caret"></b>';
            }

            $this->content.= '</a>';

            if($this->hasChildren($descendant)) {
                $this->content.= '<ul class="dropdown-menu">';
            } else {
                $this->content.= '</li>';
            }

            $depth = $descendant->depth;
        }

        if($depth > 0) {
            $this->content.= '</ul>';
            $depth--;
        }

        $this->closeLIUL($depth);

        $this->content.= '</div></div>';

        return true;
    }

    public function render() {
        return $this->content;
    }

    protected function closeLIUL(&$depth, $targetDepth = 0) {
        while($depth > $targetDepth) {
            $this->content.= '</li></ul>';
            $depth--;
        }
    }

    protected function classes(Page $page) {
        $classes = '';

        if($this->hasChildren($page)) {
            $classes.= 'dropdown';
        }
        if($this->active($page)) {
            $classes.= ' active';
        }

        if($classes != '') {
            return ' class="' . $classes . '"';
        }

        return '';
    }

    protected function hasChildren(Page $page) {
        return ($page->rgt - $page->lft) > 1;
    }

    protected function active(Page $page) {
        return $page->alias == $this->context->page()->alias || $page->isAncestorOf($this->context->page());
    }
}
