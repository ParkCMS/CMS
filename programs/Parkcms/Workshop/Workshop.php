<?php

namespace Programs\Parkcms\Workshop;

use Parkcms\Context;
use Parkcms\Programs\ProgramAbstract;

use Programs\Parkcms\Workshop\Models\Workshop as Model;

use Programs\Parkcms\Workshop\Steps\Index;
use Programs\Parkcms\Workshop\Steps\Register;
use Programs\Parkcms\Workshop\Steps\Parts;
use Programs\Parkcms\Workshop\Steps\Check;
use Programs\Parkcms\Workshop\Steps\Pay;
use Programs\Parkcms\Workshop\Steps\Complete;

use Asset;
use Input;
use Redirect;
use Request;
use Session;

class Workshop extends ProgramAbstract {
    
    public $config;

    protected $workshop;
    protected $context;

    protected $step;

    public function __construct(
        Context $context,
        Index $index,
        Register $register,
        Parts $parts,
        Check $check,
        Pay $pay,
        Complete $complete)
    {
        $this->context = $context;

        $this->steps = array(
            'index' => $index,
            'register' => $register,
            'parts' => $parts,
            'check' => $check,
            'pay' => $pay,
            'complete' => $complete,
        );

        while(($current = current($this->steps)) !== false) {
            $current->next(next($this->steps));
            if(current($this->steps) !== false) {
                current($this->steps)->prev($current);
            }
        }
        reset($this->steps);
    }

    /**
     * initialize the program and returns true at success
     * @param  string $identifier
     * @param  array  $params
     * @return true|false
     */
    public function initialize($identifier, array $params) {
        parent::initialize($identifier, $params);

        $this->workshop = Model::with('parts')
            ->where('identifier', $identifier)
            ->where('active', true)->first();

        if(is_null($this->workshop)) {
            return false;
        }

        $cp = __DIR__ . DIRECTORY_SEPARATOR . $this->identifier . '.paypal';

        if(!file_exists($cp)) {
            return false;
        }

        $this->config = (object)parse_ini_file($cp, true);

        foreach($this->config as &$item) {
            if(is_array($item)) {
                $item = (object) $item;
            }
        }

        foreach($this->steps as $step) {
            $step->setProgram($this);
            $step->setWorkshop($this->workshop);
        }

        Asset::script('data-async', 'themes/default/js/data-async.js', array('jquery', 'bootstrap'));

        return true;
    }

    /**
     * renders the program and returns the result
     * @return string
     */
    public function render($inlineTemplate = null) {
        $this->findStep();

        if(Request::isMethod('post')) {
            if(($validate = $this->step->prev->validate()) !== null) {
                return $validate;
            }
        }

        $checkAll = $this->step->checkAll(true);

        if($checkAll != null && $this->step->name() != $checkAll) {
            return Redirect::to($this->url(array('step' => $checkAll)));
        }

        $this->step->perform();

        return $this->step->render();
    }

    public function findStep() {
        if(Input::get('identifier') != $this->workshop->identifier) {
            return ($this->step = $this->steps['index']);
        }

        if($this->workshop->isFullOrClosed()) {
            return ($this->step = $this->steps['index']);
        }

        $step = Input::get('step', 'index');

        if(!isset($this->steps[$step])) {
            return ($this->step = $this->steps['index']);
        }

        return ($this->step = $this->steps[$step]);
    }

    public function step() {
        return $this->step;
    }
}
