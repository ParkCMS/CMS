<?php

namespace Parkcms\Programs\Admin\Fields;

class SelectChange extends FormField
{
    protected $properties = array(
        'name'  => '',
        'values' => array(),
        'value' => null,
        'label' => false,
        'type'  => 'text'
    );

    protected $template = "selectchange";

    /*
     * Interface Methods
     */

    public function create(array $properties) {
        $this->properties = $properties + $this->properties;
    }
}