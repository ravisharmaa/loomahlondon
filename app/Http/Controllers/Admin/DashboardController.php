<?php
/**
 * Created by PhpStorm.
 * User: Ravi Bastola
 * Date: 2017-01-24
 * Time: 5:12 PM
 */

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminBaseController;


class DashboardController extends AdminBaseController
{
    protected $base_route   =   'cms.dashboard';
    protected $view_path    =   'cms.dashboard.index';
    protected $routes       =   [];

    protected function getRoutes()
    {
        $this->routes['home']       = 'cms.login';
        $this->routes['about']      = 'cms.login';
        $this->routes['contact']    = 'cms.login';
        return $this->routes;
    }

    public function __invoke()
    {
        $route_data         = $this->getRoutes();
        return view(parent::siteDefaultVars($this->view_path), compact('route_data'));
    }

    public function home()
    {
        $view_path= 'cms.home';
        return view(parent::siteDefaultVars($view_path.'.home'));
    }
}