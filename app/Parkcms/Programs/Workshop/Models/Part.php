<?php

namespace Parkcms\Programs\Workshop\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Part extends Eloquent {
    protected $table = 'workshop_parts';

    public function workshop() {
        return $this->belongsTo('Parkcms\Programs\Workshop\Models\Workshop');
    }

    public function registrations() {
        return $this->belongsToMany('Parkcms\Programs\Workshop\Models\Registration', 'workshop_part_registration');
    }
}
