<?php

namespace Programs\Parkcms\Form;

use Parkcms\Context;
use Parkcms\Programs\ProgramAbstract;
use Programs\Parkcms\Form\Models\Form as Model;
use Illuminate\Validation\Factory as Validator;

use App;
use Asset;
use Input;
use Lang;
use Mail;
use Request;
use URL;
use View;

class Form extends ProgramAbstract {

    protected $context;
    protected $form;

    protected $identifier;
    protected $validator;

    protected $view = "";

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

        if (View::exists('parkcms-form::'.$this->form->identifier)) {
            $this->view = 'parkcms-form::'.$this->form->identifier;
        } else {
            $this->view = 'parkcms-form::default';
        }
        try {
            View::getFinder()->find($this->view);

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
    public function render($inlineTemplate = null) {
        
        $url = URL::to($this->context->lang() . '/' . $this->context->route());

        $validator = null;
        if($this->submited()) {
            $rules = (array)json_decode($this->form->rules);

            $validator = $this->validator->make(Input::except('identifier'), $rules);
            $validator->setAttributeNames(Lang::get('parkcms-form::fields'));

            if(!$validator->fails()) {
                $form = $this->form;

                Mail::send('parkcms-form::mail', array('input' => Input::except('identifier')), function($message) use($form) {
                    $message->from(Input::get('email'), Input::get('name'));
                    $message->to($form->email);
                    $message->subject($form->subject);
                });
            }
        }

        return View::make($this->view, array(
            'action' => $url,
            'method' => 'post',
            'form' => $this->form,
            'validator' => $validator,
        ))->render();
    }

    protected function submited() {
        return Request::isMethod('post') && Input::get('identifier') == $this->form->identifier;
    }

    public function get($key) {
        if($this->submited()) {
            return Input::get($key);
        }

        return '';
    }
}
