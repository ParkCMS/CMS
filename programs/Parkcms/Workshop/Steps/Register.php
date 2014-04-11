<?php

namespace Programs\Parkcms\Workshop\Steps;

use Input;
use Lang;
use Redirect;
use Validator;

class Register extends Step {
    
    public function validate() {
        foreach(Input::only(
            'title', 'surname', 'firstname', 'middlename',
            'email', 'phone', 'fax',
            'address', 'city', 'zip', 'country', 'institution'
        ) as $key=>$value) {
            $this->set($key, $value);
        }

        $validator = Validator::make(
            $this->getAll(),
            array(
                'surname' => 'required|min:2',
                'firstname' => 'required|min:5',
                'address' => 'required|min:5',
                'city' => 'required|min:5',
                'zip' => 'required|integer',
                'country' => 'required|min:5',
                'email' => 'required|email',
                'phone' => 'required|min:5'
            )
        );

        $validator->setAttributeNames(Lang::get('parkcms-workshop::fields'));

        if($validator->fails()) {
            $this->check(false);
            return Redirect::to($this->program->url(array('step' => $this->name())))->withErrors($validator);
        }

        $this->check(true);
    }

    public function perform() {
        
    }
}
