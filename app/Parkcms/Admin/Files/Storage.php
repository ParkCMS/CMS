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
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        foreach($files as $file) {
            $type = "directory";
            if ($file->isFile()) {
                $type = finfo_file($finfo, $file->getRealPath());
            }
            $finf[] = array(
                'filename'  => $file->getFilename(),
                'path'      => $folder . '/' . $file->getFilename(),
                'url'       => $this->buildUrl($folder . '/' . $file->getFilename()),
                'isFile'    => $file->isFile(),
                'isDir'     => $file->isDir(),
                'size'      => $file->getSize(),
                'type'      => $type
            );
        }
        finfo_close($finfo);

        return $finf;
    }

    public function lookupFile($file)
    {
        $path = $this->buildPath($file);

        if ($path === false) {
            throw new FileNotFoundException(sprintf('Folder "%s" could not be found.', $file));
        }

        return $this->buildUrl($file);
    }

    public function mkdir($path)
    {
        if (!mkdir($path)) {
            throw new Exception("No Permissions to create directory!");
        }
    }

    public function buildPath($file)
    {
        return $this->path->resolveFilesystemPath($this->basePath, $file);
    }

    public function buildUrl($path)
    {
        return $this->baseUrl . str_replace(" ", "%20",$path);
    }
}