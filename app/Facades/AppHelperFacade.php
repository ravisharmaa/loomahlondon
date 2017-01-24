<?php
/**
 * Created by PhpStorm.
 * User: amit
 * Date: 2017-01-24
 * Time: 3:55 PM
 */

namespace App\Facades;
use Illuminate\Support\Facades\Facade;


class AppHelperFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'apphelper';
    }
}