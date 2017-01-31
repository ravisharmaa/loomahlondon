<?php
/**
 * Created by PhpStorm.
 * User: bastola.ravi@gmail.com
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
        foreach ($data as $key  => $value)
        {
            if($input==$value)
            {
               $input=$value;
            }
        }
        return $value;
    }
    /*
     * The first parameter in this function accepts an array as the parameters to determine
     * the fields and the second param defines the type which is again
     * used by the lang directory.
     *
     * */
    public static function renderHtmlForDashboard(array $params, $type='page')
    {
        ($type==='page')
        ?  $help= Lang::get('helptext.HELP_TEXT_PAGE',['page'=>$params[0]])
        :  $help= Lang::get('helptext.HELP_TEXT_PRODUCT',['product'=>$params[0]]);
            if(array_count_values($params)>2){
                $html = "<div class='maintitle' style='padding-left: 10px;'><b>".ucfirst($params[0])."</b></div>
                    $help<br>
                        <a href=".(route($params[1]))." class='dashboard_btn'>Click Here</a>";
                return $html;
            }
    }
}