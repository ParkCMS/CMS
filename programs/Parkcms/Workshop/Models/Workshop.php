<?php

namespace Programs\Parkcms\Workshop\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

use Carbon\Carbon;

class Workshop extends Eloquent {
    protected $table = 'workshops';

    public function parts() {
        return $this->hasMany('Programs\Parkcms\Workshop\Models\Part')->orderBy('order');
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

    public function occupiedSeats() {

        $registrations = array();

        $occupiedSeats = 0;

        foreach($this->parts()->where('connected_with_seats', true)->get() as $part) {
            foreach($part->registrations()->get() as $registration) {
                if(!in_array($registration->id, $registrations)) {
                    $registrations[] = $registration->id;
                    $occupiedSeats+= $registration->pivot->value;
                }
            }
        }

        return $occupiedSeats;
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

        return $this->occupiedSeats() >= $this->seats;
    }

    public function isClosed() {
        return $this->date->lt(Carbon::now());
    }

    public function getDates() {
        return array('date', 'created_at', 'updated_at');
    }
}
