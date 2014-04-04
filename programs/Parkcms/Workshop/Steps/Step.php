<?php

namespace Programs\Parkcms\Workshop\Steps;

use Programs\Parkcms\Workshop\Workshop as Program;
use Programs\Parkcms\Workshop\Models\Workshop;

use Session;
use View;
use URL;

abstract class Step {
    
    public $next;
    public $prev;

    protected $program;
    protected $workshop;

    public final function setProgram(Program $program) {
        $this->program = $program;
    }

    public final function setWorkshop(Workshop $workshop) {
        $this->workshop = $workshop;
    }

    public function name() {
        $tmp = explode('\\', get_called_class());
        return strtolower(end($tmp));
    }

    public final function next($next) {
        if($next instanceof Step) {
            $this->next = $next;
        }
    }

    public final function prev($prev) {
        if($prev instanceof Step) {
            $this->prev = $prev;
        }
    }

    public final function checkAll($returnStep = false) {
        if(!is_null($this->prev)) {
            $prev = $this->prev->checkAll($returnStep);
            if(($returnStep && $prev !== null) || (!$returnStep && $prev === false)) {
                return $prev;
            }
        }

        if($returnStep) {
            return !$this->check() ? $this->name() : null;
        } else {
            return $this->check();
        }
    }

    public abstract function validate();
    public abstract function perform();

    public function check($checked = null) {
        if(!is_null($checked)) {
            return Session::put($this->workshop->identifier . '.checked.' . $this->name(), $checked);
        }
        return Session::get($this->workshop->identifier . '.checked.' . $this->name(), false);
    }

    public function clear() {
        Session::forget($this->identifier . '.' . $this->name());
    }

    public function clearAll() {
        Session::forget($this->workshop->identifier);
    }

    public function set($key, $value) {
        return Session::put($this->workshop->identifier . '.' . $this->name() . '.' . $key, $value);
    }

    public function get($key) {
        return Session::get($this->workshop->identifier . '.' . $this->name() . '.' . $key);
    }

    public function getAll() {
        return Session::get($this->workshop->identifier . '.' . $this->name());
    }

    public function delete($key) {
        Session::forget($this->workshop->identifier . '.' . $this->name() . '.' . $key);
    }

    public function render() {
        return View::make('parkcms-workshop::' . $this->workshop->identifier .  '.' . $this->name(), array(
            'workshop' => $this->workshop,
            'first'    => $this->program->url(array('step' => 'index')),
            'previous' => $this->prev === null ? null : $this->program->url(array('step' => $this->prev->name())),
            'next'     => $this->next === null ? null : $this->program->url(array('step' => $this->next->name())),
        ))->render();
    }
}
