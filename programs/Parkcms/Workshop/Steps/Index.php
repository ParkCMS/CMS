<?php

namespace Programs\Parkcms\Workshop\Steps;

use Programs\Parkcms\Workshop\Payment\PayPal;

class Index extends Step {
    
    public function validate() {
        // null means null errors
        return null;
    }
    public function check($checked = null) {
        return true;
    }

    public function perform() {
        $this->clearAll();
        $paypal = new PayPal(null, null, null);
        $paypal->clear();
    }
}
