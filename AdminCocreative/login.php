<?php 
session_start();

if( isset($_SESSION["login"]) ) {
	header("Location: index.php");
	exit;
}

require 'function.php';

if( isset($_POST["login"]) ) {
    $username = $_POST["username"];
	$password = $_POST["password"];
    
    $result = mysqli_query($conn, "SELECT * FROM superadmin WHERE username = '$username'");
	// cek username
	if( mysqli_num_rows($result) === 1 ) {
		// cek password
        $row = mysqli_fetch_assoc($result);
        // var_dump($row);
		if( password_verify($password, $row["password"]) ) {
			// set session
			$_SESSION["login"] = true;
			header("Location: index.php");
			exit;
		}
	}
	$error = true;
}

if( isset($_POST["login"]) ) {
    $username = $_POST["username"];
	$password = $_POST["password"];
    
    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
	// cek username
	if( mysqli_num_rows($result) === 1 ) {
		// cek password
        $row = mysqli_fetch_assoc($result);
        // var_dump($row);
		if( password_verify($password, $row["password"]) ) {
			// set session
            $_SESSION["login"] = true;
            $_SESSION["userlogin"]= true;
			header("Location: index.php");
			exit;
		}
	}
	$error = true;
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
						<?php if( isset($error) ) : ?>
							<h4 style="color: #5CB85C ; text-align: center;" >Username / Password invalid</h4>
							<?php endif; ?>
							<div class="form-group">
								<input class="form-control" placeholder="Username" name="username" type="text" autofocus="" style="background-color: #dbdbdb;border: 1px solid #0078BF;">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" type="password" style="background-color: #dbdbdb;border: 1px solid #0078BF">
							</div>
							<button class="btn btn-login" type="submit" name="login">Login</button>
							<a href="submit-email.php" class="forgot-pass">Forgot Password</a></fieldset>
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
