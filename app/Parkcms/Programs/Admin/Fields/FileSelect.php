<?php

namespace Parkcms\Programs\Admin\Fields;

use Illuminate\Http\Request as Input;
use Illuminate\View\Environment as View;
use Illuminate\Html\HtmlBuilder as Html;

use Parkcms\Programs\Admin\Field;

class FileSelect implements Field
{
    protected $input;
    protected $view;
    protected $html;

    protected $attributes = array(
        'class' => ''
    );

    private $properties = array(
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

    /*
     * Interface Methods
     */

    public function create(array $properties) {
        $this->properties = $properties + $this->properties;
    }

    public function value() {

    }

    public function render() {
        $attributes = $this->html->attributes($this->attributes);
        return $this->view->make('fields::fileselect', $this->properties + array(
            'attributes' => $attributes
        );
    }
}