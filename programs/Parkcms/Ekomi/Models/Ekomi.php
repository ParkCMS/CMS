<?php

namespace Programs\Parkcms\Ekomi\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Ekomi extends Eloquent {
    protected $table = 'ekomi';

    public function scopeByContext($query, $lang, $page, $identifier)
    {
        return $query->where('identifier', $page . '-' . $identifier);
    }
}
