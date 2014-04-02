<?php

namespace Parkcms\Programs\Admin\Fields;

class Button extends FormField
{
    protected $properties = array(
        'name' => '',
        'value' => '',
        'type'  => 'button',
        'label' => false
    );

    protected $template = "button";

    public function create(array $properties) {
        $this->properties = $properties + $this->properties;
        if (strtolower($this->properties['type']) == 'submit') {
            $this->setAttribute('class', 'btn btn-primary');
        } else {
            $this->setAttribute('class', 'btn btn-default');
        }
    }

    public function value() {
        return $this->input->get($this->properties['name']);
    }
}