<?php

namespace Programs\Parkcms\Form\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Form extends Eloquent {
    protected $table = 'forms';

    public function fields() {
        return $this->hasMany('Programs\Parkcms\Form\Models\Field');
    }
}
