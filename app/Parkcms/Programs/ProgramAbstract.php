<?php

namespace Parkcms\Programs;

use URL;
use View;

abstract class ProgramAbstract implements ProgramInterface {
    
    protected $context;
    protected $identifier;

    public function initialize($identifier, array $params) {
        $this->identifier = $identifier;
        $pi = $this->generateProgramIdentifier();
        $pp = $this->progPath();
        $theme = $this->context->theme();

        $paths = array(base_path('programs/' . $pp), public_path('themes/' . $theme . 'views/' . $pp));

        View::addNamespace($pi, $paths);
        View::share('p', $this);
    }

    public function url() {

        $class = str_replace('\\', '-', strtolower(str_replace('Programs\\Parkcms\\', '', get_called_class())));

        return URL::to('/api/program/' . $this->context->lang() . '/' . $this->context->route() . '/' . $class . '/' . $this->identifier);
    }

    public function generateProgramIdentifier()
    {
        return str_replace('\\', '-', strtolower(str_replace('Programs\\', '', get_called_class())));
    }

    protected function progPath()
    {
        return dirname(str_replace('\\', '/', str_replace('Programs\\', '', get_called_class())));
    }

}
