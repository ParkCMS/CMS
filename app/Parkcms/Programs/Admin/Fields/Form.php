<?php

namespace Parkcms\Programs\Admin\Fields;

use Illuminate\Foundation\Application as App;
use Illuminate\Http\Request as Input;
use Illuminate\View\Environment as View;
use Illuminate\Html\HtmlBuilder as Html;
use Illuminate\Support\Contracts\JsonableInterface;

use Parkcms\Programs\Admin\Field;

class Form implements Field, JsonableInterface
{
    private $input;
    private $view;
    private $editor;
    private $html;

    private $fields;
    protected $properties = array(
        'name' => 'form',
        'class' => '',
        'value' => '',
        'label' => false,
        'disabled' => false
    );

    private $attributes = array(
        'method' => 'get'
    );

    public function __construct(Input $input, View $v, Html $html, App $app)
    {
        $this->input = $input;
        $this->view = $v;
        $this->html = $html;
        $this->editor = $app->make('pcms-editor');
    }

    public function create(array $properties) {
        $this->properties = $properties + $this->properties;
    }

    public function addFields(\Closure $fieldClosure)
    {
        $fieldClosure($this);
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

    public function addSubmit($label)
    {
        $btn = $this->addField('Button', array('name' => 'submit', 'value' => $label, 'type' => 'submit'));
    }

    public function addButton($label, $name, $action, $params = array())
    {
        $btn = $this->addField('Button', array('name' => $name, 'value' => $label, 'type' => 'button'));
        $btn->setAttribute('load-action', $action);
        if (!empty($params)) {
            $btn->setAttribute('load-params', json_encode($params));
        }
    }

    public function setAction($action)
    {
        $this->setAttribute('editor-action', $action);
    }

    public function setMethod($method)
    {
        $this->setAttribute('method', strtolower($method));
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

    public function render()
    {
        $attributes = $this->html->attributes($this->attributes);
        return $this->view->make('fields::form', array(
            'fields' => $this->fields,
            'attributes' => $attributes
        ));
    }

    public function toJson($options = 0)
    {
        $template = $this->render()->render();
        $data = array();
        foreach ($this->fields as $field) {
            $data[$field->getName()] = $field->getValue();
        }
        return json_encode(array('data' => $data, 'template' => $template), $options);
    }
}