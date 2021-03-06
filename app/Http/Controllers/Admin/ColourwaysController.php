<?php
/**
 * Created by PhpStorm.
 * User: amit
 * Date: 2017-02-13
 * Time: 12:43 PM
 */

namespace App\Http\Controllers\Admin;
use App\Classes\AppHelper;
use App\Http\Controllers\Admin\AdminBaseController;
use App\Model\Colourway;
use App\Model\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;



class ColourwaysController extends AdminBaseController
{
    protected $base_route       =   'cms.rug-designs.colourway';
    protected $view_path        =   'cms.colourway';
    protected $upload_folder    =   'images/';

    public function index()
    {
        $data = Product::select('product_id','product_name','product_desc')->get();
        return view(parent::siteDefaultVars($this->view_path.'.index'), $this->getExtraValues(), compact('data'));
    }

    public function add($id)
    {
        $product_data = Product::findOrFail($id);
        return view(parent::siteDefaultVars($this->view_path.'.add'),compact('product_data'));
    }

    public function store(Request $request)
    {
        $imageName_th = null;
        $imageName_lg = null;

        if($request->hasFile('colourway_th_image')) {
            $colourway_th_image = $request->file('colourway_th_image');
            $imageName_th = AppHelper::uploadImage($colourway_th_image, $this->upload_folder.'colourways/th/');
        }
        if($request->hasFile('colourway_lg_image')) {
            $colourway_lg_image = $request->file('colourway_lg_image');
            $imageName_lg = AppHelper::uploadImage($colourway_lg_image, $this->upload_folder . 'colourways/lg/');
        }



        $data = Colourway::create([
            'product_id'            => $request->get('product_id'),
            'colourway_name'        => $request->get('colourway_name'),
            'colourway_description' => $request->get('colourway_description'),
            'colourway_alias'       => str_slug($request->get('colourway_name')),
            'colourway_th_image'    => $imageName_th,
            'colourway_lg_image'    => $imageName_lg,
            'colourway_default'     => $request->get('colourway_default'),
            'colourway_order'       => $this->setOrderOnCreate($request->get('product_id')),
            'colourway_status'      => $request->get('colourway_status')
        ]);
        if($data->colourway_default ==1)
        Colourway::where('product_id', $data->product_id)->where('colourway_id','!=',$data->colourway_id)
                      ->update(['colourway_default'=>'0']);

        return redirect()->route($this->base_route.'.edit',[$data->colourway_id]);
    }

    public function delete($id)
    {
        $data = Colourway::findOrFail($id);
        $data->colourway_status = 3;
        $data->save();
        return redirect()->back();
    }

    public function show($id)
    {
       $data = [];
       $data['product']     =   Product::findOrFail($id);
       $data['colourways']  =   $data['product']->colourways()->orderBy('colourway_order','asc')->where('colourway_status','!=',3)->get();
       return view(parent::siteDefaultVars($this->view_path.'.partials._showdata'),compact('data'));
    }


    public function edit($id)
    {
        $data = [];
        $data['colourway']  = Colourway::findOrFail($id);
        $data['product']    = Product::findOrFail($data['colourway']->product_id);
        return view(parent::siteDefaultVars($this->view_path.'.edit',$this->getExtraValues()), compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data                   =   Colourway::findOrFail($id);
        $imageName_th = null;
        $imageName_lg = null;
        $data->colourway_name = $request->get('colourway_name');
        $data->colourway_description = $request->get('colourway_description');

            File::delete(public_path().'/'.$this->upload_folder.'colourways/th/'.$data->colourway_th_image);
            File::delete(public_path().'/'.$this->upload_folder.'colourways/lg/'.$data->colourway_th_image);

            $colourway_th_image     =   $request->file('colourway_th_image');
            $colourway_lg_image     =   $request->file('colourway_lg_image');
            $filename_th            =   $colourway_th_image->getClientOriginalName();
            $filename_lg            =   $colourway_lg_image->getClientOriginalName();
            $filename_lg            =   pathinfo($filename_lg, PATHINFO_FILENAME);
            $filename_th            =   pathinfo($filename_th, PATHINFO_FILENAME);
            $imageName_th           =   str_slug($filename_th) . '.' . $colourway_th_image->getClientOriginalExtension();
            $imageName_lg           =   str_slug($filename_lg) . '.' . $colourway_lg_image->getClientOriginalExtension();

            $colourway_th_image->move($this->upload_folder . 'colourways/th/', $imageName_th);
            $colourway_lg_image->move($this->upload_folder . 'colourways/lg/', $imageName_lg);
            $data->colourway_th_image = $imageName_th;
            $data->colourway_lg_image = $imageName_lg;

        $data->save();
        return redirect()->back();

    }

    public function getExtraValues()
    {
        $extra_values = [];
        $extra_values['scope'] = 'Colourways';
        return $extra_values;
    }

    public function changeDefault(Request $request)
    {
        $id             = $request->get('id');
        $colour_data    = Colourway::findOrFail($id);
        if($colour_data->colourway_default==1)
            $colour_data->colourway_default =0;
        else
            $colour_data->colourway_default = 1;
        $colour_data->save();

        $data = Colourway::   where('product_id', $colour_data->product_id)
                    ->where('colourway_id','!=',$colour_data->colourway_id)
                    ->update(['colourway_default'=>'0']);

        return response()->json(json_encode([
            'success'   => 'true',
            'data'      =>  $colour_data->colourway_default,
        ]));
    }

    public function changeOrder(Request $request)
    {
       $order = $request->get('order');
       $i =1 ;
       foreach ($order as $id)
       {
           $data = Colourway::findOrfail($id);
           $data->colourway_order = $i;
           $data->save();
           $i++;
       }
       return response()->json(json_encode([
           'success' => 'true',
           'order'   => $data->colourway_oder
       ]));
    }


    public function setOrderOnCreate($product_id)
    {
        $colourway_order        = Colourway::where('product_id',$product_id)->max('colourway_order');
        return $colourway_order = is_null($colourway_order) ? 1 : $colourway_order+1;
    }

    public function publishedStatus(Request $request)
    {

        $id = $request->get('id');
        $data = Colourway::find($id);
       if($data->colourway_status === 1)
           $data->colourway_status = 0;
       else
           $data->colourway_status = 1;

      $data->save();

       return response()->json(json_encode([
           'success'    =>  'true',
           'data'       =>  $data->colourway_status
       ]));


    }

    public function getColourwayData($id)
    {
        $data = Colourway::findOrFail($id);
        return response()->json(json_encode([
            'success'       =>'true',
            'data'        => [$data, $data->product]

        ]));
    }
}