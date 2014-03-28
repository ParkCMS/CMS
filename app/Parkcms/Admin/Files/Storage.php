<?php

namespace Parkcms\Admin\Files;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Illuminate\Filesystem\Filesystem;

class Storage
{
    private $finder;

    private $basePath;
    private $baseUrl;

    private $path;
    private $fs;

    public function __construct(Finder $finder, Path $path, Filesystem $fs)
    {
        $this->finder = $finder;
        $this->path = $path;
        $this->fs = $fs;
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
        $path = $this->basePath . $path;
        
        if (!mkdir($path)) {
            throw new Exception("No Permissions to create directory!");
        }
    }

    public function move($src, $dest)
    {
        $filename = $this->makeUniqueFilename(basename($src), $dest);
        return $this->fs->move($src, $dest . DIRECTORY_SEPARATOR . $filename);
    }

    public function makeUniqueFilename($filename, $base)
    {
        if (file_exists($base . DIRECTORY_SEPARATOR . $filename)) {
            return date("dmy_His_") . $filename;
        }
        return $filename;
    }

    public function exists($path)
    {
        $path = $this->buildPath($path);

        return $path;
    }

    public function deleteFile($path)
    {
        if (!@unlink($path)) {
            throw new Exception("Unable to delete file!");
        }
    }

    public function deleteFolder($path)
    {
        if (!$this->fs->deleteDirectory($path, false)) {
            throw new Exception("Unable to delete directory!");
        }
    }

    private function rrmdir($path)
    {
        foreach (glob($dir . '/*') as $file) { 
            if (is_dir($file)){
                $this->rrmdir($file);
            } else {
                unlink($file);
            } 
        }
        rmdir($dir); 
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