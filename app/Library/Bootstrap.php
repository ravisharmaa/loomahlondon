<?php
/**
 * Created by PhpStorm.
 * User: amit
 * Date: 2017-01-26
 * Time: 3:55 PM
 */

namespace App\Library;


use Illuminate\Support\Facades\Route;
use PhpParser\Autoloader;


class Bootstrap
{
    public function __autoload()
    {
        Autoloader::register('mylibrary');
        Autoloader::autoload('mylibrary');
    }
}