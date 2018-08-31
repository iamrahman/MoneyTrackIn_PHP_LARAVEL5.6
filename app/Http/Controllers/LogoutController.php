<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;
use Auth;
use Session;
use Hash;
class LogoutController extends Controller
{
    public function getSignOut() {
        Auth::logout();
        return view('welcome');
    }
    public function setPassword(Request $request){
        $email = Session::get('email');
        $otp = Session::get('otp');
        $user_opt = $request->input('otp');
        $pass = $request->input('password');
        $cpass = $request->input('cpassword');
        if(($otp == $user_opt) && ($user_opt != null) && ($pass == $cpass)){
            $password = Hash::make($request->input('password'));
            DB::table('users')->where('email', $email)->update(['password' => $password]);
            Session::flush();
            return view('/forget_password',['success' =>'The password has been changed successfully.']);
            }
        else if(!$otp){
            Session::flush();
            return view('/reset_password',['error' =>'The OTP has been expired.Please try again.']);
        }
        else{
            return view('/reset_password',['error' =>'The OTP or Password does not matches.']);
        }
        Session::flush();
    }
    public function sendEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required']);
        $verify_email = DB::table('users')->where('email', $request->input('email'))->first();
        if(count($verify_email)){
        $otp = rand(10000,99999);
        $data =array('otp'=>$otp,'email'=>$request->input('email'));
        Session::put("otp",$otp);
        Session::put("email",$request->input('email'));
        Mail::send([], [], function ($message) use ($data) { 
            $message->to($data['email'], 'Money TrackIn')
               ->subject('OTP Password Money TrackIn') 
               ->setBody("Dear, User<br> You have requested to reset your password. Your OTP is <div style='border: solid 2px black; width: 75px;font-size:25px;'><strong> ".$data['otp']." </strong></div>", 'text/html');
            });
        return view('/reset_password',['success' =>'The OTP has been sent to your email. It will expire in 2 minute.']);
        }
        else{
            return view('/forget_password',['error' =>'Sorry..!!!The email address does not found.']);
        }
    }
}
