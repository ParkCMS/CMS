<?php

namespace Programs\Parkcms\Workshop\Payment;

use Session;

class PayPal {

    protected $endpoint;

    protected $client_id;
    protected $secret;
    
    public function __construct($client_id, $secret, $endpoint) {
        $this->endpoint = $endpoint;
        $this->client_id = $client_id;
        $this->secret = $secret;
    }

    /**
     * Returns access token for pay() and approval()
     * @return mixed
     */
    public function token() {
        if($this->invalidToken(Session::get('paypal.token'))) {
            $curl = curl_init("{$this->endpoint}/oauth2/token");
            
            curl_setopt($curl, CURLOPT_HEADER, false);
            
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_USERPWD, "{$this->client_id}:{$this->secret}");
            
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
            
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            
            if($response = curl_exec($curl)) {
                $response = json_decode($response);

                if(empty($response->access_token) || empty($response->expires_in)) {
                    throw new InvalidTokenException();
                }

                $response->expires_at = time() + (int)$response->expires_in;

                Session::put('paypal.token', $response);
            }
        }
        return Session::get('paypal.token')->access_token;
    }

    protected function invalidToken($token) {
        if(!is_object($token)) {
            return true;
        }

        if($token->access_token == '') {
            return true;
        }

        return $token->expires_at <= time();
    }

    /**
     * makes payment with given data
     * @param  $data
     * @return json
     */
    public function pay($data) {
        $curl = curl_init("{$this->endpoint}/payments/payment");
        
        curl_setopt($curl, CURLOPT_HEADER, false);
        
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . $this->token(),
            'Accept: application/json',
            'Content-Type: application/json'
        ));
        
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        if($response = curl_exec($curl)) {
            $response = json_decode($response);

            if(empty($response->id)) {
                throw new InvalidPaymentException();
            }

            return $response;
        }

        throw new InvalidPaymentException();
    }

    /**
     * Returns whether the payment was successful or not
     * @return bool
     */
    public function execute($payment, $payer) {
        $curl = curl_init("{$this->endpoint}/payments/payment/{$payment}/execute");
        
        curl_setopt($curl, CURLOPT_HEADER, false);
        
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . $this->token(),
            'Accept: application/json',
            'Content-Type: application/json'
        ));

        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode(array(
            'payer_id' => $payer
        )));
        
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        if($response = curl_exec($curl)) {
            $response = json_decode($response);

            if(empty($response->id)) {
                throw new InvalidPaymentException();
            }

            return $response;
        }

        throw new InvalidPaymentException();
    }

    /**
     * Returns whether the payment was successful or not
     * @return bool
     */
    public function approval($payment, $payer) {
        $curl = curl_init("{$this->endpoint}/payments/payment/{$payment}");
        
        curl_setopt($curl, CURLOPT_HEADER, false);
        
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . $this->token(),
            'Accept: application/json',
            'Content-Type: application/json'
        ));

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        if($response = curl_exec($curl)) {
            $response = json_decode($response);

            if(empty($response->id)) {
                throw new InvalidPaymentException();
            }

            return $response;
        }

        throw new InvalidPaymentException();
    }

    public function clear() {
        Session::forget('paypal');
    }
}
