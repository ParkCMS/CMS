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
        'name'      => '',
        'select'    => 'files', // Possible values: files (only files), directories (only directories) or both
        'types'     => array() // Specify an array of MIME Types to filter by
    );

    protected $template = "fileselect";

    /*
     * Interface Methods
     */

    public function create(array $properties) {
        $this->properties = $properties + $this->properties;
    }
}