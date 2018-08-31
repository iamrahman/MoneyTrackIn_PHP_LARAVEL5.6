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
function myFun()
{
    var data = document.getElementById('sid').value;
    if(data == 1)
    {
        document.getElementById('aid').innerHTML="Enter Credit Amount";
        document.getElementById("textid").disabled = true; 
    }
    else{
        document.getElementById('aid').innerHTML="Enter Debit Amount";
        document.getElementById("textid").disabled = false; 
    }
}
</script>
@extends('layouts.side')
<!-- #######################   Profile Division      #################### -->
<div class="col-md-9" style="background-color: white; height: 96vh;">
<br>
<div class="col-md-8 col-md-offset-2" style="background-color: white;box-shadow:1px 1px 5px black; height: auto;">
<center>
<img src="https://cdn3.iconfinder.com/data/icons/e-commerce-trading/512/transaction_A-512.png" style="width:12%;">
<h4>Debit or Credit</h4>
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
    <label for="account">Transaction Type: </label>
    <select class="form-control" name="trans_type" id="sid" onchange="myFun()">
    <option value="null">Select</option>
    <option value="0">Debit</option>
    <option value="1">Credit</option>
    </select>
  </div><br>
  <div class="form-group col-md-8 col-md-offset-2">
    <label for="account">Select Account</label>
    <select class="form-control" name="to_account">
    <option>Select</option>
    @foreach($accounts_data as $user)
        <option value="{{ $user->name}}">{{ $user->name }}</option>
    @endforeach
    </select>
  </div><br>
  <div class="form-group col-md-8 col-md-offset-2">
    <label id="aid">Amount</label>
    <input type="number" class="form-control" name="amount_transfer" placeholder="Enter Amount">
  </div>
  <div class="form-group col-md-8 col-md-offset-2">
    <label id="tid">Description</label>
    <textarea type="text" id="did" class="form-control" name="description" placeholder="Enter description" required></textarea>
  </div>
  <div class="form-group col-md-8 col-md-offset-2">
    <label id="tid">Tags</label>
    <input type="text" id="textid" pattern="[a-z]+([,]+[a-z]+([a-z])?)*" class="form-control" name="tags" title="Seprate the tags with comma and lowercase only.Eg. health,vehicle" placeholder="Enter tags in lower case only using comma. Eg. food,health,vehicle" required>
  </div>
  <div class="form-group col-md-8 col-md-offset-2">Most Used Tags<br>
  <?php for($i=0;$i< sizeof($tags_top);$i++){?>
  <span class="label label-default" style="float:left; margin-left:2px;"> # <?php echo $tags_top[$i]; ?> </span>
  <?php } ?>
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