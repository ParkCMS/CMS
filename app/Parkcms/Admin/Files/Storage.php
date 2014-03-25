<?php

namespace Parkcms\Admin\Files;

use Symfony\Component\Finder\Finder;

class Storage
{
    private $finder;

    private $basePath;
    private $baseUrl;

    public function __construct(Finder $finder)
    {
        $this->finder = $finder;
    }

    public function setBasePath($basePath)
    {
        $this->basePath = $basePath;
    }

    public function setBaseUrl($baseURL)
    {
        $this->baseUrl = $baseURL;
    }

    public function filesInFolder($folder)
    {
        $path = $this->buildPath($folder);

        $files = $this->finder->in($path);

        var_dump($files);
    }

    public function buildPath($file)
    {
        return $basePath . '/' . $file;
    }
}