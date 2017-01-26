<?php
/**
 * Created by PhpStorm.
 * User: amit
 * Date: 2017-01-26
 * Time: 3:52 PM
 */

namespace App\Library;
use App\Library\Bootstrap;


class MyLibrary extends Bootstrap
{
    protected $methods= ['get','post','put','patch','delete'];

    public static function isMySignature($data)
    {
        for($i=0; $i<count($data); $i++)
        {
            echo $data[$i];
        }
    }

    protected static function open()
    {

    }

    public static function text(array $params)
    {
        $html = "<input type='text' name='$params[0]'>";
    }
}