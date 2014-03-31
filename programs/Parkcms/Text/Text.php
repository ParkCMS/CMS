<?php

namespace Programs\Parkcms\Text;

use Parkcms\Context;
use Parkcms\Programs\ProgramAbstract;

class Text extends ProgramAbstract {

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
        return $this->context->ajax() ? $this->content->toJson() : $this->content->text;
    }
}
