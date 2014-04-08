<?php

namespace Programs\Parkcms\Faq\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Question extends Eloquent {
    protected $table = 'faq_questions';

    public function faq() {
        return $this->belongsTo('Parkcms\Programs\Faq\Models\Faq');
    }
}
