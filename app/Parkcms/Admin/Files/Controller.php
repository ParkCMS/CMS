<?php

namespace Parkcms\Admin\Files;

use URL;
use Input;
use Response;
use App;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;

class Controller extends \Controller
{
    private $store;
    private $path;

    public function __construct(Storage $store, Path $path)
    {
        $this->store = $store;
        $this->path = $path;
    }

    public function getFolder()
    {
        $path = Input::get('path');

        if ($path === null || empty($path)) {
            $path = '/';
        }

        $path = urldecode($path);

        $path = $this->path->clean($path);

        $this->store->setBasePath(public_path('uploads'));

        $this->store->setBaseUrl(URL::to('files'));

        try {
            $files = $this->store->filesInFolder($path);
            return Response::json($files);
        } catch (FileNotFoundException $e) {
            return Response::json(array("error" => 404, "message" => $e->getMessage()), 404);
        }
    }
}