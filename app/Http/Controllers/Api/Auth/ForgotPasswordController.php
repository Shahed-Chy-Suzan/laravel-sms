<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Mail;

class ForgotPasswordController extends Controller
{
    public function forgotPassword(Request $request){
        $validate = Validator::make($request->all(),[
            'email' => 'required|email|exists:users',
       ]);

       if ($validate->fails()) {
           return response()->json([
               'errors' => $validate->errors()
           ],422);
       }

       $email = $request->email;
       $token = Str::random(65);

       DB::table('password_resets')->insert([
           'email' => $email,
           'token' => $token,
           'created_at' => now()->addHours(1)       //token will valid for 1hour
       ]);

       //------ Mail Send -------
       Mail::send('mail.password_reset',['token' => $token], function($msg) use ($email){
           $msg->to($email);
           $msg->subject('Password Reset Email | Laravel-VueCli-Passport');
       });

       return response()->json([
            'message' => 'Password Reset Mail Send Successfully, Please Check Your Email'
       ]);

    }

}
