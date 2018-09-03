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
<div class="col-md-8 col-md-offset-2" style="background-color: white;box-shadow:1px 1px 5px black; height: auto;">
<center>
<img src="https://cdn3.iconfinder.com/data/icons/office-24/100/Icon_FastSetting2-512.png" style="width:12%;">
<h4>Periodic Transaction</h4>
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
<form action="/periodicTransaction" method="POST">
    {{ csrf_field() }}
  <div class="form-group col-md-8 col-md-offset-2">
    <label for="account">Select Account</label>
    <select class="form-control" name="account">
    <option>Select</option>
    @foreach($accounts_data as $user)
        <option value="{{ $user->name}}">{{ $user->name }}</option>
    @endforeach
    </select>
  </div><br>
  <div class="form-group col-md-8 col-md-offset-2">
    <label for="account">Time Span: </label>
    <select class="form-control" name="time_span">
    <option value="">Select</option>
    <option value="1">1 Day</option>
    <option value="2">1 Week</option>
    <option value="3">1 months</option>
    <option value="4">6 months</option>
    <option value="5">1 Years</option>
    </select>
  </div><br>
  <div class="form-group col-md-8 col-md-offset-2">
    <label id="aid">Amount</label>
    <input type="number" class="form-control" name="amount" placeholder="Enter Amount">
  </div>
  <div class="form-group col-md-8 col-md-offset-2">
    <label id="tid">Description</label>
    <textarea type="text" id="did" class="form-control" name="description" placeholder="Enter description" required></textarea>
  </div>
  <div class="form-group col-md-8 col-md-offset-2">
    <label id="tid">Tags</label>
    <input type="text" id="textid" pattern="[a-z]+([,]+[a-z]+([a-z])?)*" class="form-control" name="tags" title="Seprate the tags with comma and lowercase only.Eg. health,vehicle" placeholder="Enter tags in lower case only using comma. Eg. food,health,vehicle" required>
  </div>
  <center>
  <div class="form-group col-md-8 col-md-offset-5">
  <button type="submit" style="float:left; width:30%;" class="btn btn-success">Submit</button>
  </div>
  </center>
</form>
<br><br>

</div>

</div>
</div>@endsection