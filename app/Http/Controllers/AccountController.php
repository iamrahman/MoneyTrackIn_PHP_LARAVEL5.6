<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Account;
use App\User;
use App\Tag;
use App\Transaction;
use App\Transactionandtag;
use App\Periodic;
use Auth;
use Session;
use Storage;
use App\Alert;
class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $id = Auth::user()->id;
        $accounts_data = Account::where('user_id', $id)->get();
        return view('dashboard', compact('accounts_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'account_name' => 'required',
            'initial_balance' => 'required'
        ]);
        $update  = Account::where('user_id', Auth::user()->id)->get();
        if (count($update)<4)
        {
            $account = new Account;
            $account->name = $request->input('account_name');
            $account->initial_balance = $request->input('initial_balance');
            $account->user_id = Auth::user()->id;
            $account->currency_id = Auth::user()->currency_id;
            $account->current_balance = $request->input('initial_balance');
            $account->save();
            $trans = new Transaction;
            $trans->account_id = Auth::user()->id;
            $trans->description = "Opening balance";
            $trans->tags = "Opening_Balance";
            $trans->amount = $request->input('initial_balance');
            $trans->date =  date('Y-m-d H:i:s');
            $trans->previous_balance = 0;
            $trans->current_balance = $request->input('initial_balance');
            $trans->account_name = $request->input('account_name');
            $trans->type = 0;
            $trans->save();
            return back()->with('success','Account Created Successfully..!!!. Redirect in 3 sec...');
            sleep(5000);
            return redirect('/dashboard');
        }
        else{
            return back()->with('error','You have created Maximum number of accounts.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        dd(1);
        echo "Hello Edit";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $account)
    {
        $validatedData = $request->validate([
            'to_account' => 'required',
            'amount_transfer' => 'required',
            'description' => 'required',
        ]);
        //Common attribute for both (act to act) and (debit&credit)
        $to = $request->input('to_account');
        $trans_amount = $request->input('amount_transfer');
        $description = $request->input('description');
        //Atrribute for (act to act)
        $from = $request->input('from_account');
        //Attribute for (debit&credit)
        $trans_type = $request->input('trans_type');
        //Condition that check request
        if($from==null && $trans_type != null){
            $update  = Account::where('user_id', $account)->where('name', $to)->first();
            if($trans_type == 1){
                $total_amount = $trans_amount + $update->current_balance;
                $prev_bal = $update->current_balance;
                $c_bal = $update->current_balance;
                $update->current_balance = $total_amount;
                $trans = new Transaction;
                $trans->account_id = Auth::user()->id;
                $trans->description = $description;
                $trans->tags = "Amount_Added";
                $trans->amount = $trans_amount;
                $trans->date =  date('Y-m-d H:i:s');
                $trans->previous_balance = $c_bal;
                $trans->current_balance = $c_bal;
                $trans->account_name = $to;
                $trans->type = 0;
                $update->save();
                $trans->save();
                return back()->with('success','Rs.'.$trans_amount.' has been credit to'. $to .' successfully.!!');
            }
            else if($trans_type == 0){
                if($update->current_balance >= $trans_amount){
                    $total_amount = $update->current_balance - $trans_amount;
                    $prev_bal = $update->current_balance;
                    $c_bal = $update->current_balance;
                    $update->current_balance = $total_amount;
                    $trans = new Transaction;
                    $trans->account_id = Auth::user()->id;
                    $trans->description = $description;
                    $trans->tags = $request->input('tags');
                    $trans->amount = $trans_amount;
                    $trans->date =  date('Y-m-d H:i:s');
                    $trans->previous_balance = $prev_bal;
                    $trans->current_balance = $c_bal;
                    $trans->account_name = $to;
                    $trans->type = 1;
                    $update->save();
                    $trans->save();
                    $tags = $request->input('tags');
                    $myTags = explode(',', $tags);
                    $tag_length = sizeof($myTags);
                    $transaction_id = $trans->id; //trans id
                    for($i=0;$i<$tag_length;$i++){   
                    $query_tags = Tag::where('user_id', $account)->where('name', $myTags[$i])->first();
                       if(!$query_tags){
                          $tag = new Tag;
                          $tag->name = $myTags[$i];
                          $tag->expenditure = $trans_amount;
                          $tag->user_id = Auth::user()->id;
                          $tag->save();
                          $tag->transactions()->attach($transaction_id);
                       }
                        else{
                         $query_tags->expenditure = $query_tags->expenditure + $trans_amount;
                         $query_tags->save();
                         $query_tags->transactions()->attach($transaction_id);
                        }
                    }
                    if($total_amount<500){
                        $alert = new Alert;
                        $alert->user_id = Auth::user()->id;
                        $alert->notification = "You account ".$to." is ".'<br>'."ruuning with low balance.";
                        $alert->save();
                        $user_alert = Alert::select('notification')->where('user_id',Auth::user()->id)->get();
                        Session::put('user_alert',$user_alert);
                    }
                    return back()->with('success','Rs.'.$trans_amount.' has been debit from '. $to .' successfully.!!');
                }
                else{
                    return back()->with('error',"Request Canceled..!!!, due to insufficient balance.");
                }
            }
            else {
                return back()->with('error',"Something went Wrong");
            }
        }
        else if($from != null && $trans_type==null){
        //Account Query
        $update  = Account::where('user_id', $account)->where('name', $from)->first();
        $update1  = Account::where('user_id', $account)->where('name', $to)->first();
        if($from == $to)
        {
            return back()->with('error',"Sorry..!!, You can't transfer in same Account");
        }
        else{
            if ($update && $update1) {
                if($update->current_balance >= $trans_amount)
                {
                    $prev_bal = $update->current_balance;
                    $prev_bal1 = $update1->current_balance;
                    $update->current_balance = $update->current_balance - $trans_amount;
                    $update1->current_balance = $update1->current_balance + $trans_amount;
                    $update->save();
                    $update1->save();
                    //Transaction Query
                    $trans = new Transaction;
                    $trans->account_id = Auth::user()->id;
                    $trans->description = $request->input('description');
                    $trans->tags = "Amount_Transfered";
                    $trans->amount = $request->input('amount_transfer');
                    $trans->date =  date('Y-m-d H:i:s');
                    $trans->previous_balance = $prev_bal;
                    $trans->current_balance = $update->current_balance;
                    $trans->account_name = $update->name;
                    $trans->type = 1;
                    $trans->save();
                    $trans1 = new Transaction;
                    $trans1->account_id = Auth::user()->id;
                    $trans1->description = $request->input('description');
                    $trans1->tags = "Amount_Recived";
                    $trans1->amount = $request->input('amount_transfer');
                    $trans1->date =  date('Y-m-d H:i:s');
                    $trans1->previous_balance = $prev_bal1;
                    $trans1->current_balance = $update1->current_balance;
                    $trans1->account_name = $update1->name;
                    $trans1->type = 0;
                    $trans1->save();
                    return back()->with('success','Your ammount Rs.'.$trans_amount.' has been transfered successfully.!!');
                }
                else{
                    return back()->with('error','Sorry...!!!, You have insufficent Balance');
                }
            }
            else{
                return back()->with('error','Something went wrong');
            }
        }
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        echo "Echo";
    }
    public function accountName(){
        $id = Auth::user()->id;
        $accounts_data = Account::where('user_id', $id)->get();
        return view('account_account_transfer', compact('accounts_data'));
    }
    public function history(){
        $id = Auth::user()->id;
        $accounts_data = Account::where('user_id', $id)->get();
        $transaction_data = Transaction::where('account_id', $id)->orderBy('date', 'DESC')->paginate(19);
        return view('history', compact('accounts_data', 'transaction_data'));
    }
    public function inAccountTransfer(){
        $id = Auth::user()->id;
        $accounts_data = Account::where('user_id', $id)->get();
        $transaction_data = Transaction::where('account_id', $id)->get();
        $tags_data = Tag::where('user_id', $id)->get();
        $tags_user_id = [];
        $tags_name = [];
        $i = 0;
        $tag_count = [];
        $k = 0;
        foreach ($tags_data as $tag){
            $tags_user_id[$i] = $tag->id;
            $tags_name[$i] = $tag->name;
            $i++;
        }
        $users = DB::table('tag_transaction')->distinct()->get();
        foreach ($users as $tag){
            $tag_id[$k] = $tag->tag_id; //store the tag_id in array
            $k++;
        }
        for($i = 0;$i< sizeof($tags_user_id);$i++){
            $tag_count[$i] =0; // initialize the array with all value zero
        }
        for($i = 0;$i< sizeof($tags_user_id);$i++){
            for($j = 0;$j< sizeof($tag_id);$j++){
                if($tags_user_id[$i] == $tag_id[$j]){
                    $tag_count[$i] = $tag_count[$i]+1; //count the number each of tags of the user
                }
            }
        }
        //Find the top 3 famous tags
        $temp =$tag_count;
        if(sizeof($tag_count)<=0){
            $tags_top =array();
        }
        else if(sizeof($tag_count)==1){
            $max1 = max($temp);
            $max1_index = array_search($max1, $temp);
            $tags_top =array($tags_name[$max1_index]);
        }
        else if(sizeof($tag_count)==2){
            $max1 = max($temp);
            $max1_index = array_search($max1, $temp);
            $temp[$max1_index] =0;
            $max2 = max($temp);
            $max2_index = array_search($max2, $temp);
            $tags_top =array($tags_name[$max1_index],$tags_name[$max2_index]);
        }
        else{
        $max1 = max($temp);
        $max1_index = array_search($max1, $temp);
        $temp[$max1_index] =0;
        $max2 = max($temp);
        $max2_index = array_search($max2, $temp);
        $temp[$max2_index] =0;
        $max3 = max($temp);
        $max3_index = array_search($max3, $temp);
        $tags_top =array($tags_name[$max1_index],$tags_name[$max2_index],$tags_name[$max3_index]);
        }
        return view('with_in_account', compact('accounts_data', 'tags_top', 'transaction_data'));
    }

    public function periodicTransaction(){
        $id = Auth::user()->id;
        $accounts_data = Account::where('user_id', $id)->get();
        $transaction_data = Transaction::where('account_id', $id)->get();
        $tags_data = Tag::where('user_id', $id)->get();
        $tags_user_id = [];
        $tags_name = [];
        $i = 0;
        $tag_count = [];
        $k = 0;
        foreach ($tags_data as $tag){
            $tags_user_id[$i] = $tag->id;
            $tags_name[$i] = $tag->name;
            $i++;
        }
        return view('periodic_transaction', compact('accounts_data', 'tags_top', 'transaction_data'));
    }
    public function periodicUpdate(Request $request){
        $validatedData = $request->validate([
            'time_span' => 'required',
            'amount' => 'required',
            'account' => 'required',
        ]);
        $check = Periodic::where('user_id',Auth::user()->id)->where('account_name','account')->get();
        if(count($check) == 0){
        $periodic = new Periodic;
        $periodic->user_id = Auth::user()->id;
        $periodic->account_name = $request->input('account');
        $periodic->amount = $request->input('amount');
        $periodic->duration = $request->input('time_span');
        $periodic->duration_left = $request->input('time_span');
        $periodic->tags  = $request->input('tags');
        $periodic->save();
        return back()->with('success','Periodic Transaction has been set successfully...!!');
        }
        else{
            return back()->with('error','Periodic Transaction is already set in this account. Please try another account');
        }
    }
    public function setting(){
        $periodic = Periodic::where('user_id',Auth::user()->id)->get();
        $account_name = Account::where('user_id',Auth::user()->id)->get();
        return view('account_setting',compact('periodic','account_name'));
    }
    public function graphsData(){
        $id = Auth::user()->id;
        $users_tags = Tag::where('user_id', $id)->get();
        $accounts_name = Account::where('user_id', $id)->get();
        $tags_user_id = [];
        $i = 0;
        $heading = "Overall expediture data";
        foreach ($users_tags as $tag){
            $tags_user_id[$i] = $tag->id;
            $tags_user_name[$i] = $tag->name;
            $tags_expnd[$i] = $tag->expenditure;
            $i++;
        }
        return view('graphs', compact('tags_user_name','tags_expnd','accounts_name','heading'));
    }
    public function graphfilter(Request $request)
    {
        $from = $request->input('from_date')." "."00:00:00";
        $to = $request->input('to_date')." "."12:59:59";
        $account = $request->input('from_account');
        $id = Auth::user()->id;
        $users_tags = Tag::where('user_id', $id)->where('created_at', '>=', $from)->where('created_at', '<=', $to)->get();
        $accounts_data = Account::where('user_id', $id)->where('name',$account)->get();
        $accounts_name = Account::where('user_id', $id)->get();
        $tags_user_id = [];
        $heading = "The expeditures data is from ".$request->input('from_date')." to ".$request->input('to_date');
        $i = 0;
        foreach ($users_tags as $tag){
            $tags_user_id[$i] = $tag->id;
            $tags_user_name[$i] = $tag->name;
            $tags_expnd[$i] = $tag->expenditure;
            $i++;
        }
        //$users = Transaction::select('account_name')->where('account_id', $id)->get();
        //echo $users;
        return view('graphs', compact('tags_user_name','tags_expnd','accounts_data','accounts_name','heading'));
    }
    public function account_setting(){
        $id = Auth::user()->id;
        $accounts_data = Account::where('user_id', $id)->get();
        return view('account_setting', compact('accounts_data'));
    }
    public function UserLogin(Request $request){
        $validatedData = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        $username = $request->input('username');
        $password = $request->input('password');
        if(Auth::attempt(['username'=> $username, 'password'=> $password]))
        {
            $id = Auth::user()->id;
            $accounts_data = Account::where('user_id', $id)->get();
            $transaction_data = Transaction::where('account_id', $id)->get();
            $img_url = Storage::url(Auth::user()->photo);
            Session::put('img_url',$img_url);
            $user_alert = Alert::select('notification')->where('user_id',Auth::user()->id)->get();
            Session::put('user_alert',$user_alert);
            return view('/dashboard', compact('accounts_data', 'transaction_data'));
        }
        else{
          return back()->with('error','Something wrong happen');
        }
    }
}
