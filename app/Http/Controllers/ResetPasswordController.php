<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use DB; 

use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{

  public function getPassword($token) {


     return view('customauth.passwords.reset', ['token' => $token]);
  }

  public function updatePassword(Resquest $request) {

  // validation regex des variables
  $request->validate([
      'email' => 'required',
      'password' => 'required|string|min:6|confirmed',
      'password_confirmation' => 'required',

  ]);

  // on verifie si l'email existe dans la table user

        $email = $request->email;

        $user  = User::where('email',$email)->first();

        if(!user){

             return redirect('/login')->with('error', 'ce email existe pas!');

          }

        else{

        $updatePassword = DB::table('password_resets')
        ->where(['email' => $request->email, 'token' => $request->token])
        ->first();

        // modifie le mot de pass dans la table et redirection sur login

        if(!$updatePassword)
         return back()->withInput()->with('error', 'le token est invalide!!');

          $user = User::where('email', $request->email)
                ->update(['password' => Hash::make($request->password)]);

        // on suprime dans la table pass reset l'email existant
        DB::table('password_resets')->where(['email'=> $request->email])->delete();
       return redirect('/login')->with('message', 'vous avez bien modifié votre password!');

  }


}
