<?php

namespace Parkcms\Programs\Workshop\Input;

use Illuminate\Validation\Factory;
use Parkcms\Programs\Workshop\Models\Workshop;
use Parkcms\Programs\Workshop\Models\Part;

use Input;
use Session;

class Validation {

    protected $factory;

    protected $validator;

    public function __construct(Factory $factory) {
        $this->factory = $factory;
    }

    /**
     * validates given step and returns true by succes
     * otherwise false
     * @param  string $step
     * @return bool
     */
    public function validate($step) {

        $method = 'validate' . ucfirst($step);

        if(!method_exists($this, $method)) {
            return false;
        }

        return $this->$method();
    }

    /**
     * validates index step
     * @return bool
     */
    public function validateIndex() {
        return true;
    }

    /**
     * validates register step
     * @return bool
     */
    protected function validateRegister() {
        
        foreach(Input::only('title', 'surname', 'firstname', 'middlename', 'email', 'address', 'city', 'zip', 'institution') as $key=>$value) {
            $this->store('register', $key, $value);
        }

        $this->validator = $this->factory->make(
            $this->getAll('register'),
            array(
                'surname' => 'required|min:2',
                'firstname' => 'required|min:5',
                'address' => 'required|min:5',
                'city' => 'required|min:5',
                'zip' => 'required|integer',
                'email' => 'required|email'
            )
        );

        return !$this->validator->fails();
    }

    protected function validateParts() {
        $checkedParts = Input::get('parts', array());

        foreach ($this->workshop->parts as $part) {
            if(isset($checkedParts[$part->id])) {
                if($this->validPartValue($part, $checkedParts[$part->id])) {
                    unset($checkedParts[$part->id]);
                    $this->store('parts', $part->id, true);
                }
            } else {
                $this->delete('parts', $part->id);
            }
        }

        return count($checkedParts) == 0;
    }

    protected function validPartValue(Part $part, $value) {
        if($part->part_type == 1) {
            return $value == 0 || $value == 1;
        } else if($part->part_type == 2) {
            $values = array_map('trim', explode(',', $part->select_values));

            return in_array($value, $values);
        }
    }

    protected function validateCheck() {
        $this->validator = $this->factory->make(
            Input::only('accept_terms'),
            array(
                'accept_terms' => 'required'
            )
        );

        return !$this->validator->fails();
    }

    public function failed($key) {
        if(is_null($this->validator)) {
            return false;
        }

        $failed = $this->validator->failed();

        return isset($failed[$key]);
    }

    public function message($key = null) {
        if(is_null($this->validator)) {
            return '';
        }
        
        if($this->validator->messages()->has($key)) {
            return $this->validator->messages()->first($key);
        }

        return '';
    }

    public function setWorkshop(Workshop $workshop) {
        $this->workshop = $workshop;
    }

    /**
     * Sets session key using dot notation
     * @param string $key
     */
    public function setSessionKey($key) {
        $this->sessionKey = $key;
    }

    public function clear() {
        Session::forget($this->sessionKey . '.data');
    }

    public function store($group, $key, $value) {
        return Session::put($this->sessionKey . '.data.' . $group . '.' . $key, $value);
    }

    public function get($group, $key, $default = '') {
        return Session::get($this->sessionKey . '.data.' . $group . '.' . $key, $default);
    }

    public function getAll($group) {
        return Session::get($this->sessionKey . '.data.' . $group);
    }

    public function delete($group, $key) {
        Session::forget($this->sessionKey . '.data.' . $group . '.' . $key);
    }
}
