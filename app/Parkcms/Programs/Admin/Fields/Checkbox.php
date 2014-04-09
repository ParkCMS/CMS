<?php

namespace Parkcms\Programs\Admin\Fields;

class Checkbox extends FormField
{
    protected $properties = array(
        'name'  => '',
        'value' => '',
        'label' => false,
        'type'  => 'checkbox'
    );

    protected $template = "checkbox";

    public function create(array $properties) {
        $this->properties = $properties + $this->properties;
    }

    public function value() {
        return $this->input->get($this->properties['name']);
    }
}