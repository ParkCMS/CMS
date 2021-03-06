<?php

namespace Parkcms\Admin\Pages\Controller;

use Parkcms\Models\Page;
use Controller as BaseController;
use Illuminate\Foundation\Application;
use Symfony\Component\Finder\Finder;

use Response;
use Input;
use Validator;
use URL;

class Pages extends BaseController
{
    private $app;
    private $finder;

    public function __construct(Application $app, Finder $finder)
    {
        $this->app = $app;
        $this->finder = $finder;

        $that = $this;
        \Validator::extend(
            'valid_template',
            function ($attribute, $value, $parameters) use ($that) {

                $templates = $that->fetchTemplates();

                foreach ($templates as $template) {
                    if ($value === $template['id']) {
                        return true;
                    }
                }

                return false;
            }
        );
    }

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

    public function linkList()
    {
        $trees = Page::roots()->get();

        $linklist = array();

        foreach ($trees as $tree) {
            $nodes = $tree->descendants()->where('unpublished', '<=', 1)->get();
            foreach ($nodes as $node) {
                $linklist[] = array('title' => $node->title . '(' . $tree->title . ')', 'value' => URL::to($tree->title . '/' . $node->alias));
            }
        }

        return Response::json($linklist);
    }

    public function availableTemplates()
    {
        $templates = $this->fetchTemplates();

        return Response::json($templates);
    }

    public function update()
    {
        $page = Input::get('page');
        $rules = array(
            'id'            => 'exists:pages',
            'title'         => 'required',
            'alias'         => array('required', 'regex:/^([A-Za-z0-9-_.])+$/'),
            'template'      => 'required|valid_template',
            'unpublished'   => 'required|min:0|max:2'
        );

        $validator = Validator::make($page, $rules);
        if ($validator->fails()) {
            return Response::json(array('error' => array('message' => 'Validation failed!', 'errors' => json_encode($validator->messages()))), 400);
        } else {
            $model = Page::find($page['id']);
            $model->title = $page['title'];
            $model->template = $page['template'];
            $model->type = 'page';
            $model->unpublished = $page['unpublished'];

            if ($model->save()) {
                return Response::json(array('type' => 'success', 'message' => 'Page created successfully!'));
            } else {
                return Response::json(array('error' => array('message' => 'Unable to save entry!')), 400);
            }
        }
    }

    public function delete()
    {
        $page = Input::get('page');

        $model = Page::find($page);
        if ($model === null) {
            return Response::json(array('error' => array('message' => 'Page not found!')), 400);
        } else {
            $model->delete();
            return Response::json(array('type' => 'success', 'message' => 'Page was deleted!'));
        }
    }

    public function create()
    {
        if (!(Input::has('page') && Input::has('position') && Input::has('relativeId'))) {
            return Response::json(array('error' => array('message' => 'Missing fields!')), 400);
        }

        $page = Input::get('page');
        $position = Input::get('position');
        $relativeId = Input::get('relativeId');

        if (!in_array($position, array('child', 'before', 'after'))) {
            return Response::json(array('error' => array('message' => 'Invalid Position!')), 400);
        }

        $rules = array(
            'title'         => 'required',
            'alias'         => array('required', 'regex:/^([A-Za-z0-9-_.])+$/'),
            'template'      => 'required|valid_template',
            'unpublished'   => 'required|min:0|max:2'
        );

        $validator = Validator::make($page, $rules);
        if ($validator->fails()) {
            return Response::json(array('error' => array('message' => 'Validation failed!', 'errors' => json_encode($validator->messages()))), 400);
        } else {
            $model = new Page;
            $model->title = $page['title'];
            $model->alias = $page['alias'];
            $model->template = $page['template'];
            $model->type = 'page';
            $model->unpublished = $page['unpublished'];

            $relativeModel = Page::find($relativeId);

            if ($relativeModel === null) {
                return Response::json(array('error' => array('message', 'Relative Page not found!')), 400);
            }

            $model->save();

            switch ($position) {
                case 'child':
                    $model->makeChildOf($relativeModel);
                    break;
                
                case 'after':
                    $model->makeChildOf($relativeModel->parent()->first());
                    $model->moveToRightOf($relativeModel);
                    break;
                case 'before':
                    $model->makeChildOf($relativeModel->parent()->first());
                    $model->moveToLeftOf($relativeModel);
                    break;

                default:
                    break;
            }

            return Response::json(array('type' => 'success', 'message' => 'Page created successfully!'));
        }
    }

    private function fetchTemplates()
    {
        $theme = $this->app['current_theme'];
        $fileExtension = '.blade.php';

        $this->finder->files()->in($theme . 'pages')->name('*' . $fileExtension)->depth('== 0');

        $templates = array();

        foreach ($this->finder as $file) {
            $templatename = str_replace($fileExtension, '', $file->getFilename());
            $templates[] = array("id" => $templatename, "name" => $templatename . " Template");
        }

        return $templates;
    }
}