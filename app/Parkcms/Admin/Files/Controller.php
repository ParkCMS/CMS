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

        $this->store->setBasePath(public_path('uploads'));

        $this->store->setBaseUrl(URL::to('files'));
    }

    public function getFolder()
    {
        $path = Input::get('path');

        if ($path === null || empty($path)) {
            $path = '/';
        }

        $path = urldecode($path);

        $path = $this->path->clean($path);

        try {
            $files = $this->store->filesInFolder($path);
            return Response::json($files);
        } catch (FileNotFoundException $e) {
            return Response::json(array("error" => 404, "message" => $e->getMessage()), 404);
        }
    }

    public function uploadGet() {
        $file = $this->initUploadFile();
        if ($file->checkChunk()) {
            return $this->checkUploadStatus($file);
        } else {
            return Response::make('Not Found', 404);
        }
    }

    public function uploadPost() {
        $file = $this->initUploadFile();
        if ($file->validateChunk()) {
            $file->saveChunk();
            return $this->checkUploadStatus($file);
        } else {
            // error, invalid chunk upload request, retry
            return Response::make('Bad Request', 400);
        }
    }

    private function initUploadFile() {
        $config = new \Flow\Config();
        $config->setTempDir(storage_path() . '/upload_tmp');
        $file = new \Flow\File($config);

        return $file;
    }

    private function checkUploadStatus($file) {
        $vp = Input::get('virtualPath');
        $filename = Input::get('flowRelativePath');

        $vp = $this->path->clean($vp);
        $vp = $this->path->resolveFilesystemPath(public_path('uploads'), $vp);

        if ($file->validateFile() && $file->save($vp . '/' . $filename)) {
            // File upload was completed
            return Response::make('Completed', 200);
        } else {
            // This is not a final chunk, continue to upload
            return Response::make('Chunk ok', 200);
        }
    }
}