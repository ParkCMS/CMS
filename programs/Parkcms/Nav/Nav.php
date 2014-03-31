<?php

namespace Programs\Parkcms\Nav;

use Parkcms\Programs\ProgramAbstract;
use Parkcms\Models\Page;
use Parkcms\Context;

use URL;

class Nav extends ProgramAbstract {

    protected $context;
    protected $content;

    public function __construct(Context $context) {
        $this->context = $context;
    }
    
    public function initialize($identifier, array $params) {

        $root = Page::roots()->where('title', $this->context->lang())->first();

        $descendants = $root->descendants();

        $this->content = '<ul' . (isset($params['class']) ? ' class="nav navbar-nav"' : '') . '>';

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