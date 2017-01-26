<?php
/**
 * Created by PhpStorm.
 * User: ravi
 * Date: 2017-01-24
 * Time: 3:54 PM
 */
namespace App\Classes;
use App\Model\SiteConfig;
use Illuminate\Support\Facades\Lang;

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
               if($input===$value){
                   return  $value;
               } else {
                   return "Could not complete your request";
               }
           }

    }

    /*
     * Params: array
     *
     * */


    public static function renderHtmlForDashboard(array $params)
    {
       $help= Lang::get('helptext.HELP_TEXT_PAGE',['page'=>$params[1]]);
        if(array_count_values($params)>3){
            $html = "<div class='$params[0]' style='padding-left: 10px;'><b>".ucfirst($params[1])."</b></div>
                    $help<br>
                        <a href='$params[2]' class='dashboard_btn'>Click Here</a>";
            return $html;
        }


    }
}