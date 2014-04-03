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

    protected $hasFailed;

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

        $step = $this->getStep();

        $step = $this->manager->setStep($step);

        $this->hasFailed = !$this->manager->validatePrevious();
        $this->manager->check();

        if($this->manager->getStep() == end($this->steps)) {
            $this->complete();
        }
        
        return $this->renderStep($this->manager->getStep());
    }

    protected function complete() {
        $this->manager->check();

        if($this->manager->getStep() != end($this->steps)) {
            $this->manager->setStep($this->steps[0]);
            return;
        }

        $total_amount = 0;
        foreach($this->workshop->parts as $part) {
            if($partValue = $this->manager->validation()->get('parts', $part->id)) {
                $total_amount+= $partValue * $part->price;
            }
        }

        Registration::unguard();

        $registration = new Registration(array(
            'internal_id' => uniqid(),

            'title' => $this->manager->validation()->get('register', 'title'),
            'first_name' => $this->manager->validation()->get('register', 'firstname'),
            'middle_name' => $this->manager->validation()->get('register', 'middlename'),
            'sur_name' => $this->manager->validation()->get('register', 'surname'),

            'address' => $this->manager->validation()->get('register', 'address'),
            'institution' => $this->manager->validation()->get('register', 'institution'),
            'city' => $this->manager->validation()->get('register', 'city'),
            'zip' => $this->manager->validation()->get('register', 'zip'),
            'country' => $this->manager->validation()->get('register', 'country'),

            'email' => $this->manager->validation()->get('register', 'email'),
            'phone' => $this->manager->validation()->get('register', 'phone'),
            'fax' => $this->manager->validation()->get('register', 'fax'),

            'total_amount' => $total_amount,

            'payment_type' => '',
            'payment_data' => '',
        ));

        $registration->save();
        
        foreach($this->workshop->parts as $part) {
            if($partValue = $this->manager->validation()->get('parts', $part->id)) {
                $part->registrations()->attach($registration, array('value' => $partValue));
            }
        }

        $this->manager->clear();
    }

    protected function getStep() {
        if(Input::get('identifier') != $this->workshop->identifier) {
            return $this->steps[0];
        }

        if($step = Input::get(
            'workshop.' . $this->workshop->identifier,
            $this->steps[0]
        )) {
            if(!$this->validStep($step)) {
                return $this->steps[0];
            }
        }

        if($this->workshop->isFullOrClosed()) {
            $step = 'index';
        }

        return $step;
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
            'hasFailed'=> $this->hasFailed,
            'first'    => $this->url(array('workshop' => array(
                    $this->workshop->identifier => $this->steps[0]
                ))),
            'previous' => $previousStep === null ? null : $this->url(array('workshop' => array(
                    $this->workshop->identifier => $previousStep
                ))),
            'next'     => $nextStep === null ? null : $this->url(array('workshop' => array(
                    $this->workshop->identifier => $nextStep
                ))),
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
