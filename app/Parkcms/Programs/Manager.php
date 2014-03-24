<?php

namespace Parkcms\Programs;

use Parkcms\Context;
use ReflectionException;

use App;

class Manager {
    
    protected $context;
    
    /**
     * look up for a program an return it at success else null
     * @param  string $type program type (e.g. text)
     * @param  [type] $identifier program identifier
     * @param  array  $params additional parameters
     * @return null|Parkcms\Programs\ProgramInterface
     */
    public function lookup($type, $identifier, array $params) {
        try {


            $program = App::make('Parkcms\Programs\\' . ucfirst($type));
            
            if(!($program instanceof ProgramInterface)) {
                return null;
            }
            
            if(!$program->initialize($identifier, $params)) {
                return null;
            }
            
            return $program;
        } catch(ReflectionException $e) { }
        
        return null;
    }
    
    protected function name($type) {
        
    }
}
