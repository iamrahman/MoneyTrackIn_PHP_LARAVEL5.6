@extends('layouts.header')
@section('content')
<?php
$duration = array("Null","1 Day","1 Week","1 month","1 year");
?>
<script>
var x = '<span class="glyphicon glyphicon-triangle-right"></span>';
var x1 = '<span class="glyphicon glyphicon-triangle-right"></span>';
var x2 = '<span class="glyphicon glyphicon-triangle-right"></span>';
var x3 = '<span class="glyphicon glyphicon-triangle-right"></span>';
function togDefault(){
  document.getElementById('l1').innerHTML = x;
  document.getElementById('l2').innerHTML = x1;
  document.getElementById('l3').innerHTML = x2;
  document.getElementById('l4').innerHTML = x3;
  document.getElementById('dd').click();
}
window.onload = togDefault;
function tog(){
  var y = '<span class="glyphicon glyphicon-triangle-right"></span>';
  var z = '<span class="glyphicon glyphicon-triangle-bottom"></span>';
    if (x == y) {
      document.getElementById('l1').innerHTML = z;
      x = '<span class="glyphicon glyphicon-triangle-bottom"></span>';
    }else{
      document.getElementById('l1').innerHTML = y;
      x = '<span class="glyphicon glyphicon-triangle-right"></span>';
    }
}
function tog1(){
  var y = '<span class="glyphicon glyphicon-triangle-right"></span>';
  var z = '<span class="glyphicon glyphicon-triangle-bottom"></span>';
    if (x1 == y) {
      document.getElementById('l2').innerHTML = z;
      x1 = '<span class="glyphicon glyphicon-triangle-bottom"></span>';
    }else{
      document.getElementById('l2').innerHTML = y;
      x1 = '<span class="glyphicon glyphicon-triangle-right"></span>';
    }
}
function tog2(){
  var y = '<span class="glyphicon glyphicon-triangle-right"></span>';
  var z = '<span class="glyphicon glyphicon-triangle-bottom"></span>';
    if (x2 == y) {
      document.getElementById('l3').innerHTML = z;
      x2 = '<span class="glyphicon glyphicon-triangle-bottom"></span>';
    }else{
      document.getElementById('l3').innerHTML = y;
      x2 = '<span class="glyphicon glyphicon-triangle-right"></span>';
    }
}
function tog3(){
  var y = '<span class="glyphicon glyphicon-triangle-right"></span>';
  var z = '<span class="glyphicon glyphicon-triangle-bottom"></span>';
    if (x3 == y) {
      document.getElementById('l4').innerHTML = z;
      x3 = '<span class="glyphicon glyphicon-triangle-bottom"></span>';
    }else{
      document.getElementById('l4').innerHTML = y;
      x3 = '<span class="glyphicon glyphicon-triangle-right"></span>';
    }
}
</script>
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
<div class="col-md-12 col-md-offset-0" style="height: auto;">
@if ($message = Session::get('success'))
    <p style="color:green"><span class="glyphicon glyphicon-ok"></span> {{ $message }}</p>
@endif
@if ($message = Session::get('error'))
    <p style="color:red"><span class='glyphicon glyphicon-remove'></span> {{ $message }}</p>
@endif

<div class="panel panel-default">
<div class="panel-heading" style="background-color:#660033;">
      <a data-toggle="collapse" href="#collapse1" onclick="tog()" id="dd" style="text-decoration: none;">
        <h4 class="panel-title" style="left:0;color:white;">
          <strong id="l1"></strong><strong> Active Accounts</strong></a>
        </h4>
      </div>
      </a>
<div id="collapse1" class="panel-collapse collapse">
<table class="table table-striped">
    <thead>
      <tr>
        <th>Account Name</th>
        <th>Balance</th>
        <th>Acitivity</th>
      </tr>
    </thead>
    <tbody>
    @foreach($account_name as $name)
    <tr>
    <td>{{ $name->name }}</td>
    <td>₹ {{ $name->current_balance }}</td>
    <td>
    <form action="/account_delete" method="POST">{{ csrf_field() }}
    <input type="text" name="id" value="{{ $name->id }}" hidden>
    <button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</button>
    </form>
    </td>
    </tr>
    @endforeach
    </tbody>
</table>
</div>

<div class="panel-heading" style="background-color:#660033;">
      <a data-toggle="collapse" href="#collapse3" onclick="tog1()" style="text-decoration: none;">
        <h4 class="panel-title" style="left:0; color:white;">
        <strong id="l2"></strong> <strong> Periodic Transaction</strong></a>
        </h4>
      </div>
      </a>
<div id="collapse3" class="panel-collapse collapse">
@if($periodic)
<table class="table table-striped">
    <thead>
      <tr>
        <th>Account Name</th>
        <th>Amount</th>
        <th>Span</th>
        <th> Created At</th>
        <th>Acitivity</th>
      </tr>
    </thead>
    <tbody>
    @foreach($periodic as $dd)
    <tr>
    <td>{{ $dd->account_name }}</td>
    <td>₹ {{ $dd->amount }}</td>
    <td>{{ $duration[$dd->duration] }}</td>
    <td>{{ $dd->created_at }}</td>
    <td>
    <form action="/periodic" method="POST">{{ csrf_field() }}
    <input type="text" name="id" value="{{ $dd->id }}" hidden>
    <button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</button>
    </form>
    </td>
    </tr>
    @endforeach
    </tbody>
</table>
@else
<br><p style="color:red">You don't have any periodic transaction</p>
@endif
</div>
<div class="panel-heading" style="background-color:#660033;">
      <a data-toggle="collapse" href="#collapse2" onclick="tog2()" style="text-decoration: none;">
        <h4 class="panel-title" style="left:0;color:white;">
          <strong id="l3"></strong><strong> Change the Password</strong></a>
        </h4>
      </div>
      </a>
<div id="collapse2" class="panel-collapse collapse">
<div class="panel-body" class="col-md-12">
      <form action="/change_password" method="POST">
      {{ csrf_field() }}
        <div class="form-group col-md-6 col-md-offset-3">
             <input type="password" class="form-control" placeholder="Enter Old Password" name="password">
        </div>
        <div class="form-group col-md-6 col-md-offset-3">
             <input type="password" class="form-control" placeholder="Enter New Password" name="npassword">
        </div>
        <div class="form-group col-md-6 col-md-offset-3">
             <input type="password" class="form-control" placeholder="Enter Retype New Password" name="rnpassword">
        </div>
        <div class="form-group col-md-6 col-md-offset-3">
        <button class="btn btn-success">Change Password</button>
        </div>
      </form>
      </div>
</div>
<div class="panel-heading" style="background-color:#660033;">
      <a data-toggle="collapse" href="#collapse4" onclick="tog3()" style="text-decoration: none;">
        <h4 class="panel-title" style="left:0;color:white;">
          <strong id="l4"></strong><strong> Delete Account</strong></a>
        </h4>
      </div>
      </a>
<div id="collapse4" class="panel-collapse collapse">
<div class="panel-body" class="col-md-12">
      <form action="#" method="POST">
      {{ csrf_field() }}
        <div class="form-group col-md-12 col-md-offset-0">
             <p style="font-size:20px;">Do you want to delete the account?</p>
        </div>
        <div class="form-group col-md-3 col-md-offset-0">
        <button class="btn btn-danger">Yes</button>
        </div>
        </form>
        <div class="form-group col-md-3 col-md-offset-0">
        <a data-toggle="collapse" href="#collapse4"><button class="btn btn-success">No</button></a>
        </div>
      </div>
</div>

</div>
</div>
</div>@endsection