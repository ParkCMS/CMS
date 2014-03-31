<?php

namespace Programs\Parkcms\Form\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Field extends Eloquent {
    protected $table = 'fields';

    public function form() {
        return $this->belongsTo('Parkcms\Programs\Form\Models\Form');
    }
}
