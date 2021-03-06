<?php

namespace Parkcms\Programs\Admin\Fields;

use Illuminate\Http\Request as Input;
use Illuminate\View\Environment as View;
use Illuminate\Html\HtmlBuilder as Html;

use Parkcms\Programs\Admin\Field;

class Table implements Field
{
    protected $input;
    protected $view;
    protected $html;

    protected $attributes = array(
        'class' => 'table table-striped'
    );

    protected $properties = array(
        'name' => 'form',
    );

    private $headers = array();

    private $keys = array();

    private $rows = null;

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

    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
        $this->keys = array_keys($headers);
    }

    public function setRows($rows)
    {
        $this->rows = $rows;
    }

    public function setButtons(array $buttons)
    {
        for ($i=0; $i < count($buttons); $i++) {
            $buttons[$i]['attributes'] = $this->html->attributes(array_diff_key($buttons[$i], array_flip(array('content'))));
        }
        $this->buttons = $buttons;
    }

    /*
     * Interface Methods
     */

    public function create(array $properties) {
        $this->properties = $properties + $this->properties;
    }

    public function render() {
        $attributes = $this->html->attributes($this->attributes);
        return $this->view->make('fields::table', $this->properties + array(
            'attributes' => $attributes, 'headers' => $this->headers, 'keys' => $this->keys, 'rows' => $this->rows, 'buttons' => $this->buttons));
    }
}