<?php
/**
 * Created by PhpStorm.
 * User: amit
 * Date: 2017-02-13
 * Time: 12:43 PM
 */

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminBaseController;
use App\Model\Colourway;
use App\Model\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;


class ColourwaysController extends AdminBaseController
{
    protected $base_route       =   'cms.rug-designs.colourway';
    protected $view_path        =   'cms.colourway';
    protected $upload_folder    =   'images/rugs/';

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
        if ($request->hasFile('colourway_th_image') && $request->hasFile('colourway_lg_image')) {
            $colourway_th_image = $request->file('colourway_th_image');
            $colourway_lg_image = $request->file('colourway_lg_image');
            $filename_th = $colourway_th_image->getClientOriginalName();
            $filename_lg = $colourway_lg_image->getClientOriginalName();
            $filename_lg = pathinfo($filename_lg, PATHINFO_FILENAME);
            $filename_th = pathinfo($filename_th, PATHINFO_FILENAME);
            $imageName_th = str_slug($filename_th) . '.' . $colourway_th_image->getClientOriginalExtension();
            $imageName_lg = str_slug($filename_lg) . '.' . $colourway_lg_image->getClientOriginalExtension();
            if (is_dir($this->upload_folder) == false) {
                File::makeDirectory($this->upload_folder, 0777, true);
            }
            $colourway_th_image->move($this->upload_folder . 'colourway/th/', $imageName_th);
            $colourway_lg_image->move($this->upload_folder . 'colourway/lg/', $imageName_lg);
        }

        $update = DB::table('tbl_colourways')->where('product_id',$request->get('product_id'))
            ->update(['colourway_order'=>'colourway_order+1']);
        dd($update);

        $data = Colourway::create([
            'product_id' => $request->get('product_id'),
            'colourway_name' => $request->get('colourway_name'),
            'colourway_description' => $request->get('colourway_name'),
            'colourway_alias' => str_slug($request->get('colourway_name')),
            'colourway_th_image' => $imageName_th,
            'colourway_lg_image' => $imageName_lg,
            'colourway_default' => $request->get('colourway_default'),
            'colourway_order' => 1,
        ]);
        return redirect()->route($this->base_route);
    }

        //$colourway_order = Colourway::max('colourway_order')?Colourway::max('colourway_order'):1

    public function delete($id)
    {
        $data = Product::findOrFail($id);
        File::delete(public_path().'/' .$this->upload_folder. $data->product_image);
        $data->delete();
        return redirect()->route($this->base_route);
    }

    public function show($id)
    {
       $data = [];
       $data['product']     =   Product::findOrFail($id);
       $data['colourways']  =   $data['product']->colourways()->get();
       return view(parent::siteDefaultVars($this->view_path.'.partials._showdata'),compact('data'));
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
        $data->product_detail->product_knotcnt       =   $request->get('product_knotcnt');
        $data->product_detail->product_size          =     $request->get('product_size');
        $data->product_detail->save();
        return redirect()->route($this->base_route);

    }

    public function getExtraValues()
    {
        $extra_values = [];
        $extra_values['scope'] = 'Rug Designs';
        return $extra_values;
    }

    public function changeDefault(Request $request)
    {
        $id = $request->get('id');
        $data = Colourway::findOrfail($id);

        if($data->colourway_default==1)
            $data->colourway_default =0;
        else
           $data->colourway_default=1;

        $data->save();

        return response()->json(json_encode([
            'error'     =>false,
            'default'   =>$data->colourway_default
        ]));
    }
}