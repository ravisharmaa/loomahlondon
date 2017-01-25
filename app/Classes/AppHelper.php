<?php
/**
 * Created by PhpStorm.
 * User: ravi
 * Date: 2017-01-24
 * Time: 3:54 PM
 */
namespace App\Classes;
use App\Model\SiteConfig;


class AppHelper
{
    public static function getConfigValues($key)
    {
        $data = SiteConfig::where('key', $key)->first();
        if(isset($data->value)){
            return $data->value;
        } else {
            $rtnVal= AppHelper::getConstantValues($key);
            return $rtnVal;

        }

    }

    public static function getConstantValues($input)
    {
        $data= config('doublard.site-configs');
           foreach ($data as $key => $value)
           {
               if($input==$value){
                   return  $value;
               } else {
                   return "Could not complete your request";
               }
           }

    }
}