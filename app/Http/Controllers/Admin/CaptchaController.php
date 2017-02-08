<?php
/**
 * Created by PhpStorm.
 * User: amit
 * Date: 2017-02-08
 * Time: 11:20 AM
 */

namespace App\Http\Controllers\Admin;
use App\Captcha\captcha;
use Illuminate\Support\Facades\Session;


class CaptchaController extends AdminBaseController
{
    public function start()
    {
        $captcha = new Captcha();
        $data = Session:: put('captcha', $captcha->code());
        return view('cms.test')->with('data', $data);


    }
}