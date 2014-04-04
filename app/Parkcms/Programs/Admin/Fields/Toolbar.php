<?php

namespace Parkcms\Programs\Admin\Fields;

use Illuminate\Http\Request as Input;
use Illuminate\View\Environment as View;
use Illuminate\Html\HtmlBuilder as Html;

use Parkcms\Programs\Admin\Field;

class Toolbar implements Field
{
    protected $input;
    protected $view;
    protected $html;

    protected $attributes = array(
        'class' => ''
    );

    private $properties = array(
        'name' => 'toolbar',
    );

    private $buttons = array();

    public function __construct(Input $input, View $v, Html $html)
    {
        $this->input = $input;
        $this->view = $v;
        $this->html = $html;
    }

    public function setAttribute($key, $value)
    {
        $this->attributes[$key] = $value;
    }

    public function getAttribute($key)
    {
        return $this->attributes[$key];
    }

    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes + $this->attributes;
    }

    public function addButton($title, $icon='asterisk', array $action = array())
    {
        $this->buttons[] = array(
            'title' => $title,
            'icon' => $icon,
            'actions' => $this->html->attributes($action)
        );
    }

    /*
     * Interface Methods
     */

    public function create(array $properties)
    {
        $this->properties = $properties + $this->properties;
    }

    public function value()
    {

    }

    public function render()
    {
        return $this->view->make(
            'fields::toolbar',
            $this->properties + array('buttons' => $this->buttons)
        );
    }
}