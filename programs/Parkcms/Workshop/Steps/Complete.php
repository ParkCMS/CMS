<?php

namespace Programs\Parkcms\Workshop\Steps;

use Programs\Parkcms\Workshop\Payment\PayPal;
use Programs\Parkcms\Workshop\Payment\InvalidTokenException;
use Programs\Parkcms\Workshop\Payment\InvalidPaymentException;

use Lang;
use Input;
use Redirect;
use Session;
use View;

class Complete extends Step {
    
    protected $pending;

    public function validate() {

    }

    public function perform() {
        
        $ids = file(__DIR__ . '/../' . $this->workshop->identifier . '.paypal');

        if(!empty($ids[2])) {
            $paypal = new PayPal($ids[0], $ids[1], $ids[2]);
        } else {
            $paypal = new PayPal($ids[0], $ids[1]);
        }

        $payment_id = $this->prev->get('payment')->id;
        $payer_id = Input::get('PayerID');

        $created = false;
        try {
            $approval = $paypal->approval($payment_id, $payer_id);

            if($approval->state == 'created') {
                $approval = $paypal->execute($payment_id, $payer_id);
            }

            if($approval->state == 'pending') {
                $this->pending = true;
            } else if($approval->state == 'approved') {
                $this->pending = false;
            } else {
                $this->errors = array(
                    'payment' => Lang::get('parkcms-workshop::validation.payment')
                );
                $this->pending = null;
            }
        } catch(InvalidTokenException $e) {
            $this->errors = array(
                'payment' => Lang::get('parkcms-workshop::validation.token')
            );
        } catch(InvalidPaymentException $e) {
            $this->errors = array(
                'payment' => Lang::get('parkcms-workshop::validation.payment')
            );
        }

        
    }

    public function render() {
        if($this->pending === null) {
            return Redirect::to(
                $this->program->url(array('step' => $this->prev->prev->name()))
            )->withErrors($this->errors);
        }

        return View::make('parkcms-workshop::' . $this->workshop->identifier .  '.' . $this->name(), array(
            'workshop' => $this->workshop,
            'first'    => $this->program->url(array('step' => 'index')),
            'pending'  => $this->pending
        ))->render();
    }
}
