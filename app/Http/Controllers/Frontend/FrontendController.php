<?php
/**
 * Created by PhpStorm.
 * User: amit
 * Date: 2017-02-09
 * Time: 11:11 AM
 */

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Frontend\FrontendBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Mail;
use App\Model\Product;


class FrontendController extends FrontendBaseController
{
    protected $view_path    =   'frontend';
    protected $base_route   =   'marcus-paul';
    protected $extra_values =   [];
    protected $mail         =   'frontend.emails';

    public function home()
    {
        $this->extra_values['route_name']   =  Route::currentRouteName();
        return view(parent::loadDefaultVars($this->view_path.'.home',$this->extra_values));
    }

    public function rugDesigns()
    {
        $data = [];
        $data['product']    = Product::select('tbl_products.product_id','tbl_products.product_name','tbl_products.product_alias','tbl_products.product_image','tbl_product_details.product_status')
            ->leftJoin('tbl_product_details','tbl_product_details.product_id','=','tbl_products.product_id')
            ->where('tbl_product_details.product_status','=',1)
            ->orderBy('tbl_product_details.product_order','asc')
            ->paginate(15);
        return view(parent::loadDefaultVars($this->view_path.'.rug-designs'), compact('data'));
    }

    public function beSpokeRugs()
    {
        return view(parent::loadDefaultVars($this->view_path.'.bespoke-rug-service'));
    }

    public function aboutUs()
    {
        return view(parent::loadDefaultVars($this->view_path.'.about-us'));
    }

    public function contactUs()
    {
        $this->extra_values['route_name']   =  Route::currentRouteName();
        return view(parent::loadDefaultVars($this->view_path.'.contact-us'));
    }

    public function sendMail(ContactRequest $request)
    {
      $data = [
            'fullname'   =>         $request->get('full_name'),
            'email'      =>         $request->get('email'),
            'message'    =>         $request->get('message'),
      ];

      Mail::send($this->mail.'.subscription',['data'=>$data], function ($message) use ($data){
          $message->from('marcus@marcuspaul.com','Marcus Paul');
          $message->to($data['email']);
          $message->subject("FW: Marcus Paul Ltd: Enquiry Received");
      });

    }

    public function rugDetails($alias)
    {
       $data = [];
       $data = Product::select('tbl_products.product_id','tbl_products.product_name',
           'tbl_products.product_alias',
           'tbl_products.product_desc',
           'tbl_product_details.product_knotcnt',
           'tbl_product_details.product_width',
           'tbl_product_details.product_status',
           'tbl_colourways.colourway_name')
                ->leftJoin('tbl_product_details','tbl_product_details.product_id','=','tbl_products.product_id')
                ->leftJoin('tbl_colourways','tbl_colourways.product_id','=','tbl_products.product_id')
                ->where('tbl_product_details.product_status','=',1)
                ->where('tbl_colourways.colourway_default','=',1)
                ->where('tbl_products.product_alias','=',$alias)
                ->get();
       dd($data);

    }
}