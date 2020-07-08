<?php
session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

require 'function.php';

$h = query("SELECT * FROM gallery");

$g = query("SELECT * FROM logo ORDER BY id DESC LIMIT 1");

if (isset($_POST["submit"])){


        // cek apakah data ditambahkan atau tidak
        uploadaddalbum($_POST);
        //if(adduser($_POST)> 0){
            // echo "<script>
            //      alert('data added success!');
            // document.location.href = 'index-admin.php';
            //       </script>";
                //  $_SESSION['berhasiltambah']= 1;
        // }else{
        //     // echo "<script>
        //     //      alert('data added failed!');
        //     //      document.location.href = 'index-admin.php';
        //     //       </script>";
        //     $_SESSION['gagaltambah']= 1;
        //     // return false;
        // } 
    }

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CoCreative - Add</title>
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
			<li class="active"><a href="index.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
			<li><a href="logo.php"><em class="fas fa-spa">&nbsp;</em> Logo</a></li>
			<li><a href="slider.php"><em class="fas fa-images">&nbsp;</em> Slider screen</a></li>
			<li><a href="aboutus.php"><em class="fas fa-newspaper-o">&nbsp;</em> About Us</a></li>
			<li><a href="ourproduct.php"><em class="fas fa-plus-circle">&nbsp;</em> Our Product</a></li>
			<li><a href="oncocreative.php"><em class="fas fa-plus-square">&nbsp;</em> On CoCreative</a></li>
            <li><a href="partners.php"><em class="fas fa-handshake">&nbsp;</em> Partners & Clients</a></li>
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
				<li class="active">Dashboard</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Dashboard</h1>
			</div>
		</div><!--/.row-->
		
		<div class="panel panel-container">
			<div class="row">

            <?php 
                if( isset($_SESSION["emailinvalid"]) == 1 ) : ?>
                <div class="alert bg-danger" role="alert"><em class="fa fa-lg fa-warning">&nbsp;
                </em>Email Not Valid<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button></em>
                </div>
                <?php
                 endif; 
                 unset($_SESSION['emailinvalid']);
            ?>

            <?php 
                if( isset($_SESSION["gagaltambah"]) == 1 ) : ?>
                <div class="alert bg-danger" role="alert"><em class="fa fa-lg fa-warning">&nbsp;
                </em>Failed Adding User<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button></em>
                </div>
                <?php
                 endif; 
                 unset($_SESSION['gagaltambah']);
            ?>

            <?php 
                if( isset($_SESSION["usernamesama"]) == 1 ) : ?>
                <div class="alert bg-danger" role="alert"><em class="fa fa-lg fa-warning">&nbsp;
                </em>Username not available<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button></em>
                </div>
                <?php
                 endif; 
                 unset($_SESSION['usernamesama']);
            ?>

            <?php 
                if( isset($_SESSION["passwordtidaksesuai"]) == 1 ) : ?>
                <div class="alert bg-danger" role="alert"><em class="fa fa-lg fa-warning">&nbsp;
                </em>Password Tidak Sesuai<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button></em>
                </div>
                <?php
                 endif; 
                 unset($_SESSION['passwordtidaksesuai']);
            ?>

            <?php 
                if( isset($_SESSION["berhasiltambah"]) == 1 ) : ?>
                <div class="alert bg-success" role="alert"><em class="fa fa-lg fa-check">&nbsp;
                </em>Edit User Success <a href="index.php"> <strong>Back to Dashboard</strong></a><button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button></em>
                </div>
                <?php
                 endif; 
                 unset($_SESSION['berhasiltambah']);
            ?>

			<div class="col-md-6">
                <form action="" method="post" enctype="multipart/form-data">
                <div class="filler-user">
                    <div class="form-group">
                        <label for="gambar">Picture</label>
                        <input type="file" name="gambar" id="gambar" class="upload-btn" style=" padding: 3px ;border: 2px solid #E9ECF2; border-radius: 5px ; margin-bottom: 30px; margin-top: 10px;">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Category</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="id_gambar" required>
                            <option value=""> -- None --</option> 
                            <?php foreach($h as $row) {?>
                            <option value="<?= $row['id']; ?>"><?= $row['judul'];?></option> 
                            <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                        <label for="judul">Judul </label>
                        <input class="form-control" type="text" name="judul" id="judul" placeholder="Judul : " required>
                        </div>
                     
                        <div class="form-group">
                            <label for="caption">Caption </label>
                        <textarea class="form-control" rows="10"  type="text" name="caption" id="caption"></textarea>
                        </div>
                
                <button class="btn btn-add-user" type="submit" name="submit">Input Data</button>
            </form>
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