<?php

namespace Programs\Parkcms\Ticker\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Item extends Eloquent {
    protected $table = 'ticker_items';

    public function ticker() {
        return $this->belongsTo('Programs\Parkcms\Ticker\Models\Ticker');
    }
}
