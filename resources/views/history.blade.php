@extends('layouts.header')
@section('content')
<?php
$type = array("Credit", "Debit");
?>
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
#dmenu{
  width:30%;
  height: 40px;
}
#dmenu:hover{
  box-shadow: 2px 2px 2px black;
}
table th {
    width: auto !important;
}
td {
  font-size: 12px;
}
</style>
@extends('layouts.side')
<!-- #######################   Profile Division      #################### -->
<div class="col-md-9" style="background-color: white; height: auto; min-height:105vh;">
<br>
<center>
<div class="col-md-12 table-responsive" style="width:100%;">      
<table class="table responsive table-striped">
    <thead style="background-color:#660033;">
      <tr style="color: white;">
        <th>Transaction History</th>
        <th></th><th></th><th></th><th></th><th></th><th></th>
      </tr>
    </thead>
    <tr>
        <th>Date & Time</th>
        <th>Transaction ID</th>
        <th>Account Name</th>
        <th>Amount</th>
        <th>Type</th>
        <th>Description</th>
      </tr>
    <tbody>
    <?php $total =0;
    foreach ($accounts_data as $user)
    {
      $total= $total+$user['current_balance'];
    }
    ?>
    @foreach($transaction_data as $user)
      <tr>
        <td>{{ $user->date }}</td>
        <td>TRAN00{{ $user->id }}</td>
        <td>{{ $user->account_name }}</td>
        <td>$ {{ $user->amount }}</td>
        @if($type[$user->type]=="Debit")
        <td style="color:red;">{{ $type[$user->type] }}</td>
        @else
        <td style="color:darkgreen;">{{ $type[$user->type] }}</td>
        @endif
        <td>{{ $user->description }}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>
{{ $transaction_data->links() }}
</center>
</div>
</div>
@endsection