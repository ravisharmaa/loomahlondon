<?php
/**
 * Created by PhpStorm.
 * User: Ravi
 * Date: 2017-02-09
 * Time: 10:26 AM
 */

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\AppBaseController;
use View;

class FrontendBaseController extends AppBaseController
{
    protected $header;
    protected $nav;
    protected $front_css;
    protected $front_js;
    protected $test_images_url;
    protected $view_path;
    protected $base_route;

    public function __construct()
    {
        $this->header           =   config('doublard.frontend_assets.pages.header');
        $this->front_css        =   config('doublard.frontend_assets.css_path');
        $this->front_js         =   config('doublard.frontend_assets.js_path');
        $this->nav              =   config('doublard.frontend_assets.pages.nav-bar');
        $this->test_images_url  =   config('doublard.frontend_assets.test_images');
    }

    public function loadDefaultVars($view_path)
    {
        View::composer($view_path, function($view) use ($view_path) {
            $view->with('base_route',       $this->base_route);
            $view->with('header',           $this->header);
            $view->with('front_css',        $this->front_css);
            $view->with('front_js',         $this->front_js);
            $view->with('view_path',        $this->view_path);
            $view->with('nav',              $this->nav);
            $view->with('test_images_url',  $this->test_images_url);
        });
        return $view_path;
    }
}