<?php

namespace Programs\Parkcms\Ticker\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Ticker extends Eloquent {
    protected $table = 'ticker';

    public function items() {
        return $this->hasMany('Programs\Parkcms\Ticker\Models\Item');
    }
}
