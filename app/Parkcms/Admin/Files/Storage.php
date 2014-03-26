<?php

namespace Parkcms\Admin\Files;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;

class Storage
{
    private $finder;

    private $basePath;
    private $baseUrl;

    private $path;

    public function __construct(Finder $finder, Path $path)
    {
        $this->finder = $finder;
        $this->path = $path;
    }

    public function setBasePath($basePath)
    {
        $this->basePath = $basePath;
    }

    public function getBasePath()
    {
        return $this->basePath;
    }

    public function setBaseUrl($baseURL)
    {
        $this->baseUrl = $baseURL;
    }

    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    public function filesInFolder($folder)
    {
        $path = $this->buildPath($folder);

        if ($path === false) {
            throw new FileNotFoundException(sprintf('Folder "%s" could not be found.', $folder));
        }

        $files = $this->finder->in($path)->depth('<1');

        $finf = array();
        foreach($files as $file) {
            $finf[] = array(
                'filename'  => $file->getFilename(),
                'path'      => $folder . '/' . $file->getFilename(),
                'url'       => $this->buildUrl($folder . '/' . $file->getFilename()),
                'isFile'    => $file->isFile(),
                'isDir'     => $file->isDir()
            );
        }
        
        return $finf;
    }

    public function buildPath($file)
    {
        return $this->path->resolveFilesystemPath($this->basePath, $file);
    }

    public function buildUrl($path)
    {
        return $this->baseUrl . $path;
    }
}