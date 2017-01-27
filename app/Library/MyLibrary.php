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
    protected static $html;
    protected static $model;

    public static function isMySignature($data)
    {
        for($i=0; $i<count($data); $i++)
        {
            echo $data[$i];
        }
    }

    public static function label()
    {
        //the form label goes here
    }

    protected static function open()
    {
        //this opens the form when called
    }

    public static function text($name, $params=[])
    {
        dd($params);
        echo self::$html = "<input type='' name=''>";
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