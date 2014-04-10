<?php

namespace Programs\Parkcms\Form\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Form extends Eloquent {
    protected $table = 'forms';

    public function fields() {
        return $this->hasMany('Programs\Parkcms\Form\Models\Field');
    }

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
