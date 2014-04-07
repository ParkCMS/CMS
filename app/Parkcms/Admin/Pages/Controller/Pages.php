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
        //return \Response::json($siteTree);
    }
}