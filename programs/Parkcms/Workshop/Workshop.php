<?php

namespace Programs\Parkcms\Workshop;

use Parkcms\Programs\ProgramAbstract;

use Parkcms\Context;
use Programs\Parkcms\Workshop\Input\Manager;

use Programs\Parkcms\Workshop\Models\Workshop as WorkshopModel;
use Programs\Parkcms\Workshop\Models\Part;
use Programs\Parkcms\Workshop\Models\Registration;

use Asset;
use Input;
use View;

class Workshop extends ProgramAbstract {

    protected $workshop;

    protected $context;
    protected $manager;

    protected $steps = array('index', 'register', 'parts', 'check', 'pay', 'complete');

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
    public function render($inlineTemplate = null) {
        if($step = Input::get(
            'workshop.' . $this->workshop->identifier,
            $this->steps[0]
        )) {
            if(!$this->validStep($step)) {
                $step = $this->steps[0];
            }
        }

        if($this->workshop->isFullOrClosed()) {
            $step = 'index';
        }

        $step = $this->manager->setStep($step);

        $this->manager->validatePrevious();
        $this->manager->check();

        if($this->manager->getStep() == end($this->steps)) {
            $this->complete();
        }
        
        return $this->renderStep($this->manager->getStep());
    }

    public function complete() {
        $this->check();

        if($this->step != end($this->steps)) {
            return;
        }

        foreach($workshop->parts as $part) {
            if($part->partType == 2) {
                
            }
            $part->registrations()->attach(1, array('amount' => $expires));
        }

        $registration = Registration
    }

    /**
     * checks if the given step exists
     * @param  string $step
     * @return bool
     */
    protected function validStep($step) {
        return in_array($step, $this->steps);
    }

    /**
     * renders view of given step and returns result
     * @param  string $step
     * @return string
     */
    protected function renderStep($step) {

        $previousStep = $this->manager->previousStep($step);
        $nextStep = $this->manager->nextStep($step);

        return View::make('parkcms-workshop::' . $this->workshop->identifier . '.' . $step, array(
            'workshop' => $this->workshop,
            'previous' => $previousStep === null ? null : $this->url() . '?workshop[' . $this->workshop->identifier . ']=' . $previousStep,
            'next' => $nextStep === null ? null : $this->url() . '?workshop[' . $this->workshop->identifier . ']=' . $nextStep,
        ))->render();
    }

    /**
     * See Programs\Parkcms\Workshop\Input\Validation->failed($key)
     * @param  string $key
     * @return bool
     */
    public function failed($key) {
        return $this->manager->validation()->failed($key);
    }

    /**
     * See Programs\Parkcms\Workshop\Input\Validation->message($key)
     * @param  string $key
     * @return string
     */
    public function message($key) {
        return $this->manager->validation()->message($key);
    }

    /**
     * See Programs\Parkcms\Workshop\Input\Manager->get($key, $default)
     * @param  string $key
     * @return string
     */
    public function get($key, $default = '') {
        return $this->manager->get($key, $default);
    }
}
