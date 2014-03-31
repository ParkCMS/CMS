<?php

namespace Parkcms\Programs;

use URL;
use View;

abstract class ProgramAbstract implements ProgramInterface {
    
    protected $context;
    protected $identifier;

    public function initialize($identifier, array $params) {
        $this->identifier = $identifier;

        View::share('p', $this);
    }

    public function url() {

        $class = str_replace('\\', '-', strtolower(str_replace('Programs\\Parkcms\\', '', get_called_class())));

        return URL::to('/api/program/' . $this->context->lang() . '/' . $this->context->route() . '/' . $class . '/' . $this->identifier);
    }

}
