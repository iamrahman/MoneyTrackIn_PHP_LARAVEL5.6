@extends('layouts.header')
@section('content')
<script>
window.onload = function() {
  <?php
  $ptotal = 0;
  $i = 0;
  $per = [];
  $act_name = [];
  foreach($accounts_data as $user){
    $ptotal = $ptotal+$user['current_balance'];
  }
  foreach($accounts_data as $user){
    $per[$i] = ($user['current_balance']/$ptotal)*100;
    $act_name[$i] = $user['name'];
    $i++;
  }
  $len = sizeof($act_name);
  ?>
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title: {
		text: "Account's Share"
	},
	data: [{
		type: "pie",
		startAngle: 180,
		yValueFormatString: "##0.00\"%\"",
		indexLabel: "{label} {y}",
		dataPoints: [
    <?php for($j=0;$j<$len;$j++) {?>
			{y: <?php echo $per[$j] ?>, label: "<?php echo $act_name[$j] ?>"},
    <?php } ?>
		]
	}]
});
chart.render();

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
</style>
@extends('layouts.side')
<!-- #######################   Profile Division      #################### -->
<div class="col-md-9" style="background-color: white; height: auto; min-height:105vh;">
<br>
<center>
<div class="col-md-12" style="width:100%;">      
<table class="table table-striped">
    <thead style="background-color:#660033;">
      <tr style="color: white;">
        <th>Account Name</th>
        <th>Balance</th>
      </tr>
    </thead>
    <tbody>
    <?php $total =0;
    foreach ($accounts_data as $user)
    {
      $total= $total+$user['current_balance'];
    }
    ?>
    @foreach($accounts_data as $user)
      <tr>
        <td>{{ $user->name }}</td>
        <td>₹ {{ $user->current_balance }} </td>
      </tr>
    @endforeach
      <tr>
      <th>Total</th>
      <th>
      <?php echo "₹ ".$total;?>
      </th>
      </tr>
    </tbody>
  </table>
</div>
</center>
<?php if($len == 0){ ?>
<center>
<img src="img/welcome.png" style="width:30%;"><br>
<a href="/create_account"><p style="color:black; font-size:20px;">You do not have any Account. Please click here to create Account</p></a>
</center>
<?php } else{?>
<div class="col-md-12" id="chartContainer" style="height: 300px; width: 100%;"></div>
<div id="chartContainer" style="height: 300px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<?php } ?>
</div>
</div>
@endsection