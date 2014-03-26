<?php

use Parkcms\Admin\Files\Storage;
use Parkcms\Admin\Files\Path;

class MediaController extends Controller
{
    private $store;
    private $path;

    public function __construct(Storage $store, Path $path)
    {
        $this->store = $store;
        $this->path = $path;

        $this->store->setBasePath(public_path('uploads'));

        $this->store->setBaseUrl(URL::to('uploads'));
    }
    /**
     * This method looksup a file in the virtual file tree and
     * redirects the request towards the file
     * The option flag is there right now for things like automatic
     * image resizing (i.e. thumbnail creation) or similar
     */
    public function resolveFile($path)
    {
        try {
            $path = $this->path->clean($path);
            $file = $this->store->lookupFile($path);

            return Redirect::to($file);
        } catch (FileNotFoundException $e) {
            return Response::make($e->getMessage(), 404);
        } catch (InvalidArgumentException $e) {
            return Response::make($e->getMessage(), 404);
        }


    }
}
