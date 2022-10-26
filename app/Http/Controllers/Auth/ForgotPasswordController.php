<?php

namespace App\Http\Controllers\Auth; 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use DB; 
use Carbon\Carbon; 
use App\Models\User; 
use Mail; 
use Hash;
use Illuminate\Support\Str;


class ForgotPasswordController extends Controller

{

  /**
   * Write code on Method
   *
   * @return response()
   */

  public function showForgetPasswordForm()

  {
     return view('register.forgetPassword');
 }

  /**
   * Write code on Method
   *
   * @return response()
   */

  public function submitForgetPasswordForm(Request $request)

  {
      $request->validate([
        'email' => 'required|email|exists:users',
     ], [
        // PESAN ERROR
        'email.required' => 'Kolom Tidak Boleh Kosong!',
        'email.email' => 'Format Email Tidak Valid!',
        'email.exists' => 'Email Anda Tidak Terdaftar!',
    ]);

      $token = Str::random(60);

      DB::table('password_resets')->insert([
          'email' => $request->email, 
          'token' => $token, 
          'created_at' => Carbon::now()

      ]);

      Mail::send('email.forgetPassword', ['token' => $token], function($message) use($request){
          $message->to($request->email);
          $message->subject('Reset Password');
      });

      return back()->with('message', 'Link Reset Password Akan Dikirimkan Ke Email Anda, Silahkan Cek Email Anda!');

  }

  /**
   * Write code on Method
   *
   * @return response()
   */

  public function showResetPasswordForm($token) { 

     return view('register.forgetPasswordLink', ['token' => $token]);

 }

  /**
   * Write code on Method
   *
   * @return response()
   */

  public function submitResetPasswordForm(Request $request)
  {
      $request->validate([
          'email' => 'required|email|exists:users',
          'password' => 'required|string|min:8|confirmed',
          'password_confirmation' => 'required'
       ], [
        // PESAN ERROR
        'email.email' => 'Email Yang Anda Masukan Tidak Valid!',
        'email.exists' => 'Email Anda Salah!',
        'password.min' => 'Password Minimal 8 Karakter!',
        'password.confirmed' => 'Konfirmasi Password Tidak Cocok!',

        ]);

      $updatePassword = DB::table('password_resets')
      ->where([
        'email' => $request->email, 
        'token' => $request->token
    ])
      ->first();

      if(!$updatePassword){

          return back()->withInput()->with('error', 'Invalid token!');
      }

      $user = User::where('email', $request->email)
      ->update(['password' => Hash::make($request->password)]);
      DB::table('password_resets')->where(['email'=> $request->email])->delete();

      return redirect('/login')->with('message', 'Password Anda Berhasil Direset!');
  }
}