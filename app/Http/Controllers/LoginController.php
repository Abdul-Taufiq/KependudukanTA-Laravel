<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
    	return view('login.login' ,[
            "tittle" => "Login"
      ]);
    }

    public function postlogin(Request $request)
    {
    	// return ($request->all());
    	$credentials = $request ->validate([

    	]);

    	if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('/dashboard');
        }
 
        return back()->with('loginError', 'Username & Password Anda Salah!');
    
    }

}
