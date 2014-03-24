<?php

namespace Parkcms\Programs\Text;

use Parkcms\Context;
use Parkcms\Programs\ProgramInterface;

class Text implements ProgramInterface {

    protected $context;
    protected $content;

    public function __construct(Context $context) {
        $this->context = $context;
    }

    /**
     * initialize the program and returns true at success
     * @param  string $identifier
     * @param  array  $params
     * @return true|false
     */
    public function initialize($identifier, array $params) {
        if(strpos($identifier, "global") === 0) {
            return (bool)($this->content = Model::where('identifier', $this->context->lang() . '-' . $identifier)->first());
        }
        
        return (bool)($this->content = Model::where('identifier', $this->context->lang() . '-' . $this->context->route() . '-' . $identifier)->first());
    }
    
    /**
     * renders the program and returns the result
     * @return string
     */
    public function render() {
        return $this->content->text;
    }
}
