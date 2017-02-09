<?php
/**
 * Created by PhpStorm.
 * User: amit
 * Date: 2017-02-09
 * Time: 11:11 AM
 */

namespace App\Http\Controllers\Fronted;
use App\Http\Controllers\Fronted\FrontendBaseController;


class FrontendController extends FrontendBaseController
{
    protected $view_path    =   'frontend.home';
    protected $base_route   =   'frontend.home';

    public function __invoke()
    {
        return view(parent::loadDefaultVars($this->view_path.'.index'));
    }
}