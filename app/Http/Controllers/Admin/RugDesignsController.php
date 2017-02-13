<?php
/**
 * Created by PhpStorm.
 * User: amit
 * Date: 2017-02-13
 * Time: 12:43 PM
 */

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminBaseController;
use App\Model\ProductDetail;
use Illuminate\Http\Request;
use App\Model\Product;
use Illuminate\Support\Str;


class RugDesignsController extends AdminBaseController
{
    protected $base_route   =   'cms.rug-designs';
    protected $view_path    =   'cms.rug-designs';

    public function index()
    {
        return view(parent::siteDefaultVars($this->view_path.'.index'), $this->getExtraValues());
    }

    public function add()
    {
        return view(parent::siteDefaultVars($this->view_path.'.add'));
    }

    public function store(Request $request)
    {
        $data = Product::create([
            'product_name'      =>  $request->get('product_name'),
            'product_desc'      =>  $request->get('product_description'),
            'product_alias'     =>  str_slug($request->get('product_name')),
        ]);
        ProductDetail::create([
            'product_id'            =>  $data->id,
            'product_knotcnt'       =>  $request->get('product_knotcnt'),
            'product_size'          =>  $request->get('product_size'),
        ]);
        return redirect()->route($this->base_route);

    }


    public function getExtraValues()
    {
        $extra_values = [];
        $extra_values['scope'] = 'Rug Designs';
        return $extra_values;
    }
}