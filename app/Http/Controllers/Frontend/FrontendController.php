<?php
/**
 * Created by PhpStorm.
 * User: amit
 * Date: 2017-02-09
 * Time: 11:11 AM
 */

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Frontend\FrontendBaseController;


class FrontendController extends FrontendBaseController
{
    protected $view_path    =   'frontend.layout';
    protected $base_route   =   'frontend.home';

    public function __invoke()
    {
        return view(parent::loadDefaultVars($this->view_path.'.master'));
    }
}