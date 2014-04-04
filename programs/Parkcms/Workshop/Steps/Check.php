<?php

namespace Programs\Parkcms\Workshop\Steps;

use Input;
use Lang;
use Redirect;
use Validator;

class Check extends Step {
    
    public function validate() {
        $validator = Validator::make(
            Input::only('terms'),
            array(
                'terms' => 'accepted'
            ),
            Lang::get('parkcms-workshop::validation')
        );

        if($validator->fails()) {
            $this->check(false);
            return Redirect::to($this->program->url(array('step' => $this->name())))->withErrors($validator);
        }

        $this->check(true);
    }

    public function totalAmount() {
        return $this->prev->totalAmount();
    }

    public function perform() {
        
    }
}
