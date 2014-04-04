<?php

namespace Programs\Parkcms\Workshop\Steps;

use Programs\Parkcms\Workshop\Payment\PayPal;
use Programs\Parkcms\Workshop\Payment\InvalidTokenException;
use Programs\Parkcms\Workshop\Payment\InvalidPaymentException;

use Lang;
use Redirect;

class Pay extends Step {
    
    protected $errors = array();

    public function validate() {

    }

    public function totalAmount() {
        return $this->prev->totalAmount();
    }

    public function perform() {

        $ids = file(__DIR__ . '/../' . $this->workshop->identifier . '.paypal');

        if(!empty($ids[2])) {
            $paypal = new PayPal($ids[0], $ids[1], $ids[2]);
        } else {
            $paypal = new PayPal($ids[0], $ids[1]);
        }

        try {
            $payment = $paypal->pay(array(
                'intent' => 'sale',
                'payer' => array(
                    'payment_method' => 'paypal'
                ),
                'transactions' => array(array(
                    'amount' => array(
                        'total' => $this->totalAmount(),
                        'currency' => 'EUR'
                    ),
                    'description' => 'Registration for the following workshop: ' . $this->workshop->title,
                )),
                'redirect_urls' => array(
                    'return_url' => $this->program->url(array('step' => $this->next->name())),
                    'cancel_url' => $this->program->url(array('step' => 'index'))
                )
            ));

            $this->check(true);
            $this->set('payment', $payment);
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
        if(!empty($this->errors)) {
            return Redirect::to(
                $this->program->url(array('step' => $this->next->name()))
            )->withErrors($this->errors);
        }

        foreach($this->get('payment')->links as $link) {
            if($link->rel == 'approval_url') {
                $this->check('checked', true);
                return Redirect::to($link->href);
            }
        }

        return 'dat shit!';
    }
}
