<?php

namespace Parkcms\Admin\Pages\Controller;

use Controller;
use View;
use Parser;
use Sentry;
use Response;

class Preview extends Controller
{
    public function previewTemplate($template)
    {
        if (View::exists('parkcms-views::pages.' . $template)) {
            $view = View::make('parkcms-views::pages.' . $template)->render();

            Parser::setSource($view);

            if (Sentry::check() && false) {
                Asset::style('pcms-frontend-style','admin_assets/css/frontend.css');
                Asset::script('pcms-frontend-js', 'admin_assets/js/frontend.js');
                $that = $this;
                Parser::pushHandler(function($type, $identifier, $data, $nodeValue) use ($that) {
                    $context = App::make('Parkcms\Context');
                    return $nodeValue . "<button data-lang='{$context->lang()}' data-identifier='{$identifier}' data-route='{$context->route()}' data-type='{$type}' class='pcms-edit-button'>Bearbeiten</button>";
                });
            }

            $parsed = Parser::parse();

            return $parsed;
        }

        return Response::make('Template not found!', 404);
    }
}