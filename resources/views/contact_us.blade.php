@extends('layouts.header')
@section('content')
<style>
hr {border-top: 1px solid #000; width:50%;}

a {color: #000;}

a:link{text-decoration:none;}
    
}
#add{
    background-color:#660033;
}
</style>
<div class="container col-md col-md-12" style="margin-top:5vh;">
<div class="container-fluid">
<h1 class="text-center">Contact Address</h1>
<hr>
 <div class="row">
  <iframe src="https://maps.google.com/maps?width=100%&amp;height=300&amp;hl=en&amp;q=Luminoguru%20mohali+(Luminoguru)&amp;ie=UTF8&amp;t=&amp;z=14&amp;iwloc=A&amp;output=embed" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
 </div>
	  <div class="col-md-4" id="add">
        <a href="tel:+123456789">
        <h3>Phone</h3>
        <p>+91-7696342418</p></a>
      </div>
      <div class="col-md-4">
        <a href="">
        <h3>Address</h3>
        <p>Plot # E304 ,3rd Floor , Industrial Area Phase 8A, Sector 75, Sahibzada Ajit Singh Nagar, Punjab 160071</p></a>
      </div>
      <div class="col-md-4">
        <a href="mailto:test@test.com">
        <h3>E-mail</h3>
        <p>inamur.luminoguru@gmail.com</p></a>
      </div>
</div>
<div class="row text-center bg-success text-white" id="author">
  <div class="col-md-12">
  <a href="#">by Inamur Rahman</a>
</div>
</div>
    
</div>
@endsection