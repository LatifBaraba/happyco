<?php

session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

require'function.php';

$sql = query("SELECT * FROM partners");

if (isset($_POST["upload"])){

	if(uploadaddpartner($_POST)> 0){
		$sql = query("SELECT * FROM partners");
		$_SESSION["upload_addsuccess"] = 1;

	}else{
		$_SESSION["upload_addfailed"] = 1;
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CoCreative - Dashboard</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<!-- <link href="css/font-awesome.min.css" rel="stylesheet"> -->
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
			<li><a href="aboutus.php"><em class="fas fa-newspaper">&nbsp;</em> About Us</a></li>
			<li><a href="ourproduct.php"><em class="fas fa-plus-circle">&nbsp;</em> Our Product</a></li>
			<li><a href="oncocreative.php"><em class="fas fa-plus-square">&nbsp;</em> On CoCreative</a></li>
			<li class="active"><a href="partners.php"><em class="fas fa-handshake">&nbsp;</em> Partners & Clients</a></li>
			<li><a href="event.php"><em class="fas fa-calendar-alt">&nbsp;</em> Event</a></li>
			<li><a href="gallery.php"><em class="fas fa-photo-video">&nbsp;</em> Gallery</a></li>
			<li><a href="membership.php"><em class="fas fa-user-check">&nbsp;</em> Membership & Price</a></li>
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
				<li class="active">Partners & Clients</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Partners & Clients</h1>
			</div>
		</div><!--/.row-->
		
		<div class="panel panel-container">
			<div class="row">
			<?php 
                if( isset($_SESSION["deletepartnersuccess"]) == 1 ) : ?>
                <div class="alert bg-success" role="alert"><em class="fa fa-lg fa-check">&nbsp;
                </em>Delete success <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button></em>
                </div>
                <?php
                endif; 
                unset($_SESSION['deletepartnersuccess']);
			   ?>

			<?php 
                if( isset($_SESSION["upload_addsuccess"]) == 1 ) : ?>
                <div class="alert bg-success" role="alert"><em class="fa fa-lg fa-check">&nbsp;
                </em>Adding success <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button></em>
                </div>
                <?php
                endif; 
                unset($_SESSION['upload_addsuccess']);
           		 ?>

			<?php 
                if( isset($_SESSION["upload_addfailed"]) == 1 ) : ?>
                <div class="alert bg-danger" role="alert"><em class="fa fa-lg fa-warning">&nbsp;
                </em>Failed to add <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button></em>
                </div>
                <?php
                endif; 
                unset($_SESSION['upload_addfailed']);
           		 ?>

			<form action="" method="post" enctype="multipart/form-data">
				<div class="col-md-4">
				<table class="table table-striped table-user w-auto">
					<thead class="thead-user">
						<tr>
							<th>No.</th>
							<th style="text-align: center;">Action</th>
							<th style="text-align: center;">Picture</th>
							<th style="text-align: center;">Name</th>
						</tr>
					</thead>
						<?php $i = 1;?>
						<?php foreach ( $sql as $row ): ?>
						<tr>
							<td><?php echo $i;?></td>
							<td style="text-align: center;">
							<input type="hidden" name="id" value="<?= $row["id"];?>">
							<a type="button" href="edit-partner.php?id=<?php echo $row["id"];?>" class="btn-edit-partner"><i class="fa fa-edit"></i>Edit</a>
							<!-- <button class="btn btn-danger" type="submit" name="delete">Delete</button> -->
							<a type="button" href="delete-partner.php?id=<?php echo $row["id"];?>" class="btn-delete-partner" onclick="return confirm('Confrim Delete ?');"><i class="fa fa-minus-circle"></i> delete</a>
							<td style="text-align: center;"><img src="asset/img/partner/<?= $row["gambar"]?>" style="width: 80px;" alt=""></td>
							<td><?= $row['nama']; ?></td>
						</tr>
						<?php $i++;?>
						<?php endforeach; ?>
				</table>
				</div>
				<div class="col-md-1"></div>
				<div class="col-md-4">
				<div class="filler-user">
                    <div class="form-group">
                        <label for="gambar">Icon Picture</label>
                        <input type="file" name="gambar" id="gambar" class="upload-btn" style=" margin: 20px 0px ; padding: 3px ;border: 2px solid #E9ECF2; border-radius: 5px ;">
					</div>
                    <div class="form-group">
						<label for="gambar">Name</label>
						<input class="form-control" type="text" name="nama">
					</div>
					<button class="btn btn-edit-about" type="submit" name="upload"><i class="fas fa-plus"></i> Add</button>
					
                </div>
				</div>
			</div><!--/.row-->
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