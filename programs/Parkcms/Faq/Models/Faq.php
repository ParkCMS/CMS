<?php

namespace Programs\Parkcms\Faq\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Faq extends Eloquent {
    protected $table = 'faq';

    public function questions() {
        return $this->hasMany('Programs\Parkcms\Faq\Models\Question');
    }
}
