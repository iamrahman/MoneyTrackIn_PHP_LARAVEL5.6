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
<script>
function myFun(){
    $(document).ready(function () {
    window.setTimeout(function () {
        location.href = "/dashboard";
    }, 3000);
});
}
</script>
@extends('layouts.side')
<!-- #######################   Open Account     #################### -->
<div class="col-md-9" style="background-color: white; height: 100vh;"><br><br>
<div class="col-md-8 col-md-offset-2" style="background-color: white;box-shadow:1px 1px 5px black; height: auto;">
<center>
<img src="https://cdn2.iconfinder.com/data/icons/eco-business/512/bank-512.png" style="width:15%;">
<h4>Open Account</h4>
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
<form action="/accounts" method="POST">
{{ csrf_field() }}
  <div class="form-group col-md-8 col-md-offset-2">
    <label for="account">Account Name:</label>
    <input type="text" class="form-control" name="account_name" placeholder="Enter Account Name">
  </div><br>
  <div class="form-group col-md-8 col-md-offset-2">
    <label for="pwd">Initial Balance:</label>
    <input type="number" class="form-control" name="initial_balance" placeholder="Enter Initial Balance">
  </div>
  <center>
  <div class="form-group col-md-8 col-md-offset-5">
  <button type="submit"  style="float:left;" class="btn btn-success"> Open </button>
  </div>
  </center>
  
</form>
<br><br>
</div>
</div>
</div>
@endsection