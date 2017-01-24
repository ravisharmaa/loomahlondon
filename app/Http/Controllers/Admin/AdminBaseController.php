<?php
/**
 * Created by PhpStorm.
 * User: ravi
 * Date: 2017-01-24
 * Time: 4:07 PM
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\AppBaseController;
use View;


class AdminBaseController extends AppBaseController
{
    protected $header;
    protected $footer;
    protected $sidebar;
    protected $css_path;
    protected $js_path;
    protected $upload_folder;


    public function __construct()
    {
        
        $this->css_path = config('doublard.backend_assets.css');
        $this->js_path  = config('doublard.backend_assets.js');
    }

}