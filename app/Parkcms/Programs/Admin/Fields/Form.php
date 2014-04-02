<?php

namespace Parkcms\Programs\Admin\Fields;

use Illuminate\Foundation\Application as App;
use Illuminate\Http\Request as Input;
use Illuminate\View\Environment as View;

use Parkcms\Programs\Admin\Field;

class Form implements Field
{
    private $input;
    private $view;
    private $editor;
    private $fields;
    private $properties = array(
        'name' => '',
        'class' => '',
        'value' => '',
        'label' => false,
        'disabled' => false
    );

    public function __construct(Input $input, View $v, App $app)
    {
        $this->input = $input;
        $this->view = $v;
        $this->editor = $app->make('pcms-editor');
    }

    public function create(array $properties) {
        $this->properties = $properties + $this->properties;
    }

    public function addFields(\Closure $fieldClosure)
    {
        $fieldClosure($this);
        //$this->addField();
    }

    public function addField($type, $properties)
    {
        $field = $this->editor->makeField($type);

        if(!($field instanceof FormField)) {
            throw new InvalidArgumentException('You can only add FormFields to form!');
        }

        $field->create($properties);

        $this->fields[] = $field;

        return $field;
    }

    public function value() {

    }

    public function render() {
        $this->properties['class'] .= ' form-control';
        return $this->view->make('fields::form', array(
            'fields' => $this->fields
        ));
    }
}