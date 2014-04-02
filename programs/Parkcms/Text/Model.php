<?php

namespace Programs\Parkcms\Text;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent {
    protected $table = 'text';

    public function scopeByContext($query, $lang, $page, $identifier)
    {
        if (!$page) {
            // Global
            return $query->where('identifier', $lang . '-' . $identifier);
        }
        return $query->where('identifier', $lang . '-' . $page . '-' . $identifier);
    }
}
