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


class FrontendController extends FrontendBaseController
{
    protected $view_path    =   'frontend';
    protected $base_route   =   'marcus-paul';
    protected $extra_values =   [];
    protected $mail         =   'frontend.emails';

    public function __invoke()
    {
        $this->extra_values['route_name']   =  Route::currentRouteName();
        return view(parent::loadDefaultVars($this->view_path.'.home',$this->extra_values));
    }

    public function rugDesigns()
    {
        return view(parent::loadDefaultVars($this->view_path.'.rug-designs'));
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
      return response()->json('Success');
    }
}