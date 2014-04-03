<?php

namespace Programs\Parkcms\Workshop\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

use Carbon\Carbon;

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

    public function isFullOrClosed() {
        return $this->isClosed() || $this->isFull();
    }

    public function isFull() {
        if($this->seats < 0) {
            return false;
        }

        if($this->seats == 0) {
            return true;
        }

        return count($this->registrations()) >= $this->seats;
    }

    public function isClosed() {
        return $this->date->lt(Carbon::now());
    }

    public function getDates() {
        return array('date', 'created_at', 'updated_at');
    }
}
