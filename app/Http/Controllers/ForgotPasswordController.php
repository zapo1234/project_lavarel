<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB; 
use Carbon\Carbon; 
use Mail; 

class ForgotPasswordController extends Controller
{
    //

    public function getEmail(){

        return view('customauth.passwords.email');
    }


    public function PostEmail(Request $request) {

     // verifier l'unicité du programe'
    $email = $request->email;
    $user  = User::where('email',$email)->first();

    if(!$user) {

       return back()->with('status', ' ce mail n\'existe pas');

     }

    else{
    // créer un token  dans la table password reset
    $token = str_random(64);

      DB::table('password_resets')->insert(
          ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
      );

      Mail::send('customauth.verify', ['token' => $token], function($message) use($request){
          $message->to($request->email);
          $message->subject('Mise à jours de votre password');
      });

      return back()->with('message', 'vous recevez un email dans votre boite email!');

      }
    }
}
