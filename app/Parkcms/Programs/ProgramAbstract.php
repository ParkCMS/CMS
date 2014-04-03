<?php

namespace Parkcms\Programs;

use Lang;
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

        $paths = array(
            public_path('themes/' . $theme . '/views/' . $pp), // Theme overrides...
            base_path('programs/' . $pp . '/views')            // Package views
        );

        View::addNamespace($pi, $paths);
        View::share('p', $this);

        Lang::addNamespace($pi, base_path('programs/' . $pp . '/lang'));
    }

    public function url(array $params = array(), $api = false) {
        if($api) {
            $class = str_replace('\\', '-', strtolower(str_replace('Programs\\Parkcms\\', '', get_called_class())));

            return URL::to('/api/program/' . $this->context->lang() . '/' . $this->context->route() . '/' . $class . '/' . $this->identifier);
        }

        if(!empty($params)) {
            $params = http_build_query(array_merge(array('identifier' => $this->identifier), $params), '', '&amp;');
        } else {
            $params = 'identifier=' . $this->identifier;
        }

        return URL::to('/' . $this->context->lang() . '/' . $this->context->route() . '?' . $params);
    }

    public function generateProgramIdentifier()
    {
        return str_replace('/', '-', strtolower($this->progPath()));
    }

    protected function progPath()
    {
        return dirname(str_replace('\\', '/', str_replace('Programs\\', '', get_called_class())));
    }

}
