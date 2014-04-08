<?php

namespace Parkcms\Admin\Pages\Controller;

use Parkcms\Models\Page;
use Controller as BaseController;

use Response;

class Pages extends BaseController
{
    public function pageTree()
    {
        $trees = Page::roots()->get();
        $siteTree = array();

        foreach ($trees as $tree) {
            $siteTree[] = $tree->getDescendantsAndSelf()->toHierarchy()->toJson();
        }

        $response = Response::make('[' . implode(', ', $siteTree) . ']', 200);

        $response->header('Content-Type', 'application/json');

        return $response;
    }

    public function availableTemplates()
    {
        /*$theme = Config::get('cmex.template');

        $this->finder->files()->in(app_path() . "/../public/templates/" . $theme)->name('*.twig')->depth('== 0');

        $templates = array();

        foreach ($this->finder as $file) {
            $templatename = str_replace('.twig', '', $file->getFilename());
            $templates[] = array("id" => $templatename, "name" => $templatename ." Template");
        }

        return Response::json($templates);*/
    }
}