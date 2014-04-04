<?php

namespace Programs\Parkcms\Workshop\Steps;

use Programs\Parkcms\Workshop\Models\Part;

use Input;
use Redirect;

class Parts extends Step {
    
    public function validate() {
        $checkedParts = Input::get('parts', array());

        $validPartValue = function(Part $part, $value) {
            if($part->part_type == 1) {
                return $value == 0 || $value == 1;
            } else if($part->part_type == 2) {
                $values = array_map('trim', explode(',', $part->select_values));

                return in_array($value, $values);
            }
        };

        foreach ($this->workshop->parts as $part) {
            if(isset($checkedParts[$part->id])) {
                if($validPartValue($part, $checkedParts[$part->id])) {
                    $this->set($part->id, $checkedParts[$part->id]);
                    unset($checkedParts[$part->id]);
                }
            } else {
                $this->delete($part->id);
            }
        }

        if(!(count($checkedParts) == 0 && count($this->getAll('parts')) > 0)) {
            $this->check(false);
            return Redirect::to($this->program->url(array('step' => $this->name())))->withErrors(array('parts' => true));
        }

        $this->check(true);
    }

    public function perform() {
        
    }

    public function totalAmount() {
        $total_amount = 0;
        foreach($this->workshop->parts as $part) {
            if($partValue = $this->get($part->id)) {
                $total_amount+= $partValue * $part->price;
            }
        }

        return round($total_amount, 2);
    }
}
