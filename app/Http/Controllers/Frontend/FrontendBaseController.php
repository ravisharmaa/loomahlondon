<?php
/**
 * Created by PhpStorm.
 * User: amit
 * Date: 2017-02-09
 * Time: 10:26 AM
 */

namespace App\Http\Controllers\Fronted;
use App\Http\Controllers\AppBaseController;
use View;

class FrontendBaseController extends AppBaseController
{
    protected $header;
    protected $front_css;
    protected $front_js;
    protected $view_path;
    protected $base_route;

    public function __construct()
    {
        $this->header       =   config('doublard.frontend_assets.pages.header');
        $this->front_css    =   config('doublard.frontend_assets.css_path');
        $this->front_js     =   config('doublard.frontend_assets.js_path');
    }

    public function loadDefaultVars($view_path)
    {
        View::composer($view_path, function($view) use ($view_path) {
            $view->with('base_route',       $this->base_route);
            $view->with('header',           $this->header);
            $view->with('front_css',        $this->front_css);
            $view->with('front_js',         $this->front_js);
            $view->with('view_path',        $this->view_path);
        });
        return $view_path;
    }
}