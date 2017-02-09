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
    protected $view_path    =   'frontend';
    protected $base_route   =   'frontend';

    public function __invoke()
    {
        return view(parent::loadDefaultVars($this->view_path.'.home'));
    }

    public function rugDesigns()
    {
        return view(parent::loadDefaultVars($this->view_path.'.rug-designs'));
    }

    public function beSpokeRugs()
    {
        return view(parent::loadDefaultVars($this->view_path.'.bespoke-rug-service'));
    }

    public function aboutUs()
    {
        dd('hello');
        return view(parent::loadDefaultVars($this->view_path.'.about-us'));
    }

    public function contactUs()
    {
        return view(parent::loadDefaultVars($this->view_path.'.contact-us'));
    }
}