<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class authController extends Controller
{
    //

    function login()
    {
        return view('auth.login');
    }

     function loginPost(Request $req){

         $credentials=[
             'email'=>$req['email'],
             'password'=> $req['password']
         ];

         if(Auth::attempt($credentials)){
             return redirect()->intended(route('dashboard'));
         }

         return 'User is not Exist';
     }
}
