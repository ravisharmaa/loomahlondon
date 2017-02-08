<?php
/**
 * Created by PhpStorm.
 * User: Ravi
 * Date: 2017-02-08
 * Time: 10:26 AM
 */
namespace App\Captcha;

class Captcha
{
    private $code = '';

    public function code()
    {
        return $this->code;
    }

    public  function create()
    {
        header("Expires: Sun March 2017 05:00:00 AM");
        header("Last-Modified:" .gmdate("D, d M Y H:i:s"). "GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma:no-cache");
        header("Content-Type: img/png");
        $string     =   $this->randomText();
        $img        =   @imagecreate('200','200');
        $white      =   imagecolorallocate($img,200,200,200);
        $yellow     =   imagecolorallocate($img,255,255,255);
        $bgcolour   =   imagecolorallocate($img,0,0,0);
        $textcolour =   imagecolorallocate($img, 255,255,255);
        $font       =    __DIR__."./fonts/arial.ttf";
        imagettftext($img, 25,0,6,40, $yellow,$font,$string);
        imagepng($img,NULL,0);

    }

    private function randomText()
    {
        $string = '';
        $letters = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];
            for($i=0; $i<=6; $i++)
            {
                $string .= $letters[rand(0, count($letters-1))];
            }
            $this->code = $string;
            return $string;
    }
}