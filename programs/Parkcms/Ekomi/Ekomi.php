<?php

namespace Programs\Parkcms\Ekomi;

use Parkcms\Context;
use Parkcms\Programs\ProgramAbstract;

use Programs\Parkcms\Ekomi\Models\Ekomi as Model;

use View;

class Ekomi extends ProgramAbstract {

    protected $context;
    protected $ekomi;

    public function __construct(Context $context) {
        $this->context = $context;
    }

    /**
     * initialize the program and returns true at success
     * @param  string $identifier
     * @param  array  $params
     * @return true|false
     */
    public function initialize($identifier, array $params) {
        parent::initialize($identifier, $params);

        if(strpos($identifier, "global") === 0) {
            $this->ekomi = Model::where(
                'identifier', $identifier
            )->first();
        } else {
            $this->ekomi = Model::where(
                'identifier', $this->context->route() . '-' . $identifier
            )->first();
        }

        if(is_null($this->ekomi)) {
            return false;
        }

        if($this->ekomi->updated_at->diffInDays() >= 1) {
            $client = unserialize(file_get_contents('http://api.ekomi.de/v2/getSnapshot?auth=' . $this->ekomi->source . '&version=cust-1.0.0'));
            $client = $client['info'];

            $this->ekomi->rating = $client['fb_avg_detail'];
            $this->ekomi->link = $client['ekomi_certificate_seo'];
            $this->ekomi->count = $client['fb_count'];
            
            $this->ekomi->save();
        }

        return true;
    }
    
    public function render($inlineTemplate = null) {
        return View::make('parkcms-ekomi::ekomi', array(
            'ekomi' => $this->ekomi,
        ))->render();
    }

}
