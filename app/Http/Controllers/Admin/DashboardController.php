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

    public function __invoke()
    {
        $this->routes['home']       =   'cms.home';
        $this->routes['dashboard']  =   'cms.dashboard';
        return view(parent::siteDefaultVars($this->view_path));
    }
}