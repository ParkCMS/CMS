<?php

namespace Parkcms\Programs\Workshop;

use Parkcms\Programs\ProgramAbstract;

use Parkcms\Context;
use Parkcms\Programs\Workshop\Input\Manager;

use Parkcms\Programs\Workshop\Models\Workshop as WorkshopModel;
use Parkcms\Programs\Workshop\Models\Part;
use Parkcms\Programs\Workshop\Models\Registration;

use View;
use Asset;
use Input;

class Workshop extends ProgramAbstract {
    
    protected $workshop;

    protected $context;
    protected $manager;

    protected $steps = array('index', 'register', 'parts', 'check', 'pay');

    public function __construct(Context $context, Manager $manager) {
        $this->context = $context;
        $this->manager = $manager;
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

        $this->workshop = WorkshopModel::with('parts')
            ->where('identifier', $identifier)
            ->where('active', true)->first();

        if(is_null($this->workshop)) {
            return false;
        }

        Asset::script('data-async', 'themes/default/js/data-async.js', array('jquery', 'bootstrap'));

        $this->manager->setSteps($this->steps);

        $this->manager->validation()->setSessionKey('workshops.' . $this->workshop->identifier);
        $this->manager->validation()->setWorkshop($this->workshop);

        return true;
    }
    
    /**
     * renders the program and returns the result
     * @return string
     */
    public function render() {

        if($step = Input::get(
            'workshop.' . $this->workshop->identifier,
            $this->steps[0]
        )) {
            if(!$this->validStep($step)) {
                $step = $this->steps[0];
            }
        }

        $step = $this->manager->setStep($step);

        $this->manager->validatePrevious();
        $this->manager->check();
        
        return $this->renderStep($this->manager->getStep());
    }

    protected function validStep($step) {
        return in_array($step, $this->steps);
    }

    protected function renderStep($step) {

        $previousStep = $this->manager->previousStep($step);
        $nextStep = $this->manager->nextStep($step);

        return View::make('workshops::' . $this->workshop->identifier . '.' . $step, array(
            'workshop' => $this->workshop,
            'previous' => $previousStep === null ? null : $this->url() . '?workshop[' . $this->workshop->identifier . ']=' . $previousStep,
            'next' => $nextStep === null ? null : $this->url() . '?workshop[' . $this->workshop->identifier . ']=' . $nextStep,
        ))->render();
    }

    public function failed($key) {
        return $this->manager->validation()->failed($key);
    }

    public function message($key) {
        return $this->manager->validation()->message($key);
    }

    public function get($key, $default = '') {
        return $this->manager->get($key, $default);
    }
}
