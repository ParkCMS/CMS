<?php

namespace Programs\Parkcms\Workshop\Input;

use Session;
use Request;

class Manager {
    
    /**
     * stores the session key dot notated
     * @var string
     */
    protected $sessionKey;

    /**
     * holds the validation object
     * @var Parkcms\Programs\Workshop\Input\Validation
     */
    protected $validation;

    /**
     * stores all steps
     * @var array
     */
    protected $steps;

    /**
     * stores current step
     * @var string
     */
    protected $step;

    public function __construct(Validation $validation) {
        $this->validation = $validation;
    }

    /**
     * Returns validation object
     * @param Parkcms\Programs\Workshop\Input\Validation
     */
    public function validation() {
        return $this->validation;
    }

    /**
     * Sets steps to given array
     * @param array $steps
     */
    public function setSteps(array $steps) {
        $this->steps = $steps;
    }

    /**
     * Sets current step
     * @param string $step
     */
    public function setStep($step) {
        $this->step = $step;
    }

    /**
     * Returns current step
     * @return string
     */
    public function getStep() {
        return $this->step;
    }

    /**
     * Checks all steps until current
     * and sets $step to first failed
     */
    public function check() {
        foreach($this->steps as $step) {
            if($step == $this->step) {
                return;
            }

            if(!$this->validation()->get('checked', $step, false)) {
                $this->setStep($step);
                return;
            }
        }
    }

    /**
     * Validates input from previous step
     */
    public function validatePrevious() {
        $previousStep = $this->previousStep($this->step);

        if(Request::isMethod('get') && $previousStep != $this->steps[0]) {
            return;
        }

        if($this->validation->validate($previousStep)) {
            $this->validation()->store('checked', $previousStep, true);
        } else {
            $this->validation()->store('checked', $previousStep, false);
        }
    }

    /**
     * Return previous step relative to given step
     * if exists otherwise null
     * @param  string $step
     * @return string|null
     */
    public function previousStep($step) {
        $previous = null;

        $index = 0;
        $current = $this->steps[$index];
        while($current != $step) {
            $previous = $current;
            $current = $this->steps[++$index];
        }

        return $previous;
    }

    /**
     * Return next step relative to given step
     * if exists otherwise null
     * @param  string $step
     * @return string|null
     */
    public function nextStep($step) {
        $index = 0;
        
        do {
            $current = $this->steps[$index];
            $next = isset($this->steps[$index + 1]) ? $this->steps[$index + 1] : null;

            $index++;
        } while($current != $step);

        return $next;
    }

    public function clear() {
        return $this->validation->clear();
    }

    public function store($key, $value) {
        return $this->validation->store($this->step, $key, $value);
    }

    public function get($key, $default = '') {
        return $this->validation->get($this->step, $key, $default);
    }

    public function getAll() {
        return $this->validation->getAll($this->step);
    }

    public function delete($key) {
        return $this->validation->delete($this->step, $key);
    }
}
