<?php

namespace Programs\Parkcms\Text;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent {
    protected $table = 'text';

    public function scopeByContext($query, $lang, $page, $identifier)
    {
        return $query->where('identifier', $this->createIdentifier($lang, $page, $identifier));
    }

    public function createIdentifier($lang, $page, $identifier)
    {
        if (!$page) {
            // Global
            return $lang . '-' . $identifier;
        }

        return $lang . '-' . $page . '-' . $identifier;
    }
}
