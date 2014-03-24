<?php

namespace Parkcms\Programs\Cool\Ns;

use Parkcms\Programs\ProgramInterface;

class Program implements ProgramInterface {
    /**
     * initialize the program and returns true at success
     * @param  string $identifier
     * @param  array  $params
     * @return true|false
     */
    public function initialize($identifier, array $params) {
        return $identifier == "p1";
    }
    
    /**
     * renders the program and returns the result
     * @return string
     */
    public function render(){
        return "I'm so cool!";
    }
}
