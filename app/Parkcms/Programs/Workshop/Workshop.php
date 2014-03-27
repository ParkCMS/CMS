<?php

namespace Parkcms\Programs\Workshop;

use Parkcms\Context;
use Parkcms\Programs\ProgramAbstract;

use Parkcms\Programs\Workshop\Models\Workshop as Model;
use Parkcms\Programs\Workshop\Models\Part as Part;

use View;
use Input;
use Session;
use Request;
use Asset;

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

        Asset::script('data-async', 'themes/default/js/data-async.js', array('jquery', 'bootstrap'));

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

            case 'parts':
                if(!$this->checkRegistrationData()) {
                    return $this->renderRegisterForm();
                }
                return $this->renderPartsForm();

            case 'check':
                if(!$this->checkPartsData()) {
                    return $this->renderPartsForm();
                }
                return $this->renderRegisterCheck();

            case 'pay':
                return $this->renderPayment();

            case 'index':
            default:
                $this->clear();
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

    protected function checkRegistrationData() {
        if(Request::isMethod('get')) {
            return true;
        }
        
        if(Request::isMethod('post')) {
            foreach(Input::only('name', 'email', 'address', 'institution') as $key=>$value) {
                $this->store($key, $value);
            }
        }

        return true;
    }

    protected function checkPartsData() {
        if(Request::isMethod('get')) {
            return true;
        }

        $checkedParts = array_keys(Input::get('parts', array()));

        foreach ($this->workshop->parts as $part) {
            if(in_array($part->id, $checkedParts)) {
                $this->arrayRemove($part->id, $checkedParts);
                $this->store('parts.' . $part->id, ' checked="checked"');
            } else {
                $this->delete('parts.' . $part->id);
            }
        }

        return count($checkedParts) == 0;
    }

    protected function clear() {
        Session::forget('workshops.' . $this->workshop->identifier . '.data');
    }

    protected function store($key, $value) {
        return Session::put('workshops.' . $this->workshop->identifier . '.data.' . $key, $value);
    }

    public function get($key, $default = '') {
        return Session::get('workshops.' . $this->workshop->identifier . '.data.' . $key, $default);
    }

    protected function delete($key) {
        Session::forget('workshops.' . $this->workshop->identifier . '.data.' . $key);
    }

    public function arrayRemove($value, &$array) {
        foreach($array as $k=>$v) {
            if($value == $v) {
                unset($array[$k]);
            }
        }
    }
}
