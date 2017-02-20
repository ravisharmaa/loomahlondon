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
use App\Http\Requests\ProductRequest;
use App\Model\Product;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;


class RugDesignsController extends AdminBaseController
{
    protected $base_route       =   'cms.rug-designs';
    protected $view_path        =   'cms.rug-designs';
    protected $upload_folder    =   'images/rugs/';

    public function index()
    {
        $data = Product::select('product_id','product_name','product_desc')->get();
        return view(parent::siteDefaultVars($this->view_path.'.index'), $this->getExtraValues(), compact('data'));
    }

    public function add()
    {
        return view(parent::siteDefaultVars($this->view_path.'.add'));
    }

    public function store(Request $request)
    {

        $imageName = null;
        if($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $filename = $image->getClientOriginalName();
            $filename = pathinfo($filename, PATHINFO_FILENAME);
            $imageName = str_slug($filename) . '.' . $image->getClientOriginalExtension();
            if (is_dir($this->upload_folder) == false) {
                File::makeDirectory($this->upload_folder, 0777, true);
            }
            $image->move($this->upload_folder, $imageName);
        }
            $data = Product::create([
                'product_name'  => $request->get('product_name'),
                'product_desc'  => $request->get('product_desc'),
                'product_alias' => str_slug($request->get('product_name')),
                'product_image' => $imageName
            ]);

            ProductDetail::create([
                'product_id'        => $data->product_id,
                'product_knotcnt'   => $request->get('product_knotcnt'),
                'product_size'      => $request->get('product_size'),
            ]);
        return redirect()->route($this->base_route.'.edit',[$data]);

    }


    public function delete($id)
    {
        $data = Product::findOrFail($id);
        File::delete(public_path().'/' .$this->upload_folder. $data->product_image);
        $data->delete();
        return redirect()->route($this->base_route);
    }

    public function show()
    {

        $data = Product::select('product_id','product_name','product_desc','product_image')->get();
        return view(parent::siteDefaultVars($this->view_path.'.partials._showdata'), compact('data'));
    }


    public function edit($id)
    {
        $data = Product::findOrFail($id);
        return view(parent::siteDefaultVars($this->view_path.'.edit',$this->getExtraValues()), compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data                   =   Product::findOrFail($id);
        $data->product_name     =   $request->get('product_name');
        $data->product_desc     =   $request->get('product_desc');

        if($request->hasFile('product_image'))
        {
            File::delete(public_path().'/' .$this->upload_folder. $data->product_image);
            $image          = $request->file('product_image');
            $filename       = $image->getClientOriginalName();
            $filename       = pathinfo($filename, PATHINFO_FILENAME);
            $imageName      = str_slug($filename) . '.' . $image->getClientOriginalExtension();
            if (is_dir($this->upload_folder) == false) {
                File::makeDirectory($this->upload_folder, 0777, true);
            }
            $image->move($this->upload_folder, $imageName);
            $data->product_image = $imageName;
        }
        $data->save();
        $data->product_detail->product_knotcnt       =      $request->get('product_knotcnt');
        $data->product_detail->product_size          =      $request->get('product_size');
        $data->product_detail->save();
        return redirect()->route($this->base_route);

    }

    public function getExtraValues()
    {
        $extra_values = [];
        $extra_values['scope'] = 'Rug Designs';
        return $extra_values;
    }


    public function sorter(Request $request)
    {
        $orderArray = $request->get('order');
        $i = 1;
        dd($orderArray);
        foreach ($orderArray as $key => $value)
        {
            DB::table('tbl_product_details')->where('product_id','=', $value)->toSql();
            $i++;
        }
        return response()->json(json_encode([
            'message'=>'Success',
        ]));

    }

    public function setStatus(Request $request)
    {
       $id      = $request->get('id');
       $data    = Product::findOrFail($id);
       if($data->product_detail->product_status==1)
           $data->product_detail->product_status = 0;
       else
           $data->product_detail->product_status = 1;

       $data->product_detail->save();

       return response()->json(json_encode([
           'success'        => 'true',
           'product_status' =>  $data->product_detail->product_status
       ]));
    }

}