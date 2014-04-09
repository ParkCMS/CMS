<?php

namespace Programs\Parkcms\Dirlist;

use Parkcms\Context;
use Parkcms\Programs\ProgramAbstract;

use Programs\Parkcms\Dirlist\Models\Dirlist as Model;

use URL;
use View;

class Dirlist extends ProgramAbstract {

    protected $context;
    protected $dirlist;

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
            $this->dirlist = Model::where(
                'identifier', $this->context->lang() . '-' . $identifier
            )->first();
        } else {
            $this->dirlist = Model::where(
                'identifier', $this->context->lang() . '-' . $this->context->route() . '-' . $identifier
            )->first();
        }

        if(is_null($this->dirlist)) {
            return false;
        }

        if(!is_dir($this->folder())) {
            return false;
        }

        return true;
    }
    
    public function render($inlineTemplate = null) {
        $files = array();
        foreach(glob($this->folder() . $this->dirlist->filter) as $file) {
            $obj = new \stdClass;

            $obj->path = $file;
            $obj->name = basename($file);
            $obj->url = $this->urlToFile($file);

            $files[] = $obj;
        }

        return View::make('parkcms-dirlist::dirlist', array(
            'files' => $files,
        ))->render();
    }

    public function folder() {
        return realpath(public_path('uploads') . DIRECTORY_SEPARATOR . $this->dirlist->folder) . DIRECTORY_SEPARATOR;
    }

    public function urlToFile($file) {
        return URL::to('files/' . $this->dirlist->folder . '/' . str_replace($this->folder(), '', $file));
    }
}
