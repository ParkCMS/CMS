<?php

namespace Programs\Parkcms\Workshop\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Part extends Eloquent {
    protected $table = 'workshop_parts';

    public function workshop() {
        return $this->belongsTo('Programs\Parkcms\Workshop\Models\Workshop');
    }

    public function registrations() {
        return $this->belongsToMany('Programs\Parkcms\Workshop\Models\Registration', 'workshop_part_registration');
    }
}
