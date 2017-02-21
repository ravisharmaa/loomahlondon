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
use Illuminate\Support\Facades\File;

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

    public static function getDefaultRouteParams($route)
    {
        return $data = 'marcus-paul'.".".$route;
    }

    public static function getProductRelationValues($model_var, $relation)
    {
        if($model_var->product_detail){
            return $model_var->product_detail->$relation;
        }
    }

    public static function uploadImage($imageFile, $destinationFolder)
    {
        $filename = $imageFile->getClientOriginalName();
        $filename = pathinfo($filename, PATHINFO_FILENAME);
        $imageName = str_slug($filename). '.' .$imageFile->getClientOriginalExtension();
        if (is_dir($destinationFolder) == false) {
            File::makeDirectory($destinationFolder, 0777, true);
        }
        $imageFile->move($destinationFolder, $imageName);
        return $imageName;
    }
}