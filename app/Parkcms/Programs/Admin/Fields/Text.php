<?php

namespace Parkcms\Programs\Admin\Fields;

class Text extends FormField
{
    protected $properties = array(
        'name'  => '',
        'value' => '',
        'label' => false,
        'type'  => 'text'
    );

    protected $template = "text";

    public function create(array $properties) {
        $this->properties = $properties + $this->properties;
        $this->setAttribute('class', 'form-control');
    }

    public function value() {
        return $this->input->get($this->properties['name']);
    }
}