<?php
/**
 * Created by PhpStorm.
 * User: amit
 * Date: 2017-02-13
 * Time: 12:43 PM
 */

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminBaseController;


class RugDesignsController extends AdminBaseController
{
    protected $base_route   =   'cms.rug-designs';
    protected $view_path    =   'cms.rug-designs';

    public function index()
    {
        return view(parent::siteDefaultVars($this->view_path.'.index'), $this->getExtraValues());
    }

    public function add()
    {
        return view(parent::siteDefaultVars($this->view_path.'.add'));
    }

    public function store(Request $request)
    {
        dd($request);
    }


    public function getExtraValues()
    {
        $extra_values = [];
        $extra_values['scope'] = 'Rug Designs';
        return $extra_values;
    }
}