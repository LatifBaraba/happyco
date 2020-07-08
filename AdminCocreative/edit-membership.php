<?php

session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

// if(!isset($_POST["submit"]) && isset($_SESSION["pricedisc"])){
//     unset($_SESSION['pricedisc']);
// }

require 'function.php';

$id = $_GET["id"];

$sql = query("SELECT * FROM memberprice WHERE id = $id")[0];
// var_dump($sql);

if (isset($_POST["submit"])){
    // var_dump($_POST);
    $id = $_POST['id'];
    $hargalama = $_POST['hargalama'];
    $diskon = $_POST['diskon'];
    
    $pricenew = $hargalama;
    // $_SESSION['adahargalama']= 0;

    if($_POST['diskon'] !=0) {

        $pricedisc = diskon();
        $pricenew = $pricedisc;
        //$_SESSION['pricedisc'] = $pricedisc;
    }
    // var_dump($pricenew);
    // var_dump(editmemberprice($pricenew));
        if(editmemberprice($pricenew)> 0){
        $sql = query("SELECT * FROM memberprice WHERE id = $id")[0];            
            $_SESSION['successeditmemberprice']= 1 ;
        }
}


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CoCreative - Edit</title>
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
				<li class="active">Member & Price</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Member & Price</h1>
			</div>
		</div><!--/.row-->
		
		<div class="panel panel-container">
			<div class="row">
			<?php 
                if( isset($_SESSION["successeditmemberprice"]) == 1 ) : ?>
                <div class="alert bg-success" role="alert"><em class="fa fa-lg fa-check">&nbsp;
                </em>Edit success <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button></em>
                </div>
                <?php
                endif; 
                unset($_SESSION['successeditmemberprice']);
           		 ?>
			<div class="col-md-6">
                <form action="" method="post" enctype="multipart/form-data">
                  <div class="filler-user">
                    <input type="hidden" name="id" value="<?= $sql["id"];?>">
                            <div class="form-group">
                            <label for="judul">Header </label>
                            </div>
                        <input class="form-control" type="text" name="judul" id="judul" required value="<?= $sql["judul"];?>">
                     
                            <div class="form-group">
                            <label for="hargalama">Old Price </label>
                            </div>
                        <input class="form-control" type="text" name="hargalama" id="hargalama" value="<?= $sql["hargalama"];?>">
                    
                            <div class="form-group">
                            <label for="harga">New Price* </label>
                            </div>
                        <input class="form-control" type="text" name="harga" id="harga" disabled value="<?= $sql["harga"];?>">
           
                            <div class="form-group">
                            <label for="diskon">Discount </label>
                            </div>
                        <input class="form-control" type="text" name="diskon" id="diskon" value="<?= $sql["diskon"];?>">

                        <div class="form-group">
                            <label for="fitur1">Feature 1 </label>
                            </div>
                        <input class="form-control" type="text" name="fitur1" id="fitur1" value="<?= $sql["fitur1"];?>">

                        <div class="form-group">
                            <label for="fitur2">Feature 2 </label>
                            </div>
                        <input class="form-control" type="text" name="fitur2" id="fitur2" value="<?= $sql["fitur2"];?>">

                        <div class="form-group">
                            <label for="fitur3">Feature 3 </label>
                            </div>
                        <input class="form-control" type="text" name="fitur3" id="fitur3" value="<?= $sql["fitur3"];?>">
               
                    </div>
                </div><!--/.row-->
                <div class="col-md-6">

                        <div class="form-group">
                            <label for="fitur4">Feature 4 </label>
                            </div>
                        <input class="form-control" type="text" name="fitur4" id="fitur4" value="<?= $sql["fitur4"];?>">

                        <div class="form-group">
                            <label for="fitur5">Feature 5 </label>
                            </div>
                        <input class="form-control" type="text" name="fitur5" id="fitur5" value="<?= $sql["fitur5"];?>">

                        <div class="form-group">
                            <label for="fitur6">Feature 6 </label>
                            </div>
                        <input class="form-control" type="text" name="fitur6" id="fitur6" value="<?= $sql["fitur6"];?>">

                        <div class="form-group">
                            <label for="fitur7">Feature 7 </label>
                            </div>
                        <input class="form-control" type="text" name="fitur7" id="fitur7" value="<?= $sql["fitur7"];?>">

                        <div class="form-group">
                            <label for="fitur8">Feature 8 </label>
                            </div>
                        <input class="form-control" type="text" name="fitur8" id="fitur8" value="<?= $sql["fitur8"];?>">

                        <div class="form-group">
                            <label for="fitur9">Feature 9 </label>
                            </div>
                        <input class="form-control" type="text" name="fitur9" id="fitur9" value="<?= $sql["fitur9"];?>">

                        <div class="form-group">
                            <label for="fitur10">Feature 10 </label>
                            </div>
                        <input class="form-control" type="text" name="fitur10" id="fitur10" value="<?= $sql["fitur10"];?>">
                </div>
                <button class="btn btn-edituser-save" type="submit" name="submit">Save</button>
            
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