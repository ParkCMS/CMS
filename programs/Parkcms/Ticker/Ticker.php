<?php

namespace Programs\Parkcms\Ticker;

use Parkcms\Context;
use Parkcms\Programs\ProgramAbstract;

use Programs\Parkcms\Ticker\Models\Ticker as Model;

use View;

class Ticker extends ProgramAbstract {

    protected $context;
    protected $ticker;

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

        if(!$this->findModel($identifier)) {
            return false;
        }

        if(!$this->findView($identifier)) {
            return false;
        }
        
        return true;
    }
    
    /**
     * renders the program and returns the result
     * @return string
     */
    public function render($inlineTemplate = null) {
        return View::make('parkcms-ticker::' . $this->identifier, array(
            'ticker' => $this->ticker,
        ))->render();
    }

    /**
     * searchs model for given identifier and returns success
     * @param  string $identifier
     * @return bool
     */
    protected function findModel($identifier) {
        if(strpos($identifier, "global") === 0) {
            $this->ticker = Model::where(
                'identifier', $this->context->lang() . '-' . $identifier
            )->with('items')->first();
        } else {
            $this->ticker = Model::where(
                'identifier', $this->context->lang() . '-' . $this->context->route() . '-' . $identifier
            )->with('items')->first();
        }

        if(is_null($this->ticker)) {
            return false;
        }

        return true;
    }

    /**
     * searchs view for given identifier and returns success
     * @param  string $identifier
     * @return bool
     */
    protected function findView($identifier) {
        try {
            View::getFinder()->find('parkcms-ticker::' . $identifier);
            return true;
        } catch(\InvalidArgumentException $e) {
            return false;
        }
    }
}
