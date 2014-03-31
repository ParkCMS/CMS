<?php

namespace Programs\Parkcms\Workshop\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Workshop extends Eloquent {
    protected $table = 'workshops';

    public function parts() {
        return $this->hasMany('Programs\Parkcms\Workshop\Models\Part');
    }

    public function registrations() {

        $registrations = array();

        foreach($this->parts as $part) {
            foreach($part->registrations as $registration) {
                if(!in_array($registration, $registrations)) {
                    $registrations[] = $registration;
                }
            }
        }

        return $registrations;
    }
}
