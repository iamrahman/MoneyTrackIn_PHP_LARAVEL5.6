@extends('layouts.header')
@section('content')
<style>
#content   
{
    background-size: 100%;
    background-repeat: no-repeat;
    height:auto;   
}  
@keyframes slideInFromLeft {
  0% {
    transform: translateY(50%);
  }
  100% {
    transform: translateX(0);
  }
}
#font1{
    font-size:2vw;
    font-style:italic;
    padding:5%;
    animation: 1s ease-out 0s 1 slideInFromLeft;
}

</style>
<script>

</script>
<div class="container" style="margin-top:50px;">
<div class="col-12">
<div class="col-md-8" id="content" style="background-color:#ffffff;">
<img src="img/banner.png" style="width:100%; height:auto;">
</div>
<div class="col-md-4" style="background-color:#ffffff; height:auto; margin-left:-10px; padding-left:2%; padding-right:2%;">
<br><center>
<img src="https://cdn2.iconfinder.com/data/icons/rcons-user/32/male-fill-circle-512.png" style="width:100px;">
<legend>User Login</legend></center>
    <form action="/userlogin" method="POST">
    {{ csrf_field() }}
        <div class="form-group">
            <input type="text" class="form-control" name="username" placeholder="Enter Username">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Enter your Password">
        </div>
           <a href="/forget_password">Forget Password</a>
          <center>
             @if ($message = Session::get('error'))
             <p style="color:red">{{ $message }}</p>
             @endif
          </center>
        <div class="forgot">
        </div>
        <center>
        <button type="submit" class="btn" style="background-color:#660033;color: #F0E68C;"> &nbsp;&nbsp;&nbsp;&nbsp;Login&nbsp;&nbsp; &nbsp;&nbsp;</button>
        </center>
    </form><br>
</div>
<div class="col-md-12">
<center><p id="font1">" Money Tracker is a financial management tool within NAB Internet Banking which 
provides a visual representation of spending behaviour using information from your transaction history. 
It also allows you to set up a budget or savings goal and track your income and expenses. "</p>
<br></center>
</div>
<div class="col-md-12" style="background-color:#f1f1f1; heigh:auto;">

</div>
@endsection