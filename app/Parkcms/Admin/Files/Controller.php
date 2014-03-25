<?php

namespace Parkcms\Admin\Files;

use URL;

class Controller extends \Controller
{
    private $store;

    public function __construct(Storage $store)
    {
        $this->store = $store;
    }

    public function getFolder($folder)
    {
        var_dump($folder);
        $this->store->setBasePath(public_path());

        $this->store->setBaseUrl(URL::to('files'));
    }
}