<?php
/**
 * Created by PhpStorm.
 * User: Ravi
 * Date: 2017-01-27
 * Time: 9:41 AM
 */

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminBaseController;


class TestController extends  AdminBaseController
{
    public function test()
    {
        return view ('cms.test');
    }
}