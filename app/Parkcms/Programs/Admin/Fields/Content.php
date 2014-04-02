<?php

namespace Parkcms\Programs\Admin\Fields;

class Content extends FormField
{
    protected $properties = array(
        'name' => '',
        'class' => '',
        'value' => '',
        'label' => false
    );

    protected $template = 'content';

    public function create(array $properties) {
        $this->properties = $properties + $this->properties;
        $this->setAttribute('class', 'form-control');
    }

    public function value() {
        return $this->input->get($this->properties['name']);
    }
}