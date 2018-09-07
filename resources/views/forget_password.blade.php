@extends('layouts.header')
@section('content')
<div class="container col-md col-md-4 col-md-offset-4" style="margin-top:30vh;">
<legend>Forget Password</legend>
    <form action="/forgetpassword" method="POST">
    {{ csrf_field() }}
        <div class="form-group">
        <center>
        @if (isset($error))
    <p style="color:red;">{{ $error }}</p>
@endif
             @if (isset($success))
    <p style="color:green;"><span class="glyphicon glyphicon-ok"></span> {{ $success }}</p>
@endif
        </center>
        <label>Enter your E-mail Address</label>
            <input type="text" class="form-control" name="email" placeholder="Enter Email Address"><br>
            @captcha<button type="submit" class="btn" style="background-color:#660033;color: #F0E68C;" onClick="window.location.reload()">
            <span id="l1" class="glyphicon glyphicon-refresh"></span></button>
            <input type="text" name="captcha" placeholder="Enter Captcha">
        </div>
        <center>
        <button type="submit" class="btn" style="background-color:#660033;color: #F0E68C;"> &nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-send"></span>&nbsp;Send&nbsp;&nbsp; &nbsp;&nbsp;</button>
        </center>
    </form><br>
</div>
@endsection