<?php
/**
 *
 * Created by PhpStorm.
 * User: Ravi
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
        //this opens the form when called
    }

    public static function text(array $params, $extra_values=[])
    {
        $html = "<input type='text' name='$params[0]'>";
        return $html;
    }

    protected static function close()
    {
        //this closes the form
    }

    protected static function textarea()
    {
        //function for textarea
    }

    protected static function radio()
    {
        //this makes the radio input
    }

    protected static function file()
    {
        //this makes the input field for files
    }

    protected static function select()
    {
        //this generates the input field for the select box
    }


}