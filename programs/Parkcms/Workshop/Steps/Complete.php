<?php

namespace Programs\Parkcms\Workshop\Steps;

use Programs\Parkcms\Workshop\Payment\PayPal;
use Programs\Parkcms\Workshop\Payment\InvalidTokenException;
use Programs\Parkcms\Workshop\Payment\InvalidPaymentException;

use Programs\Parkcms\Workshop\Models\Registration;
use Programs\Parkcms\Workshop\Models\Part;

use Illuminate\Filesystem\Filesystem;

use Lang;
use Input;
use Redirect;
use Session;
use View;

class Complete extends Step {
    
    protected $filesystem;

    protected $internal_id;

    protected $pending;
    protected $approval;

    public function __construct(Filesystem $filesystem) {
        $this->filesystem = $filesystem;
    }

    public function validate() {

    }

    public function perform() {

        $client_id = $this->program->config->paypal->client_id;
        $secret = $this->program->config->paypal->secret;
        $endpoint = $this->program->config->paypal->endpoint;

        $paypal = new PayPal($client_id, $secret, $endpoint);

        $payment_id = $this->prev->get('payment')->id;
        $payer_id = Input::get('PayerID');

        $created = false;
        try {
            $this->approval = $paypal->approval($payment_id, $payer_id);

            if($this->approval->state == 'created') {
                $this->internal_id = uniqid();

                $this->backup();
                $this->approval = $paypal->execute($payment_id, $payer_id);
            }

            if($this->approval->state == 'pending') {
                $this->pending = true;
            } else if($this->approval->state == 'approved') {
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

        if(!is_null($this->internal_id)) {
            Registration::unguard();

            $registerStep = $this->prev->prev->prev->prev;

            $registration = new Registration(array(
                'internal_id' => $this->internal_id,

                'title' => $registerStep->get('title'),
                'first_name' => $registerStep->get('firstname'),
                'middle_name' => $registerStep->get('middlename'),
                'sur_name' => $registerStep->get('surname'),

                'address' => $registerStep->get('address'),
                'institution' => $registerStep->get('institution'),
                'city' => $registerStep->get('city'),
                'zip' => $registerStep->get('zip'),
                'country' => $registerStep->get('country'),

                'email' => $registerStep->get('email'),
                'phone' => $registerStep->get('phone'),
                'fax' => $registerStep->get('fax'),

                'total_amount' => $this->prev->totalAmount(),

                'payment_type' => 'paypal',
                'payment_data' => json_encode($this->approval),
            ));

            $registration->save();

            foreach($this->workshop->parts as $part) {
                if($partValue = $this->prev->prev->prev->get($part->id)) {
                    $part->registrations()->attach($registration, array('value' => $partValue));
                }
            }
        }

        return View::make('parkcms-workshop::' . $this->workshop->identifier .  '.' . $this->name(), array(
            'workshop' => $this->workshop,
            'first'    => $this->program->url(array('step' => 'index')),
            'pending'  => $this->pending
        ))->render();
    }

    public function backup() {

        $pay = $this->prev;
        $check = $pay->prev;
        $parts = $check->prev;
        $register = $parts->prev;

        $backup = "workshop\n";
        $backup.= $this->workshop->id . "\n";
        $backup.= $this->workshop->title . "\n";
        $backup.= $this->workshop->date . "\n";

        $backup.= "register\n";
        $backup.= print_r(json_encode($register->getAll()), true) . "\n";

        $backup.= "parts\n";
        $backup.= print_r(json_encode($parts->getAll()), true) . "\n";

        $backup.= "check\n";
        $backup.= print_r(json_encode($check->getAll()), true) . "\n";

        $backup.= "pay\n";
        $backup.= print_r(json_encode($pay->getAll()), true) . "\n";

        $this->filesystem->put(
            __DIR__ . '/../backup/' . $this->workshop->id . '-' . $this->internal_id . '.txt',
            $backup
        );
    }

    public function email() {

    }
}
