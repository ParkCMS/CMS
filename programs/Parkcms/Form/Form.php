<?php

namespace Programs\Parkcms\Form;

use Parkcms\Context;
use Parkcms\Programs\ProgramAbstract;
use Programs\Parkcms\Form\Models\Form as Model;
use Illuminate\Validation\Factory as Validator;

use App;
use Asset;
use Input;
use Request;
use URL;
use View;

class Form extends ProgramAbstract {

    protected $context;
    protected $form;

    protected $identifier;
    protected $validator;

    public function __construct(Context $context, Validator $validator) {
        $this->context = $context;
        $this->validator = $validator;
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
            $this->form = Model::where('identifier', $this->context->lang() . '-' . $identifier)->first();
        } else {
            $this->form = Model::where('identifier', $this->context->lang() . '-' . $this->context->route() . '-' . $identifier)->first();
        }

        if(is_null($this->form)) {
            return false;
        }

        try {
            View::getFinder()->find('parkcms-form::' . $this->form->identifier);

            Asset::script('data-async', 'themes/default/js/data-async.js', array('jquery', 'bootstrap'));

            return true;
        } catch(\InvalidArgumentException $e) {
            return false;
        }
    }
    
    /**
     * renders the program and returns the result
     * @return string
     */
    public function render() {
        
        $url = URL::to($this->context->lang() . '/' . $this->context->route());

        $validator = null;
        if($this->submited()) {
            $rules = (array)json_decode($this->form->rules);

            $validator = $this->validator->make(Input::all(), $rules);
        }

        return View::make('parkcms-form::' . $this->form->identifier, array(
            'action' => $url,
            'method' => 'post',
            'form' => $this->form,
            'validator' => $validator,
        ))->render();
    }

    protected function submited() {
        return Request::isMethod('post') && Input::get('identifier') == $this->form->identifier;
    }
}
