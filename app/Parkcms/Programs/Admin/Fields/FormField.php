<?php

namespace Parkcms\Programs\Admin\Fields;

use Illuminate\Http\Request as Input;
use Illuminate\View\Environment as View;
use Illuminate\Html\HtmlBuilder as Html;

use Parkcms\Programs\Admin\Field;

abstract class FormField implements Field
{
    protected $input;
    protected $view;
    protected $html;

    protected $attributes = array(
        'class' => ''
    );

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

    public function setValue($value)
    {
        $this->properties['value'] = $value;
    }

    public function getValue()
    {
        return $this->properties['value'];
    }

    public function getName()
    {
        return $this->properties['name'];
    }

    abstract public function create(array $properties);

    public function render() {
        $attributes = $this->html->attributes($this->attributes);
        return $this->view->make('fields::' . $this->template, $this->properties + array('attributes' => $attributes));
    }
}