<?php

namespace Parkcms\Programs\Workshop\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Registration extends Eloquent {
    protected $table = 'workshop_registrations';

    public function workshop() {
        return $this->parts()->first()->workshop();
    }

    public function parts() {
        return $this->belongsToMany('Parkcms\Programs\Workshop\Models\Part', 'workshop_part_registration')->withPivot('amount');
    }
}
