@extends('layouts.header')
@section('content')


<style>
h3{
    color:white;
}
ul li{
    list-style:none;
}
#snav{
    width:100%;
    margin-left:-40px;
    margin-bottom:2px;
}

</style>
@extends('layouts.side')
<!-- #######################   Profile Division      #################### -->
<div class="col-md-9" style="background-color: white; height: auto; min-height:105vh;">
<br>
<div class="col-md-8 col-md-offset-2" style="background-color: white;box-shadow:1px 1px 5px black; height: 90vh;">
<center>
<img src="https://cdn2.iconfinder.com/data/icons/webstore/512/dollar_money_bag-512.png" style="width:15%;">
<h4>Account to Account Transfer</h4>
<center>
@if ($message = Session::get('success'))
    <p style="color:green"><span class="glyphicon glyphicon-ok"></span> {{ $message }}</p>
    <script> myFun();</script>
@endif
@if ($message = Session::get('error'))
    <p style="color:red"><span class="glyphicon glyphicon-remove"></span> {{ $message }}</p>
@endif
</center>
<hr>
</center>
<form action="{{ route('accounts.update', Auth::user()->id) }}" method="POST">
{{ method_field('PUT') }}
    {{ csrf_field() }}
  <div class="form-group col-md-8 col-md-offset-2">
    <label for="account">From Account</label>
    <select class="form-control" name="from_account">
    <option>Select</option>
    @foreach($accounts_data as $user)
        <option value="{{ $user->name}}">{{ $user->name }}</option>
    @endforeach
    </select>
  </div><br>
  <div class="form-group col-md-8 col-md-offset-2">
    <label for="account">To Account</label>
    <select class="form-control" name="to_account">
    <option>Select</option>
    @foreach($accounts_data as $user)
        <option value="{{ $user->name}}">{{ $user->name }}</option>
    @endforeach
    </select>
  </div><br>
  <div class="form-group col-md-8 col-md-offset-2">
    <label for="pwd">Transfer Amount</label>
    <input type="number" class="form-control" name="amount_transfer" placeholder="Enter Amount to be Transfer">
  </div>
  <div class="form-group col-md-8 col-md-offset-2">
    <label for="pwd">Description</label>
    <textarea type="text" class="form-control" name="description" placeholder="Enter Description"></textarea>
  </div>
  <center>
  <div class="form-group col-md-8 col-md-offset-5">
  <button type="submit" style="float:left;" class="btn btn-success">Submit</button>
  </center>
  </div>
</form>
</div>
</div>
</div>@endsection