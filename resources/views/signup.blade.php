@extends('layouts.header')
@section('content')
<style>
    #btnhov:hover {
    background-color: yellow;
    }
</style>
<div class="col-md-8 col-md-offset-2" style="background-color:wheat; margin-top:50px; height: auto; box-shadow: 2px 2px 5px #660033;">
    <br><br><center><img src="img/signup.png" style="width:auto;"><br><legend style="color:#660033;"><strong>Signup Form</strong></legend></center>
<center>
@if ($message = Session::get('success'))
    <p style="color:green"><span class="glyphicon glyphicon-ok"></span> {{ $message }} <a href="/"> Login Page </a></p>
@endif
@if ($message = Session::get('error'))
    <p style="color:red">{{ $message }}</p>
@endif
</center>
    <form action="/users" method="POST">
    {{ csrf_field() }}
        <div class="form-group col-md-6">
            <label for="email">Username</label>
            <input type="text" class="form-control" name="username" placeholder="Enter your Username">
        </div>
        <div class="form-group col-md-6">
            <label for="email">Email Address</label>
            <input type="name" class="form-control" name="email" placeholder="Enter your Username">
        </div>
        <div class="form-group col-md-6">
            <label for="email">Password</label>
            <input type="password" class="form-control" name=password placeholder="Enter your Password">
        </div>
        <div class="form-group col-md-6">
            <label for="email">Confirm Password</label>
            <input type="password" class="form-control" name="cpassword" placeholder="Enter Confirm Password">
        </div>
        <div class="form-group col-md-4">
            <label for="email">Date of Birth</label>
            <input type="date" class="form-control" name="dob" placeholder="Enter your Username">
        </div>
        <div class="form-group col-md-4">
            <label for="email">Country</label>
            <select class="form-control" name="country">
                <option>Select</option>
                <?php for($i=0;$i<sizeof($countries);$i++){  ?>
                <option value="<?php echo $i ?>"><?php echo $countries[$i] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="email">Matrital Status</label>
            <select class="form-control" name="maritial_status">
                <option value="">Select</option>
                <option value="0">Single</option>
                <option value="1">Maried</option>
                <option value="2">In Realationship</option>
            </select>
        </div>
        <div class="form-group col-md-3">
        <label for="email">Gender</label><br>
            <label class="radio-inline"><input type="radio" name="gender" value="0">Male</label>
            <label class="radio-inline"><input type="radio" name="gender" value="1">Female</label>
        </div>
        <div class="form-group col-md-3">
            <label for="email">Language</label>
            <select class="form-control" name="lang">
                <option value="0">Select</option>
                <option value="1">Arabic</option>
                <option value="2">English</option>
                <option value="3">Chinese</option>
                <option value="4">Japanese</option>
                <option value="5">Spanish</option>
            </select>
        </div>
        <div class="form-group col-md-3">
            <label for="email">Employee</label>
            <select class="form-control" name="employee">
                <option value="0">Select</option>
                <option value="1">Student</option>
                <option value="2">Full Time Job</option>
                <option value="3">Part Time Job</option>
                <option value="4">Self Employed</option>
            </select>
        </div>
        <div class="form-group col-md-3">
            <label for="email">Currency</label>
            <select class="form-control" name="currency">
                <option value="0">Select</option>
                <?php for($i=0;$i<sizeof($currency);$i++){  ?>
                <option value="<?php echo $i ?>"><?php echo $currency[$i] ?></option>
                <?php } ?>
            </select>
        </div>
        <br><br>
        <p><input type="checkbox" name="optradio"> Check to accept and consent the moneytrackin' Terms of Use and Privacy Policy</p>
        <center><br>
        <button class="btn" id="btnhov" style=" width: 30%;background-color:#660033;color: #F0E68C">Sign up</button><br><br>
    </center>
    </form>
</div>
@endsection