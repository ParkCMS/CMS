<?php

namespace Parkcms\Programs\Workshop;

use Parkcms\Context;
use Parkcms\Programs\ProgramAbstract;

use Parkcms\Programs\Workshop\Models\Workshop as Model;

use View;
use Input;

class Workshop extends ProgramAbstract {

    protected $context;
    protected $workshop;
    protected $input;

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

        View::addNamespace('workshops', public_path() . '/themes/default/views/workshops/');

        $this->workshop = Model::with('parts')->where('identifier', $identifier)->where('active', true)->first();

        if(is_null($this->workshop)) {
            return false;
        }

        return true;
    }
    
    /**
     * renders the program and returns the result
     * @return string
     */
    public function render() {

        $this->watchInput();

        switch($this->input) {
            case 'register':
                return $this->renderRegisterForm();

            case 'check':
                return $this->renderRegisterCheck();

            case 'parts':
                return $this->renderPartsForm();

            case 'pay':
                return $this->renderPayment();

            case 'index':
            default:
                return $this->renderIndex();
        }
    }

    public function renderIndex() {
        return View::make('workshops::' . $this->workshop->identifier . '.index', array(
            'workshop' => $this->workshop
        ))->render();
    }

    public function renderRegisterForm() {
        return View::make('workshops::' . $this->workshop->identifier . '.registration', array(
            'workshop' => $this->workshop
        ))->render();
    }

    public function renderPartsForm() {
        return View::make('workshops::' . $this->workshop->identifier . '.parts', array(
            'workshop' => $this->workshop
        ))->render();
    }

    public function renderRegisterCheck() {
        return View::make('workshops::' . $this->workshop->identifier . '.check', array(
            'workshop' => $this->workshop
        ))->render();
    }

    public function watchInput() {
        if($tmp = Input::get('workshop')) {
            if(isset($tmp[$this->workshop->identifier])) {
                $this->input = $tmp[$this->workshop->identifier];
            }
        }
    }
}
