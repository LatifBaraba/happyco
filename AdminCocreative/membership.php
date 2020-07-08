<?php

session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

require 'function.php';

$a = query("SELECT * FROM memberprice");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CoCreative - Dashboard</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<link rel="icon" href="asset/img/FAVICON-PUTIH..png">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
				<a class="navbar-brand" href="#"><span>Co</span>Creative</a>
			</div>
		</div><!-- /.container-fluid -->
	</nav>
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="divider"></div>
		<!-- <form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			</div>
		</form> -->
		<ul class="nav menu">
		<li><a href="index.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
			<li><a href="logo.php"><em class="fas fa-spa">&nbsp;</em> Logo</a></li>
			<li><a href="slider.php"><em class="fas fa-images">&nbsp;</em> Slider screen</a></li>
			<li><a href="aboutus.php"><em class="fas fa-newspaper-o">&nbsp;</em> About Us</a></li>
			<li><a href="ourproduct.php"><em class="fas fa-plus-circle">&nbsp;</em> Our Product</a></li>
			<li><a href="oncocreative.php"><em class="fas fa-plus-square">&nbsp;</em> On CoCreative</a></li>
			<li><a href="partners.php"><em class="fas fa-handshake">&nbsp;</em> Partners & Clients</a></li>
			<li><a href="event.php"><em class="fas fa-calendar-alt">&nbsp;</em> Event</a></li>
			<li><a href="gallery.php"><em class="fas fa-photo-video">&nbsp;</em> Gallery</a></li>
			<li class="active"><a href="membership.php"><em class="fas fa-user-check">&nbsp;</em> Membership & Price</a></li>
			<li><a href="social.php"><em class="fas fa-comment">&nbsp;</em> Social Media & Contact</a></li>
			<li><a href="booking.php"><em class="fas fa-bookmark">&nbsp;</em> Booking</a></li>
			<!-- <li class="parent "><a data-toggle="collapse" href="#sub-item-1">
				<em class="fa fa-navicon">&nbsp;</em> Multilevel <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li><a class="" href="#">
						<span class="fa fa-arrow-right">&nbsp;</span> Sub Item 1
					</a></li>
					<li><a class="" href="#">
						<span class="fa fa-arrow-right">&nbsp;</span> Sub Item 2
					</a></li>
					<li><a class="" href="#">
						<span class="fa fa-arrow-right">&nbsp;</span> Sub Item 3
					</a></li>
				</ul>
			</li> -->
			<?php if(!isset($_SESSION['login']))
			echo "<li><a href='login.php'><em class='fa fa-power-off'>&nbsp;</em> Logout</a></li>"; ?>
			
			
			<?php if(isset($_SESSION['login']))
			echo "<li><a href='logout.php'><em class='fa fa-power-off'>&nbsp;</em> Logout</a></li>"; ?>
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Membership & Price</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Membership & Price</h1>
			</div>
		</div><!--/.row-->
		
		<div class="panel panel-container">
			<div class="row">
				<div class="col-md-12">
					<div class="col-md-6">
					<table class="table table-striped table-user w-auto" id="table3">
						<thead class="thead-user">
							<tr>
								<th>Membership & Price </th>
							</tr>
						</thead>
							
								<tr>    <td><?php echo $a[0]['judul'];?></td>     </tr>
								<tr>    <td><?php echo rupiah($a[0]['hargalama']);?></td>     </tr>
								<tr>    <td><?php echo rupiah($a[0]['harga']);?></td>     </tr>
								<tr>    <td><?php echo $a[0]['diskon'];?></td>     </tr>
								<tr>    <td><?php echo $a[0]['fitur1'];?></td>     </tr>
								<tr>    <td><?php echo $a[0]['fitur2'];?></td>     </tr>
								<tr>    <td><?php echo $a[0]['fitur3'];?></td>     </tr>
								<tr>    <td><?php echo $a[0]['fitur4'];?></td>     </tr>
								<tr>    <td><?php echo $a[0]['fitur5'];?></td>     </tr>
								<tr>    <td><?php echo $a[0]['fitur6'];?></td>     </tr>
								<tr>    <td><?php echo $a[0]['fitur7'];?></td>     </tr>
								<tr>    <td><?php echo $a[0]['fitur8'];?></td>     </tr>
								<tr>    <td><?php echo $a[0]['fitur9'];?></td>     </tr>
								<tr>    <td><?php echo $a[0]['fitur10'];?></td>     </tr>
								
					</table>
							<button class="btn btn-info" onclick="location.href='edit-membership.php?id=<?php echo $a[0]['id'];?>'"><i class="fa fa-edit"></i> edit</button>
					</div>
					<div class="col-md-6">
					<table class="table table-striped table-user w-auto" id="table3">
						<thead class="thead-user">
							<tr>
								<th>Membership & Price </th>
							</tr>
						</thead>
							
								<tr>    <td><?php echo $a[1]['judul'];?></td>     </tr>
								<tr>    <td><?php echo rupiah($a[1]['hargalama']);?></td>     </tr>
								<tr>    <td><?php echo rupiah($a[1]['harga']);?></td>     </tr>
								<tr>    <td><?php echo $a[1]['diskon'];?></td>     </tr>
								<tr>    <td><?php echo $a[1]['fitur1'];?></td>     </tr>
								<tr>    <td><?php echo $a[1]['fitur2'];?></td>     </tr>
								<tr>    <td><?php echo $a[1]['fitur3'];?></td>     </tr>
								<tr>    <td><?php echo $a[1]['fitur4'];?></td>     </tr>
								<tr>    <td><?php echo $a[1]['fitur5'];?></td>     </tr>
								<tr>    <td><?php echo $a[1]['fitur6'];?></td>     </tr>
								<tr>    <td><?php echo $a[1]['fitur7'];?></td>     </tr>
								<tr>    <td><?php echo $a[1]['fitur8'];?></td>     </tr>
								<tr>    <td><?php echo $a[1]['fitur9'];?></td>     </tr>
								<tr>    <td><?php echo $a[1]['fitur10'];?></td>     </tr>
								
					</table>
							<tr><button class="btn btn-info" onclick="location.href='edit-membership.php?id=<?php echo $a[1]['id'];?>'"><i class="fa fa-edit"></i> edit</button></tr>
					</div>
				</div>
			</div><!--/.row-->
			<div class="row">
				<div class="col-md-12">
				<div class="col-md-6">
					<table class="table table-striped table-user w-auto" id="table3">
						<thead class="thead-user">
							<tr>
								<th>Membership & Price </th>
							</tr>
						</thead>
							
								<tr>    <td><?php echo $a[2]['judul'];?></td>     </tr>
								<tr>    <td><?php echo rupiah($a[2]['hargalama']);?></td>     </tr>
								<tr>    <td><?php echo rupiah($a[2]['harga']);?></td>     </tr>
								<tr>    <td><?php echo $a[2]['diskon'];?></td>     </tr>
								<tr>    <td><?php echo $a[2]['fitur1'];?></td>     </tr>
								<tr>    <td><?php echo $a[2]['fitur2'];?></td>     </tr>
								<tr>    <td><?php echo $a[2]['fitur3'];?></td>     </tr>
								<tr>    <td><?php echo $a[2]['fitur4'];?></td>     </tr>
								<tr>    <td><?php echo $a[2]['fitur5'];?></td>     </tr>
								<tr>    <td><?php echo $a[2]['fitur6'];?></td>     </tr>
								<tr>    <td><?php echo $a[2]['fitur7'];?></td>     </tr>
								<tr>    <td><?php echo $a[2]['fitur8'];?></td>     </tr>
								<tr>    <td><?php echo $a[2]['fitur9'];?></td>     </tr>
								<tr>    <td><?php echo $a[2]['fitur10'];?></td>     </tr>
								
					</table>
							<tr><button class="btn btn-info" onclick="location.href='edit-membership.php?id=<?php echo $a[2]['id'];?>'"><i class="fa fa-edit"></i> edit</button></tr>
					</div>

					<div class="col-md-6">
					<table class="table table-striped table-user w-auto" id="table3">
						<thead class="thead-user">
							<tr>
								<th>Membership & Price </th>
							</tr>
						</thead>
							
								<tr>    <td><?php echo $a[3]['judul'];?></td>     </tr>
								<tr>    <td><?php echo rupiah($a[3]['hargalama']);?></td>     </tr>
								<tr>    <td><?php echo rupiah($a[3]['harga']);?></td>     </tr>
								<tr>    <td><?php echo $a[3]['diskon'];?></td>     </tr>
								<tr>    <td><?php echo $a[3]['fitur1'];?></td>     </tr>
								<tr>    <td><?php echo $a[3]['fitur2'];?></td>     </tr>
								<tr>    <td><?php echo $a[3]['fitur3'];?></td>     </tr>
								<tr>    <td><?php echo $a[3]['fitur4'];?></td>     </tr>
								<tr>    <td><?php echo $a[3]['fitur5'];?></td>     </tr>
								<tr>    <td><?php echo $a[3]['fitur6'];?></td>     </tr>
								<tr>    <td><?php echo $a[3]['fitur7'];?></td>     </tr>
								<tr>    <td><?php echo $a[3]['fitur8'];?></td>     </tr>
								<tr>    <td><?php echo $a[3]['fitur9'];?></td>     </tr>
								<tr>    <td><?php echo $a[3]['fitur10'];?></td>     </tr>
								
					</table>
							<tr><button class="btn btn-info" onclick="location.href='edit-membership.php?id=<?php echo $a[3]['id'];?>'"><i class="fa fa-edit"></i> edit</button></tr>
					</div>
				</div>
			</div>
		</div>

	</div>	<!--/.main-->
	
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	<script src="https://kit.fontawesome.com/07e3006cb6.js" crossorigin="anonymous"></script>
	<script>
		window.onload = function () {
	var chart1 = document.getElementById("line-chart").getContext("2d");
	window.myLine = new Chart(chart1).Line(lineChartData, {
	responsive: true,
	scaleLineColor: "rgba(0,0,0,.2)",
	scaleGridLineColor: "rgba(0,0,0,.05)",
	scaleFontColor: "#c5c7cc"
	});
};
	</script>
		
</body>
</html>