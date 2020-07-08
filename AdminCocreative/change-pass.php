<?php 
session_start();

require 'function.php';

if(isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

$email = $_GET["email"];
//var_dump($email);

if (isset($_POST['confirm'])) {
    # Publish-button was clicked
    if(changepassemail($_POST,$email)>0) {
        $_SESSION['rubahpass']= 1 ;
    }
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sharia - Login</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link rel="icon" href="asset/img/FAVICON-PUTIH..png">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<div class="wrapper">
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel">
                <!-- <h1 class="tittle" style="text-align: center ; margin-bottom: 50px ; font-weight: 600;">Co Creative</h1> -->
                <img src="asset/img/login2.png" style="width: 270px; margin: 0 auto; display: block;" alt="">
				<div class="panel-body">
					<form role="form" action="" method="post" enctype="multipart/form-data">
					
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" type="password" autofocus="" style="background-color: #7c7c7c;border: 1px solid #0078BF;">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Confirm Password" name="password2" type="password" autofocus="" style="background-color: #7c7c7c;border: 1px solid #0078BF;">
							</div>
							<button class="btn btn-login" type="submit" name="confirm">Submit Change</button>
							<a href="login.php" style="float: right; padding: 10px; color: black;"><i class="fa fa-arrow-right"></i> Log In</a>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
</div>

<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
