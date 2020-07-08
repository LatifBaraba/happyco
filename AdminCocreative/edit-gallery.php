<?php

session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

require'function.php';

$id = $_GET['id'];

$gambar = query("SELECT * FROM gallery WHERE id = $id");

$alb = query("SELECT * FROM album WHERE id_gambar = $id"); 


if (isset($_POST["submit"])){
    $id = $_POST['id'];
    if(editgallery($_POST)> 0){
        $_SESSION['editgallerysuccess'] = 1 ;
        $gambar = query("SELECT * FROM gallery WHERE id = $id");
    }else{
        $_SESSION["editgalleryfailed"] = 1;
        header('Location: edit-product.php?id='.$id);
    } 
}

if (isset($_POST["upload"])){
    $id = $_POST['id'];
    if(uploadgallery($_POST)> 0){
        $_SESSION["uploadgallerysuccess"] = 1;
        $gambar = query("SELECT * FROM gallery WHERE id = $id");

    }else{
        $_SESSION["uploadgalleryfailed"] = 1;
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
			<li><a href="event.php"><em class="fas fa-calendar-alt">&nbsp;</em> Event</a></li>
			<li class="active"><a href="gallery.php"><em class="fas fa-photo-video">&nbsp;</em> Gallery</a></li>
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
				<li class="active">Gallery</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Gallery</h1>
			</div>
		</div><!--/.row-->
		
		<div class="panel panel-container">
			<div class="row">
				<div class="col-md-12">
                <?php 
                if( isset($_SESSION["editgalleryfailed"]) == 1 ) : ?>
                <div class="alert bg-danger" role="alert"><em class="fa fa-lg fa-warning">&nbsp;
                </em>Failed to edit <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button></em>
                </div>
                <?php
                endif; 
                unset($_SESSION['editgalleryfailed']);
           		 ?>

				<?php 
                if( isset($_SESSION["editgallerysuccess"]) == 1 ) : ?>
                <div class="alert bg-success" role="alert"><em class="fa fa-lg fa-check">&nbsp;
                </em>Edit success <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button></em>
                </div>
                <?php
                endif; 
                unset($_SESSION['editgallerysuccess']);
           		 ?>

				<?php 
                if( isset($_SESSION["uploadgalleryfailed"]) == 1 ) : ?>
                <div class="alert bg-danger" role="alert"><em class="fa fa-lg fa-warning">&nbsp;
                </em>Failed to upload <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button></em>
                </div>
                <?php
                endif; 
                unset($_SESSION['uploadgalleryfailed']);
           		 ?>

				<?php 
                if( isset($_SESSION["uploadgallerysuccess"]) == 1 ) : ?>
                <div class="alert bg-success" role="alert"><em class="fa fa-lg fa-check">&nbsp;
                </em>Upload success <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button></em>
                </div>
                <?php
                endif; 
                unset($_SESSION['uploadgallerysuccess']);
           		 ?>
                    <div class="col-md-6">
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $gambar[0]["id"];?>">
                        <div class="filler-user">
                            <div class="form-group">
                                <label for="gambar">Picture</label><br>
                                <img src="asset/img/gallery/<?= $gambar[0]['gambar'];?>" class="img-gallery" alt="">
                                <input type="file" name="gambar" id="gambar" class="upload-btn" style=" padding: 3px ;border: 2px solid #E9ECF2; border-radius: 5px ;">
                                <button class="btn btn-save-about" type="submit" name="upload">Upload Pict</button>
                            </div>
                        </div>
                        <div class="filler-user">
                            <div class="form-group">
                                <label for="judul">judul </label>
                                <input class="form-control" type="text" name="judul" id="judul" value="<?= $gambar[0]["judul"];?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="ketjudul">Caption </label>
                                <input class="form-control" type="text" name="ketjudul" id="ketjudul" value="<?= $gambar[0]["ketjudul"];?>">
                            </div>

                            <div class="form-group">
                                <label for="paragraf">Comment </label>
                                <textarea class="form-control" rows="10" type="text" name="paragraf" id="paragraf"><?= $gambar[0]["paragraf"];?></textarea>
                            </div>

                            <button class="btn btn-edituser-save" type="submit" name="submit">Save Data</button>
                        </div><!--/.col12-->
                    </form>        
                </div>
			</div><!--/.row-->
			<div class="row">
                <div class="col-md-12">
				<h2 style="text-align: center; font-weight: 800;margin: 30px 0 ;">Album</h2>
                <form action="" method="post" enctype="multipart/form-data">
                <table class="table table-striped table-user">
					<thead class="thead-user">
						<tr>
							<th style="width: 40px;">No.</th>
							<th style="text-align: center; width: 200px;">Action</th>
							<th style="text-align: center;">Gambar</th>
							<th style="text-align: center;">Judul</th>
							<th style="text-align: center;">Caption</th>
						</tr>
					</thead>
                        <?php $i = 1;?>
                        
                        <?php foreach( $alb as $row) :?>
						<tr>
							<td><?php echo $i;?></td>
							<td style="text-align: center;">
							<input type="hidden" name="id" value="<?= $row["id"];?>">
							<a href="edit-album.php?id=<?php echo $row["id"];?>" type="button" class="btn-edit-user"><i class="fa fa-edit"></i> Edit</a>
							<a href="delete-album.php?id=<?php echo $row["id"];?>" type="button" class="btn-delete-user" onclick="return confirm('Confrim Delete ?');"><i class="fa fa-times"></i> delete</a>
							</td>
							<td style="text-align: center;"><img src="asset/img/album/<?= $row["gambar"]?>" style="width: 120px;" alt=""></td>
							<td><?= $row['judul'];?></td>
							<td><?= $row['caption'];?></td>
						</tr>
						<?php $i++;?>
						<?php endforeach; ?>
                </table>
				<a href="add-album.php" type="button" class="btn-adduser" style="margin-top: 30px"><i class="fa fa-edit"></i> add album</a>
                </form>
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