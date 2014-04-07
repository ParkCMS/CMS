<?php

namespace Programs\Parkcms\Workshop\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Registration extends Eloquent {
    protected $table = 'workshop_registrations';

    public function workshop() {
        return $this->parts()->first()->workshop();
    }

    public function parts() {
        return $this->belongsToMany('Programs\Parkcms\Workshop\Models\Part', 'workshop_part_registration')->withPivot('value')->orderBy('order');
    }
}
