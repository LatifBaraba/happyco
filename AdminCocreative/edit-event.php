<?php

session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

require'function.php';

$id = $_GET['id'];

$q = query("SELECT * FROM event WHERE id = $id");

if (isset($_POST["submit"])){
        $id = $_POST['id'];
    if(editevent($_POST)> 0){
        $_SESSION['editeventsuccess'] = 1 ;
        $q = query("SELECT * FROM event WHERE id = $id");
    }else{
        $_SESSION["editeventfailed"] = 1;
        header('Location: edit-product.php?id='.$id);
    } 
}

if (isset($_POST["upload"])){
    $id = $_POST['id'];
	if(uploadevent($_POST)> 0){
		$q = query("SELECT * FROM event WHERE id = $id");
		$_SESSION["uploadeventsuccess"] = 1;

	}else{
		$_SESSION["uploadeventfailed"] = 1;
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
			<li class="active"><a href="event.php"><em class="fas fa-calendar-alt">&nbsp;</em> Event</a></li>
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
				<li class="active">Event</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Event</h1>
			</div>
		</div><!--/.row-->
		<form action="" enctype="multipart/form-data" method="post">
		<div class="panel panel-container">
			<div class="row">
				<div class="col-md-12">
                <?php 
                if( isset($_SESSION["editeventfailed"]) == 1 ) : ?>
                <div class="alert bg-danger" role="alert"><em class="fa fa-lg fa-warning">&nbsp;
                </em>Failed to edit <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button></em>
                </div>
                <?php
                endif; 
                unset($_SESSION['editeventfailed']);
           		 ?>

				<?php 
                if( isset($_SESSION["editeventsuccess"]) == 1 ) : ?>
                <div class="alert bg-success" role="alert"><em class="fa fa-lg fa-check">&nbsp;
                </em>Edit success <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button></em>
                </div>
                <?php
                endif; 
                unset($_SESSION['editeventsuccess']);
           		 ?>

				<?php 
                if( isset($_SESSION["uploadeventfailed"]) == 1 ) : ?>
                <div class="alert bg-danger" role="alert"><em class="fa fa-lg fa-warning">&nbsp;
                </em>Failed to upload <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button></em>
                </div>
                <?php
                endif; 
                unset($_SESSION['uploadeventfailed']);
           		 ?>

				<?php 
                if( isset($_SESSION["uploadeventsuccess"]) == 1 ) : ?>
                <div class="alert bg-success" role="alert"><em class="fa fa-lg fa-check">&nbsp;
                </em>Upload success <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button></em>
                </div>
                <?php
                endif; 
                unset($_SESSION['uploadeventsuccess']);
           		 ?>

                <div class="col-md-6">
                <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $q[0]["id"];?>">
                <div class="filler-user">
                    <div class="form-group">
                        <label for="gambar">Icon Picture</label><br>
                        <img src="asset/img/ourproduct/<?= $q[0]['gambar'];?>" class="img-product" alt="">
                        <input type="file" name="gambar" id="gambar" class="upload-btn" style=" padding: 3px ;border: 2px solid #E9ECF2; border-radius: 5px ;">
                        <button class="btn btn-save-about" type="submit" name="upload">Upload Pict</button>
                    </div>
                </div>
                <div class="filler-user">
					<div class="form-group">
						<label for="tanggal">Date </label>
						</div>
						<input class="form-control" type="text" name="tanggal" id="from-datepicker" value="<?= $q[0]['tanggal']; ?>"/>
                    <div class="form-group">
                        <label for="judul">Tittle </label>
                        <input class="form-control" type="text" name="judul" value="<?= $q[0]["judul"];?>">
                    </div>
                    <div class="form-group">
                        <label for="caption1">Caption 1</label>
                        <input class="form-control" type="text" name="caption1" id="caption1" value="<?= $q[0]["caption1"];?>">
                    </div>
                    <div class="form-group">
                        <label for="caption2">Caption 2</label>
                        <input class="form-control" type="text" name="caption2" id="caption2" value="<?= $q[0]["caption2"];?>">
                    </div>
                    <div class="form-group">
                        <label for="caption3">Caption 3</label>
                        <input class="form-control" type="text" name="caption3" id="caption3" value="<?= $q[0]["caption3"];?>">
                    </div>
                    
                
                    <button class="btn btn-edituser-save" type="submit" name="submit">Save Data</button>
				</div><!--/.col12-->
            </form>
		</div>
				<div class="col-md-4">
					<div class="panel panel-teal" style="margin-top: 30px;">
						<div class="panel-heading dark-overlay">Info Panel</div>
						<div class="panel-body">
							<ul style="list-style: circle ; text-align: left; color: honeydew;">
								<li>Max picture size 2mb</li>
								<li>File type : png, jpg & jpeg</li><br>
								<li><strong>Caption</strong> Max 300 characters (include space)</li>
							</ul>
						</div>
					</div>
				</div><!--/.col-->
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