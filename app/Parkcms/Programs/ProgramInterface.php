<?php

namespace Parkcms\Programs;

interface ProgramInterface {
    
    /**
     * initialize the program and returns true at success
     * @param  string $identifier
     * @param  array  $params
     * @return true|false
     */
    public function initialize($identifier, array $params);
    
    /**
     * renders the program and returns the result
     * @return string
     */
    public function render($inlineTemplate = null);
    
}
