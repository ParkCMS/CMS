<?php

namespace Parkcms\Programs\Form;

use Parkcms\Context;
use Parkcms\Programs\ProgramInterface;
use Parkcms\Programs\Form\Models\Form as Model;

use App;
use Input;
use Request;
use URL;
use View;

class Form implements ProgramInterface {

    protected $context;
    protected $form;

    protected $identifier;

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
        
        View::addNamespace('forms', public_path() . '/themes/default/views/forms/');

        $this->identifier = $identifier;

        if(strpos($identifier, "global") === 0) {
            $this->form = Model::where('identifier', $this->context->lang() . '-' . $identifier)->first();
        } else {
            $this->form = Model::where('identifier', $this->context->lang() . '-' . $this->context->route() . '-' . $identifier)->first();
        }

        if(is_null($this->form)) {
            return false;
        }

        try {
            View::getFinder()->find('forms::' . $this->form->identifier);
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
        
        if($this->context->ajax()) {
            if($this->submited()) {
                
                // App::abort('500', 'voll der fehler');

                return json_encode(Input::all());

                return "true";
            }
        } else {
            $url = URL::to('/api/program/' . $this->context->lang() . '/' . $this->context->route() . '/form/' . $this->identifier);

            return View::make('forms::' . $this->form->identifier, array(
                'action' => $url,
                'method' => 'post',
                'form' => $this->form
            ))->render();
        }
    }

    protected function submited() {
        return Request::isMethod('post');
    }
}
