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
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer1", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "light1", // "light1", "light2", "dark1", "dark2"
	title:{
		text:" {{ $heading }} "
	},
	data: [{
		type: "column", //change type to bar, line, area, pie, etc
		//indexLabel: "{y}", //Shows y value on all Data Points
		indexLabelFontColor: "#5A5757",
		indexLabelPlacement: "outside",
		dataPoints: [
			<?php 
			$set = isset($tags_user_name);
			if(! $set){
				$tags_user_name =null;
			}
			else{	
			for($i=0; $i<sizeof($tags_user_name); $i++){ ?>
			{ x: <?php echo $i*10 ?>, y: <?php echo $tags_expnd[$i]; ?>, indexLabel: "<?php echo $tags_user_name[$i]; ?>" },
	        <?php } } ?>
		]
	}]
});
chart.render();

}
</script>
@extends('layouts.side')
<!-- #######################   Profile Division      #################### -->
<div class="col-md-9" style="background-color: white; height: 96vh;">
<br><br>
<form action="/graph_filter" method="POST">
{{ csrf_field() }}
	<div class="form-group col-md-4">
    <label for="date">From:</label>
    <input type="date" class="form-control" name="from_date">
	</div>
	<div class="form-group col-md-4">
    <label for="date">To:</label>
    <input type="date" class="form-control" name="to_date">
	</div>
	<div class="form-group col-md-4">
    <label for="account">Account Name:</label>
	<select class="form-control" name="from_account">
    <option value="null">All Accounts</option>
    @foreach($accounts_name as $user)
        <option value="{{ $user->name}}">{{ $user->name }}</option>
    @endforeach
    </select>
	</div>
	<center> <button type="submit" class="btn" style="background-color:#660033;color: white;"> &nbsp;&nbsp; Show &nbsp;&nbsp;</button></center><br>
</form>
<?php if($set){?>
<br><br>
<div id="chartContainer1" style="height: 300px; width: 100%; float:left;"></div>
<?php } else{ ?>
	<center>
	<br><br><br>
	<img src="img/sorry.jpg" style="width:30%;"><br>
	<p style="color:black; font-size:20px;">No Records Founds <a href="/graphs_data">Click to go back</a></p>
	</center>
<?php } ?>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</center>
</div>
</div>
</div>@endsection