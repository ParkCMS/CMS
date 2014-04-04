<?php

namespace Parkcms\Programs\Admin\Fields;

use Illuminate\Http\Request as Input;
use Illuminate\View\Environment as View;
use Illuminate\Html\HtmlBuilder as Html;

class FileSelect extends FormField
{
    protected $input;
    protected $view;
    protected $html;

    protected $properties = array(
        'name' => '',
    );

    protected $template = "fileselect";

    /*
     * Interface Methods
     */

    public function create(array $properties) {
        $this->properties = $properties + $this->properties;
    }

    public function value() {

    }
}