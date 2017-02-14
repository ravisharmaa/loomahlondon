<?php
/**
 * Created by PhpStorm.
 * User: ravi
 * Date: 2017-01-24
 * Time: 4:07 PM
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\AppBaseController;
use View;


class AdminBaseController extends AppBaseController
{
    protected $header;
    protected $footer;
    protected $navbar;
    protected $sidebar;
    protected $css_path;
    protected $js_path;
    protected $upload_folder;
    protected $base_route;
    protected $view_path;
    protected $menus;
    protected $default_images;


    public function __construct()
    {

        $this->css_path             = config('doublard.backend_assets.css');
        $this->js_path              = config('doublard.backend_assets.js');
        $this->upload_folder        = config('doublard.backend_assets.upload_locs.upload_folder');
        $this->header               = config('doublard.backend_assets.pages.header');
        $this->navbar               = config('doublard.backend_assets.pages.navbar');
        $this->menus                = config('doublard.menus');
        $this->default_images       = config('doublard.backend_assets.default_images');

    }

    public function siteDefaultVars($view_path, $extra_values= null)
    {
       /*
        * Documentation: This standard function loads default variables used in each view file.
        * */
        View::composer($view_path, function ($view) use($view_path, $extra_values) {
           $view->with('base_route',        $this->base_route);
           $view->with('view_path',         $this->view_path);
           $view->with('header',            $this->header);
           $view->with('sidebar',           $this->sidebar);
           $view->with('upload_folder',     $this->upload_folder);
           $view->with('default_images',    $this->default_images);
           $view->with('css_path',          $this->css_path);
           $view->with('js_path',           $this->js_path);
           $view->with('navbar',            $this->navbar);
           $view->with('menus',             $this->menus);
           $view->with('extra_values',      $extra_values);
        });
        return $view_path;
    }
}