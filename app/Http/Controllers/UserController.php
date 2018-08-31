<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Hash;
use Auth;
use Mail;
use Storage;
use Session;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        echo "Index";  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        echo "create";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required',
            'email' => 'required|min:6',
            'gender' => 'required',
            'password' => 'required',
            'cpassword' => 'required',
            'lang' => 'required',
            'maritial_status' => 'required',
            'currency' => 'required',
            'dob' =>'required',
            'employee' => 'required',
            'country' => 'required'
        ]);
        if($request->input('password')==$request->input('cpassword'))
        {
            $user_exist_username  = User::where('username',$request->input('username'))->get();
            $user_exist_email  = User::where('email',$request->input('email'))->get();
            if(count($user_exist_username)>0){
                return back()->with('error','The username already exist. Please try another username');
            }
            else if(count($user_exist_email)>0){
                return back()->with('error','Sorry !!.The email address already exist.');
            }
            else{
            $user = new User;
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $user->gender = $request->input('gender');
            $user->maritial_status = $request->input('maritial_status');
            $user->dob = $request->input('dob');
            $user->currency_id = $request->input('currency');
            $user->language_id = $request->input('lang');
            $user->employment_id = $request->input('employee');
            $user->country = $request->input('country');
            $user->receive_mail_notify = 0;
            $user->account_status = 1;
            $user->photo = "public/default.png";
            $user->password = Hash::make($request->input('password'));
            $data =array('name'=>$request->input('username'),'email'=>$request->input('email'));
            Mail::send([], [], function ($message) use ($data) { 
                $message->to($data['email'], 'Money TrackIn')
                   ->subject('Welcome to Money TrackIn') 
                   ->setBody("<div style='background-color: #ebebe0;'>
                   <div style='width: 60%; margin-left:20%;background-color: white;'>
                   <img  style='height:30%; width:100%;' src='https://lh4.googleusercontent.com/HwOxNPYYidoBC2h9Dk5f6B7Qnc--u43qYWPFUlkNLaRs0jS9sX_l-5GyoaijhLUqs_GbBKtM2VXfeikUdCTP=w1301-h678-rw'>
                   <br>
                   <p style='font-size:20px; margin-left:10px;'>Hey ".$data['name'].",</p><br>
                   <p style='font-size:20px; margin-left:10px;'>Welcome to MoneyTrackIn</p>
                   <p style='font-size:15px; margin-left:10px;'>Thanks for registration, Greeting's from the team MoneyTrackIn, we hope that you will enjoy our services.</p>
                   <p style='margin-left:10px;'>Go ahead and login</p><a href='/'><button style='background-color: #660033; color:white; width:100px;'> Login </button></a>
                   <p style='font-size:15px; margin-left:10px;'>Thanks<br> Team Money TrackIn</p>
                   </div>
                   </div>", 'text/html');
              });
            $user->save();
            return back()->with('success','Registration successfully!');
        }
    }
        else{
            return back()->with('error','Password does not match');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        echo "show";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        echo "Edit";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user_update  = User::where('id',$id)->first();
        $user_update->username = $request->input('username');
        $user_update->email = $request->input('email');
        $user_update->receive_mail_notify = $request->input('receive_mail_notify');
        $user_update->maritial_status = $request->input('maritial_status');
        $user_update->country = $request->input('country_id');
        $user_update->dob = $request->input('dob');
        $user_update->language_id = $request->input('language_id');
        $user_update->currency_id = $request->input('currency_id');
        $user_update->employment_id = $request->input('employment_id');
        $user_update->gender = $request->input('gender');
        $user_update->place = $request->input('place');
        if($request->file('photo')){
            $file_name = $request->file('photo')->store('public');
            $user_update->photo = $file_name;
        }
        $user_update->save();
        $img_url = Storage::url(Auth::user()->photo);
        Session::put('img_url',$img_url);
        return view('/profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
