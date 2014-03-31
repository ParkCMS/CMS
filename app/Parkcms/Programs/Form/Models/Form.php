<?php

namespace Parkcms\Programs\Form\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Form extends Eloquent {
    protected $table = 'forms';

    public function fields() {
        return $this->hasMany('Parkcms\Programs\Form\Models\Field');
    }
}
