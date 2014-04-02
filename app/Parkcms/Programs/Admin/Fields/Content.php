<?php

namespace Parkcms\Programs\Admin\Fields;

use Illuminate\Http\Request as Input;
use Illuminate\View\Environment as View;

use Parkcms\Programs\Admin\Field;

class Content implements Field
{
    private $properties = array(
        'name' => '',
        'class' => '',
        'value' => '',
        'label' => false
    );
    
    public function __construct(Input $input, View $v)
    {
        $this->input = $input;
        $this->view = $v;
    }

    public function create(array $properties) {
        $this->properties = $properties + $this->properties;
    }

    public function value() {

    }

    public function render() {
        $this->properties['class'] .= ' form-control';
        return $this->view->make('fields::content', array(
            'value' => $this->properties['value'],
            'class' => $this->properties['class'],
            'name' => $this->properties['name'],
            'label' => $this->properties['label']
        ));
    }
}