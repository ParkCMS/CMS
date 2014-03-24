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
            $program = App::make('Parkcms\Programs\\' . $this->name($type));
            
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
        $tmp = array_map(function($str) {
            return ucfirst($str);
        }, explode('-', $type));

        if(count($tmp) == 1) {
            return $tmp[0] . '\\' . $tmp[0];
        }

        return implode('\\', $tmp);
    }
}
