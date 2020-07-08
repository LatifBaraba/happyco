<?php

session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

if(isset($_SESSION["userlogin"])){
    header("Location: index-user.php");
    exit;
}

if(isset($_POST['add'])){
    header("Location: adduser.php");
    exit;
}

require'function.php';

$id = $_GET['id'];

$sql = query("SELECT * FROM user WHERE id = $id")[0];
// var_dump($sql);

$g = query("SELECT * FROM logo ORDER BY id DESC LIMIT 1");

if (isset($_POST["submit"])){

    // cek email validation
    $id = $_POST['id'];
    $email  = $_POST['email'];
    $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
    
    if (filter_var($emailB, FILTER_VALIDATE_EMAIL) === false ||
        $emailB != $email
    ) {
        $_SESSION["emailnotvalid"] = 1;
        header('Location: edit-user.php?id='.$id);
        exit();
    }  

    // cek apakah data diedit atau tidak
    if(edituser($_POST)> 0){
        $_SESSION['editusersuccess'] = 1 ;
    }else{
        $_SESSION["edited"] = 1;
        header('Location: edituser.php?id='.$id);
    } 
}

if (isset($_POST['confirm'])) {
# Publish-button was clicked
    if(changepass($_POST)>0) {
        $_SESSION['passnotmatch']= 1 ;
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
                if( isset($_SESSION["passnotmatch"]) == 1 ) : ?>
                <div class="alert bg-danger" role="alert"><em class="fa fa-lg fa-warning">&nbsp;
                </em>Password Not Match <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button></em>
                </div>
                <?php
                endif; 
                unset($_SESSION['passnotmatch']);
            ?>

            <?php 
                if( isset($_SESSION["emailnotvalid"]) == 1 ) : ?>
                <div class="alert bg-danger" role="alert"><em class="fa fa-lg fa-warning">&nbsp;
                </em>Email Not Valid<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button></em>
                </div>
                <?php
                 endif; 
                 unset($_SESSION['emailnotvalid']);
            ?>

            <?php 
                if( isset($_SESSION["editusersuccess"]) == 1 ) : ?>
                <div class="alert bg-success" role="alert"><em class="fa fa-lg fa-check">&nbsp;
                </em>Edit User Success <a href="index.php"> <strong>Back to Dashboard</strong></a><button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button></em>
                </div>
                <?php
                 endif; 
                 unset($_SESSION['editusersuccess']);
            ?>

			<div class="col-md-6">
                <form action="" method="post" enctype="multipart/form-data">
                  <div class="filler-user">
                    <input type="hidden" name="id" value="<?= $sql["id"];?>">
                            <div class="form-group">
                            <label for="username">Username </label>
                            </div>
                        <input class="form-control" type="text" name="username" id="username" required value="<?= $sql["username"];?>">
                     
                            <div class="form-group">
                            <label for="email">Email </label>
                            </div>
                        <input class="form-control" type="text" name="email" id="email" value="<?= $sql["email"];?>">
                    
                            <div class="form-group">
                            <label for="alamat">Address </label>
                            </div>
                        <input class="form-control" type="text" name="alamat" id="alamat" value="<?= $sql["alamat"];?>">
           
                            <div class="form-group">
                            <label for="telepon">Phone number </label>
                            </div>
                        <input class="form-control" type="text" name="telepon" id="telepon" value="<?= $sql["telepon"];?>">
               
                 <button class="btn btn-edituser-save" type="submit" name="submit">Save</button>
				</div>
            </div><!--/.row-->
			<div class="col-md-6">
                  <div class="filler-user">
                    <div class="form-group">
                        <label for="alamat">New Password </label>
                    </div>
                    <input type="password" class="form-control" name="password" id="password" placeholder="New Password">
                     
                    <div class="form-group">
                        <label for="alamat">Confirm Password </label>
                    </div>
                    <input type="password" class="form-control" name="password2" id="password2" placeholder="Confirm Password">
            
                 <button class="btn btn-changepass-user" type="submit" name="confirm" value="confirm">Change Password</button>
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