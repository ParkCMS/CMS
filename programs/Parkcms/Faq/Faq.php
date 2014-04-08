<?php

namespace Programs\Parkcms\Faq;

use Parkcms\Context;
use Parkcms\Programs\ProgramAbstract;

use Programs\Parkcms\Faq\Models\Faq as Model;

use View;

class Faq extends ProgramAbstract {
    protected $context;

    protected $faq;

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
        parent::initialize($identifier, $params);

        if(strpos($identifier, "global") === 0) {
            $this->faq = Model::with('questions')->where('identifier', $this->context->lang() . '-' . $identifier)->first();
        } else {
            $this->faq = Model::with('questions')->where('identifier', $this->context->lang() . '-' . $this->context->route() . '-' . $identifier)->first();
        }

        if(is_null($this->faq)) {
            return false;
        }

        return true;
    }
    
    /**
     * renders the program and returns the result
     * @return string
     */
    public function render($inlineTemplate = null) {
        return View::make('parkcms-faq::' . $this->identifier, array(
            'faq' => $this->faq,
        ))->render();
    }
}
