<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

  /* public function getEmail()
   {
       return view('auth.passwords.email');
   }


   public function postEmail(Request $request)
   {
       $this->validate($request, ['email' => 'required|email']);
       $response = Password::sendResetLink($request->only('email'), function (Message $message) {
           $message->subject($this->getEmailSubject());

       });

       switch ($response) {

           case Password::RESET_LINK_SENT:
              return redirect()->back()->with('status', trans($response));

           case Password::INVALID_USER:
               return redirect()->back()->withErrors(['email' => trans($response)]);
       }
   }


   public function getEmailSubject()
   {
       return isset($this->subject ) ? $this->subject : 'Your Password Reset Link';
   }
*/
  /* public function getReset($token)
   {
       if (is_null($token)) {
           throw new NotFoundHttpException;
       }

       return view('auth.reset')->with('token', $token);


   }*/

}
