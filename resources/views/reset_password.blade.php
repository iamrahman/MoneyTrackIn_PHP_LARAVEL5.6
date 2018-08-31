<script>

</script>
@extends('layouts.header')
@section('content')
<div class="container col-md col-md-4 col-md-offset-4" style="margin-top:25vh;">
<legend>Reset Password</legend>
<center>
@if (isset($success))
    <p style="color:green"><span class="glyphicon glyphicon-ok"></span> {{ $success }}</p>
@endif
@if (isset($error))
    <p style="color:red"></span> {{ $error }}</p>
@endif
</center>
    <form action="/resetpassword" method="POST">
    {{ csrf_field() }}
        <div class="form-group">
        <label>Enter OTP</label>
            <input type="number" class="form-control" name="otp" placeholder="Enter OTP">
        </div>
        <div class="form-group">
        <label>Enter New Password</label>
            <input type="password" class="form-control" name="password" placeholder="Enter Password">
        </div>
        <div class="form-group">
        <label>Retype your Password</label>
            <input type="password" class="form-control" name="cpassword" placeholder="Enter Confirm Password">
        </div>
        <center>
        <button type="submit" class="btn" style="background-color:#660033;color: #F0E68C;"> &nbsp;&nbsp;&nbsp;&nbsp;Submit&nbsp;&nbsp; &nbsp;&nbsp;</button>
        </center>
    </form><br>
</div>
@endsection