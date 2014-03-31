<?php

use Parkcms\Models\Page;
use Parkcms\Context;
use Parkcms\Template\AttributeParser as Parser;
use Parkcms\Template\ArgumentConverter as Converter;
use Parkcms\Programs\Manager;

class PageController extends Controller {

    protected $parser;
    protected $manager;

    protected $page;

    /**
     *
     * @param Parser  $parser
     * @param Manager $manager
     */
    public function __construct(Manager $manager) {
        $this->parser = new Parser(new Converter(), App::make('events'));
        $this->manager = $manager;

        $this->parser->setPrefix('pcms-');
    }

    public function index($lang = null) {

        // @TODO: get user language
        if(is_null($lang)) {
            $lang = 'de';
        }

        $root = $this->lookupRoot($lang);

        $startPage = $root->children()->first();

        if($startPage !== null) {
            return Redirect::to('/' . $lang . '/' . $startPage->alias);
        }
    }

    /**
     * display the page, found by given route
     * @param  string $route page route (e.g. home)
     * @param  string $attributes atributes slash imploded (e.g. year/2014)
     * @return string rendered page
     */
    public function showPage($lang, $route, $attributes = null)
    {
        if($attributes !== null) {
            $attributes = explode('/', $attributes);
        } else {
            $attributes = array();
        }

        // look up page tree root determined by user language
        $root = $this->lookupRoot($lang);

        // look up
        $this->page = $root->descendants()->where('alias', $route)->first();

        // if $this->page is null, page doesn't exists in database
        if($this->page === null) {
            App::abort(404);
        }

        // Register objects to the IoC
        App::instance('Parkcms\Models\Page', $this->page);
        App::instance('Parkcms\Context', new Context($route, $this->page, $attributes));

        return $this->renderPage();
    }

    /**
     * renders the current page template
     * @return string
     */
    protected function renderPage() {

        $view = View::make('page_templates.' . $this->page->template)->render();

        $this->parser->setSource($view);

        $that = $this;
        $this->parser->pushHandler(function($type, $identifier, $data, $nodeValue) use($that) {
            if($program = $that->manager->lookup($type, $identifier, $data)) {
                return $program->render();
            }
            return null;
        });

        if (Sentry::check()) {
            Asset::style('pcms-frontend-style','admin_assets/css/frontend.css');
            Asset::script('pcms-frontend-js', 'admin_assets/js/frontend.js');
            $this->parser->pushHandler(function($type, $identifier, $data, $nodeValue) use ($that) {
                $context = App::make('Parkcms\Context');
                return $nodeValue . "<button data-lang='{$context->lang()}' data-identifier='{$identifier}' data-route='{$context->route()}' data-type='{$type}' class='pcms-edit-button'>Bearbeiten</button>";
            });
        }

        return $this->parser->parse();
    }

    protected function lookupRoot($lang) {
        $select = Page::roots()->where('title', $lang);

        if(strlen($lang) == 5) {
            $select->orWhere('title', substr($lang, 0, 2));
        }

        $select->reOrderBy(DB::raw('LENGTH(title)'), 'desc')->orderBy('lft');

        $root = $select->first();

        if($root === null) {
            App::abort(404);
        }

        return $root;
    }
}
