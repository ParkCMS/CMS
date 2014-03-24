<?php

namespace Parkcms\Programs\Cool\Ns;

use Parkcms\Programs\ProgramInterface;
use Parkcms\Context;

use Illuminate\Filesystem\Filesystem as File;

class Program implements ProgramInterface {

    protected $context;

    public function __construct(Context $context, File $file) {
        $this->context = $context;
        $this->file = $file;
    }

    /**
     * initialize the program and returns true at success
     * @param  string $identifier
     * @param  array  $params
     * @return true|false
     */
    public function initialize($identifier, array $params) {

        if(strpos($identifier, "global") === 0) {
            $this->content = $this->file->get(__DIR__ . '/' . $identifier . '.txt');
            return true;
        }

        $path = __DIR__ . '/' . $this->context->route() . '-' . $identifier . '.txt';

        if($this->file->exists($path)) {
            $this->content = $this->file->get($path);
            return true;
        }

        return false;
    }
    
    /**
     * renders the program and returns the result
     * @return string
     */
    public function render() {
        return $this->content;
    }
}
