<div style="margin-top:50px; background-color:#660033; position:relative; overflow:auto;">
<div class="col-md-3" style="background-color:#660033; height: auto;">
<div id="img">
<img src="<?php echo Session::get('img_url');?>" class="img-circle img-responsive" width="304" height="236">
</div>
<center>
<h3><img src="https://www.clker.com/cliparts/r/G/F/d/x/C/glossy-lime-green-icon-button.svg" style="width:12px;"> {{ Auth::user()->username }}</h3>
<a href="/edit_profile"><button class="btn btn-danger"><span class="glyphicon glyphicon-wrench"></span> Edit Profile</button></a>
<ul><br>
<a href="/profile"><li><button id="snav" class="btn btn-primary"><span class="glyphicon glyphicon-user"></span> User Profile</button></li></a>
<a href="/create_account"><li><button id="snav" class="btn btn-primary"><img src="img/bank.png" style="width:20px; color:white;"> Open Account</button></li></a>
<a href="/with_in_account"><li><button id="snav" class="btn btn-primary"><span class="glyphicon glyphicon-credit-card"></span> Debit or Credit</button></li></a>
<a href="/graphs_data"><li><button id="snav" class="btn btn-primary"><span class="glyphicon glyphicon-stats"></span> Graphical Data </button></li></a>
<a href="/history"><li><button id="snav" class="btn btn-primary"><span class="glyphicon glyphicon-list-alt"></span> Transaction History</button></li></a>
<a href="/account_account_transfer"><li><button id="snav" class="btn btn-primary"><span class="glyphicon glyphicon-transfer"></span> Account to Account </button></li></a>
<a href="/periodic_transaction"><li><button id="snav" class="btn btn-primary"><span class="glyphicon glyphicon-time"></span> Periodic Transaction </button></li></a>
<a href="/account_setting"><li><button id="snav" class="btn btn-primary"><span class="glyphicon glyphicon-cog"></span> Account Setting </button></li></a>
<ul>
</center>
</div>