 <?php
require "AdminCocreative/function.php";
 
 $lg = query("SELECT * FROM logo ORDER BY id DESC LIMIT 1");

 $sld = query("SELECT * FROM slider");

 $abt = query("SELECT * FROM visi");

 $pro = query("SELECT * FROM product");

 $cre = query("SELECT * FROM creative");

 $par = query("SELECT * FROM partners");

 $mem = query("SELECT * FROM memberprice");

 $ctc = query("SELECT * FROM contact"); 

 $glr = query("SELECT * FROM gallery");

 $eve = query("SELECT * FROM event"); 

 $soc = query("SELECT * FROM social"); 
 
 $bok = query("SELECT * FROM book"); 

 $alb = query("SELECT * FROM album WHERE id_gambar = 1"); 
 $alb1 = query("SELECT * FROM album WHERE id_gambar = 2"); 
 $alb2 = query("SELECT * FROM album WHERE id_gambar = 3"); 
 $alb3 = query("SELECT * FROM album WHERE id_gambar = 4"); 
 $alb4 = query("SELECT * FROM album WHERE id_gambar = 5"); 
 $alb5 = query("SELECT * FROM album WHERE id_gambar = 6"); 

 if(isset($_POST['submit'])){
		submitemail($_POST);
 }

 ?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html lang="en" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html lang="en" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html lang="en" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
    <head>
    	<!-- meta character set -->
        <meta charset="utf-8">
		<!-- Always force latest IE rendering engine or request Chrome Frame -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>CoCreative</title>		
		<!-- Meta Description -->
        <meta name="description" content="Your Incubator Space For Start And Growing Bussines.">
        <meta name="keywords" content="one page, single page, onepage, responsive, parallax, creative, business, html5, css3, css3 animation,coworking">
        <meta name="author" content="">
		
		<!-- Mobile Specific Meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
		
		<!-- CSS
		================================================== -->
		
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
		<link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700,900&display=swap" rel="stylesheet">
		
		<!-- Fontawesome Icon font -->
        <link rel="stylesheet" href="css/font-awesome.min.css">
		<!-- bootstrap.min -->
        <link rel="stylesheet" href="css/jquery.fancybox.css">
		<!-- bootstrap.min -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
		<!-- bootstrap.min -->
        <link rel="stylesheet" href="css/owl.carousel.css">
		<!-- bootstrap.min -->
        <link rel="stylesheet" href="css/slit-slider.css">
		<!-- bootstrap.min -->
        <link rel="stylesheet" href="css/animate.css">
		<!-- Main Stylesheet -->
		<link rel="stylesheet" href="css/main.css">
		<link href="css/swiper.css" rel="stylesheet">	
		
		<!-- Favicon -->
		<!-- Favicon  -->
		<link rel="icon" href="img/icons/FAVICON-PUTIH..png">

		<!-- Modernizer Script for old Browsers -->
        <script src="js/modernizr-2.6.2.min.js"></script>
		<style>
			.bg-img-1 {
				background-image: url(AdminCocreative/asset/img/slider/<?= $sld[0]['gambar'];?>);
			}
			.bg-img-2 {
				background-image: url(AdminCocreative/asset/img/slider/<?= $sld[1]['gambar'];?>);
			}
			.bg-img-3 {
				background-image: url(AdminCocreative/asset/img/slider/<?= $sld[2]['gambar'];?>);
			}
			
			#social {
				background-image: url(AdminCocreative/asset/img/social/<?= $ctc[0]['gambar'];?>);
				padding: 0;
			}
			</style>
    </head>
	
    <body id="body">
		<!-- Back to top button -->
	<a for="foo" id="back2Top" title="Back to top" href="#">&#10148;</a>

		<!-- preloader -->
		<div id="preloader">
            <div class="loder-box">
            	<div class="battery"></div>
            </div>
		</div>
		<!-- end preloader -->

        <!--
        Fixed Navigation
        ==================================== -->
        <header id="navigation" class="navbar-inverse navbar-fixed-top animated-header">
            <div class="container">
                <div class="navbar-header">

					<!-- logo -->
					<!-- <a class="logotextcapt" href="#body">Co Creative</a> -->
					<a style="height: 60px; width: 120px;" href="index.php"><img class="image-logo" src="./AdminCocreative/asset/img/logo/<?= $lg[0]['gambar'];?>" alt="alternative"></a> 
					<!-- /logo -->
					<!-- responsive nav button -->
					
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
                    </button>
					<!-- /responsive nav button -->
					
				
                </div>

				<!-- main nav -->
                <nav class="collapse navbar-collapse navbar-right" role="navigation">
                    <ul id="nav" class="nav navbar-nav">
                        <li><a href="#body">Home</a></li>
                        <li><a href="#service">Our Product</a></li>
                        <li><a href="#portfolio">What’s on Co Creative</a></li>
                        <li><a href="#OurSpace">Our Space</a></li>
                        <li><a href="#price">Membership Price</a></li>
                        <li><a href="#contact">Contact</a></li>

                    </ul>
                  <a class="btnbook btn" href="https://wa.me/<?php echo $bok[0]['telepon'];?>" role="button" target="_blank">Book Now</a>
                </nav>
				<!-- /main nav -->
				
            </div>
        </header>
        <!--
        End Fixed Navigation
        ==================================== -->
		
		<main class="site-content" role="main">
		
        <!--
        Home Slider
        ==================================== -->
		
		<section id="home-slider">
            <div id="slider" class="sl-slider-wrapper">
				<div class="sl-slider">

					<div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="-25" data-slice2-rotation="-25" data-slice1-scale="2" data-slice2-scale="2">

						<div class="bg-img bg-img-1"></div>

						<div class="slide-caption">
                            <div class="caption-content">
                                <h2 class="animated fadeInDown CoCreativewarna"><?= $sld[0]['judul']; ?></h2>
                                <span class="animated fadeInDown"><?= $sld[0]['paragraf']; ?></span>
                            </div>
                        </div>
						
					</div>
				</div><!-- /sl-slider -->
				<div class="sl-slider">

					<div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="-25" data-slice2-rotation="-25" data-slice1-scale="2" data-slice2-scale="2">

						<div class="bg-img bg-img-2"></div>

						<div class="slide-caption">
                            <div class="caption-content">
							<h2 class="animated fadeInDown CoCreativewarna"><?= $sld[1]['judul']; ?></h2>
                                <span class="animated fadeInDown"><?= $sld[1]['paragraf']; ?></span>
                            </div>
                        </div>
						
					</div>
				</div><!-- /sl-slider -->
				<div class="sl-slider">

					<div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="-25" data-slice2-rotation="-25" data-slice1-scale="2" data-slice2-scale="2">

						<div class="bg-img bg-img-3"></div>

						<div class="slide-caption">
                            <div class="caption-content">
							<h2 class="animated fadeInDown CoCreativewarna"><?= $sld[2]['judul']; ?></h2>
                                <span class="animated fadeInDown"><?= $sld[2]['paragraf']; ?></span>
                            </div>
                        </div>
						
					</div>
				</div><!-- /sl-slider -->

                <!-- 
                <nav id="nav-arrows" class="nav-arrows">
                    <span class="nav-arrow-prev">Previous</span>
                    <span class="nav-arrow-next">Next</span>
                </nav>
                -->
                
                <nav id="nav-arrows" class="nav-arrows hidden-xs hidden-sm visible-md visible-lg">
                    <a href="javascript:;" class="sl-prev">
						<!-- <i class="fa fa-angle-left fa-3x"></i> -->
						<img width="50" src="img/icons/leftco.png" alt="alternative ">
                    </a>
                    <a href="javascript:;" class="sl-next">
						<!-- <i class="fa fa-angle-right fa-3x"></i> -->
						<img  width="50" src="img/icons/rigthco.png" alt="alternative">
                    </a>
                </nav>
                

				<nav id="nav-dots" class="nav-dots visible-xs visible-sm hidden-md hidden-lg">
					<span class="nav-dot-current"></span>
					<span></span>
					<span></span>
				</nav>

			</div><!-- /slider-wrapper -->
		</section>
		
        <!--
        End Home SliderEnd
		==================================== -->
	
			<!-- about section -->
			<section id="about" >
				<div class="container">
					<div class="row">
						<div class="col-md-4 col-xs-12 wow animated fadeInLeft">
							<div class="recent-works">
									<h3><?= $abt[0]['judul']; ?></h3>
								<div id="works">
									<div class="work-item">
										<p><?= $abt[0]['paragraf']; ?></p>
									</div>
									
								</div>
							</div>
						</div>
						<div class="col-md-7 col-xs-12 col-md-offset-1 wow animated fadeInRight">
							<div class="welcome-block">	
								 <h3><?= $abt[1]['judul']; ?></h3>						
						     	 <div class="message-body">
						       		<p><?= $abt[1]['paragraf']; ?></p>
						     	 </div>
						       	<a href="#" class="btn btn-border btn-effect pull-right">Read More</a>
						    </div>
						</div>
					</div>
				</div>
			</section>
			<!-- end about section -->
			
			
			<!-- Service section -->
			<!-- <section id="service">
				<div class="container">
					<div class="row justify-content-center">
						<div class="sec-title text-center">
							<h2 class="wow animated bounceInLeft">Our Product</h2>
							<p class="wow animated bounceInRight">What can you get ?</p>
						</div>

						<?php foreach ( $pro as $l => $row ): 
							if ($l >= 0 && $l <= 3){ ?>
						
						<div class="col-md-3 col-sm-6 col-xs-12 text-center wow animated zoomIn">
							<div class="service-item">
								<div class="service-icon">
									<img src="./AdminCocreative/asset/img/ourproduct/<?= $row['gambar'];?>" style="width: 50px;" >
								</div>
								<h3><?= $row['judul']; ?></h3>
								<p><?= $row['paragraf']; ?></p>
							</div>
						</div>
						<?php }	?>
						<?php endforeach; ?>
					</div>
				</div>
						
						<div class="container">
							<div class="row justify-content-center">
								<?php foreach ( $pro as $l => $row ): 
									if ($l >= 4 && $l <= 5){ ?>
								<div class="col-md-6 col-sm-6 col-xs-12 text-center wow animated zoomIn">
									<div class="service-item">
										<div class="service-icon">
											<img src="./AdminCocreative/asset/img/ourproduct/<?= $row['gambar'];?>" style="width: 50px;" >
										</div>
										<h3><?= $row['judul']; ?></h3>
										<p style="padding: 0 100px ;"><?= $row['paragraf']; ?></p>
									</div>
								</div>
								<?php }	?>
								<?php endforeach; ?>
							</div>
						</div>
			</section> -->
			<!-- end Service section -->
			
			<!-- portfolio section -->
			<!-- <section id="portfolio" class="portofolio">
				<div class="container">
					<div class="row">
					
						<div class="sec-title text-center wow animated fadeInDown">
							<h2>What’s on Co Creative ?</h2>
							<p>You Can Enjoy</p>
						</div>

						
						<?php foreach ( $cre as $k => $row ): 
							if ($k >= 0 && $k <= 3){ ?>
						<div class="col-md-3 col-sm-6 col-xs-12 text-center wow animated zoomIn">
							<div class="service-item">
								<div class="service-icon">
									<img src="./AdminCocreative/asset/img/oncocreative/<?= $row['gambar'];?>" style="width: 50px;" >
								</div>
								<h3><?= $row['judul']; ?></h3>
							</div>
						</div>
						<?php }	?>
						<?php endforeach; ?>

						<div class="container">
						<?php foreach ( $cre as $k => $row ): 
							if ($k >= 4 && $k <= 7){ ?>
						<div class="col-md-3 col-sm-6 col-xs-12 text-center wow animated zoomIn">
							<div class="service-item">
								<div class="service-icon">
									<img src="./AdminCocreative/asset/img/oncocreative/<?= $row['gambar'];?>" style="width: 50px;" >
								</div>
								<h3><?= $row['judul']; ?></h3>
							</div>
						</div>
						<?php }	?>
						<?php endforeach; ?>
						</div>
					</div>
				</div>
			</section> -->
			<!-- end portfolio section -->
			
			<section id="OurSpace">
				
				<div class="container">
					<div class="row">
					
						<div class="sec-title text-center wow animated fadeInDown">
							<h2>OUR SPACE</h2>
							<p></p>
						</div>

						<ul class="project-wrapper wow animated fadeInUp">
						
						<!-- ----------------------- gallery display : Co Working Space --------------------->
							<li class="portfolio-item">
							<a class="fancybox" title="<?= $glr[0]['judul'];?>" data-fancybox-group="1" href="AdminCocreative/asset/img/gallery/<?= $glr[0]['gambar'];?>">
								<img src="AdminCocreative/asset/img/gallery/<?= $glr[0]['gambar'];?>" class="img-responsive" alt="<?= $glr[0]['paragraf'];?>">
							</a>
								<figcaption class="mask">
									<h4><?= $glr[0]['judul'];?></h4>
									<p><?= $glr[0]['ketjudul'];?></p>
								</figcaption>
								<!-- <ul class="external">
									<li><a class="fancybox" title="<?= $glr[0]['judul'];?>" data-fancybox-group="1" href="AdminCocreative/asset/img/gallery/<?= $glr[0]['gambar'];?>">
									<i class="fa fa-search"></i></a></li>
									<li><a href=""><i class="fa fa-link"></i></a></li>
								</ul> -->
							</li>

						<!-- ----------------------- gallery display : Our Space --------------------->
							<li class="portfolio-item">
							<a class="fancybox" title="<?= $glr[1]['judul'];?>" data-fancybox-group="2" href="AdminCocreative/asset/img/gallery/<?= $glr[1]['gambar'];?>">
								<img src="AdminCocreative/asset/img/gallery/<?= $glr[1]['gambar'];?>" class="img-responsive" alt="<?= $glr[1]['paragraf'];?>">
							</a>
								<figcaption class="mask">
									<h4><?= $glr[1]['judul'];?></h4>
									<p><?= $glr[1]['ketjudul'];?></p>
								</figcaption>
								<!-- <ul class="external">
									<li><a class="fancybox" title="<?= $glr[1]['judul'];?>" data-fancybox-group="2" href="AdminCocreative/asset/img/gallery/<?= $glr[1]['gambar'];?>">
									<i class="fa fa-search"></i></a></li>
									<li><a href=""><i class="fa fa-link"></i></a></li>
								</ul> -->
							</li>

						<!-- ----------------------- gallery display : Event Space --------------------->
							<li class="portfolio-item">
							<a class="fancybox" title="<?= $glr[2]['judul'];?>" data-fancybox-group="3" href="AdminCocreative/asset/img/gallery/<?= $glr[2]['gambar'];?>">
								<img src="AdminCocreative/asset/img/gallery/<?= $glr[2]['gambar'];?>" class="img-responsive" alt="<?= $glr[2]['paragraf'];?>">
							</a>
								<figcaption class="mask">
									<h4><?= $glr[2]['judul'];?></h4>
									<p><?= $glr[2]['ketjudul'];?></p>
								</figcaption>
								<!-- <ul class="external">
									<li><a class="fancybox" title="<?= $glr[2]['judul'];?>" data-fancybox-group="3" href="AdminCocreative/asset/img/gallery/<?= $glr[2]['gambar'];?>">
									<i class="fa fa-search"></i></a></li>
									<li><a href=""><i class="fa fa-link"></i></a></li>
								</ul> -->
							</li>

						<!-- ----------------------- gallery display : Meeting Room --------------------->
							<li class="portfolio-item">
							<a class="fancybox" title="<?= $glr[3]['judul'];?>" data-fancybox-group="4" href="AdminCocreative/asset/img/gallery/<?= $glr[3]['gambar'];?>">
								<img src="AdminCocreative/asset/img/gallery/<?= $glr[3]['gambar'];?>" class="img-responsive" alt="<?= $glr[3]['paragraf'];?>">
							</a>
								<figcaption class="mask">
									<h4><?= $glr[3]['judul'];?></h4>
									<p><?= $glr[3]['ketjudul'];?></p>
								</figcaption>
								<!-- <ul class="external">
									<li><a class="fancybox" title="<?= $glr[3]['judul'];?>" data-fancybox-group="4" href="AdminCocreative/asset/img/gallery/<?= $glr[3]['gambar'];?>">
									<i class="fa fa-search"></i></a></li>
									<li><a href=""><i class="fa fa-link"></i></a></li>
								</ul> -->
							</li>
						<!-- ----------------------- gallery display : Ameneties --------------------->
							<li class="portfolio-item">
							<a class="fancybox" title="<?= $glr[4]['judul'];?>" data-fancybox-group="5" href="AdminCocreative/asset/img/gallery/<?= $glr[4]['gambar'];?>">
								<img src="AdminCocreative/asset/img/gallery/<?= $glr[4]['gambar'];?>" class="img-responsive" alt="<?= $glr[4]['paragraf'];?>">
							</a>
								<figcaption class="mask">
									<h4><?= $glr[4]['judul'];?></h4>
									<p><?= $glr[4]['ketjudul'];?></p>
								</figcaption>
								<!-- <ul class="external">
									<li><a class="fancybox" title="<?= $glr[4]['judul'];?>" data-fancybox-group="5" href="AdminCocreative/asset/img/gallery/<?= $glr[4]['gambar'];?>">
									<i class="fa fa-search"></i></a></li>
									<li><a href=""><i class="fa fa-link"></i></a></li>
								</ul> -->
							</li>

						<!-- ----------------------- gallery display : Office Space --------------------->
							<li class="portfolio-item">
								<a class="fancybox" title="<?= $glr[5]['judul'];?>" data-fancybox-group="6" href="AdminCocreative/asset/img/gallery/<?= $glr[5]['gambar'];?>">
								<img src="AdminCocreative/asset/img/gallery/<?= $glr[5]['gambar'];?>" class="img-responsive" alt="<?= $glr[5]['paragraf'];?>">
								</a>
								<figcaption class="mask">
									<h4><?= $glr[5]['judul'];?></h4>
									<p><?= $glr[5]['ketjudul'];?></p>
								</figcaption>
								<!--<ul class="external">-->
								<!--	<li><a class="fancybox" title="<?= $glr[5]['judul'];?>" data-fancybox-group="6" href="AdminCocreative/asset/img/gallery/<?= $glr[5]['gambar'];?>">-->
								<!--	<i class="fa fa-search"></i></a></li>-->
								<!--	<li><a href=""><i class="fa fa-link"></i></a></li>-->
								<!--</ul>-->
							</li>

						</ul>

						<!-- ---------------------------------------------------------------------->
						<!-- ----------------------- gallery display : kids --------------------->
						<!-- ---------------------------------------------------------------------->

						
						<!-- ----------------------- gallery display : Co Working Space --------------------->
						<ul style="display:none;" class="project-wrapper wow animated fadeInUp">

							<?php foreach ( $alb as $row ): ?>
								<li class="portfolio-item">
									<img src="" class="img-responsive" alt="<?= $row['caption'];?>">
									<figcaption class="mask">
										<!-- <h3>Coworking Space</h3>
										<p>Low Speed Internet Access,Free Flow Water,Convenience Space & Furniture </p> -->
									</figcaption>
									<ul class="external">
										<li><a class="fancybox" title="<?= $row['judul'];?>" data-fancybox-group="1" href="AdminCocreative/asset/img/album/<?= $row['gambar'];?>">
										<i class="fa fa-search"></i></a></li>
										<li><a href=""><i class="fa fa-link"></i></a></li>
									</ul>
								</li>
							<?php endforeach; ?>

						<!-- ----------------------- gallery display : Our Space --------------------->
							<?php foreach ( $alb1 as $row ): ?>
								<li class="portfolio-item">
									<img src="" class="img-responsive" alt="<?= $row['caption'];?>">
									<figcaption class="mask">
										<!-- <h3>Coworking Space</h3>
										<p>Low Speed Internet Access,Free Flow Water,Convenience Space & Furniture </p> -->
									</figcaption>
									<ul class="external">
										<li><a class="fancybox" title="<?= $row['judul'];?>" data-fancybox-group="2" href="AdminCocreative/asset/img/album/<?= $row['gambar'];?>">
										<i class="fa fa-search"></i></a></li>
										<li><a href=""><i class="fa fa-link"></i></a></li>
									</ul>
								</li>
							<?php endforeach; ?>

						<!-- ----------------------- gallery display : Event Space --------------------->
							<?php foreach ( $alb2 as $row ): ?>
								<li class="portfolio-item">
									<img src="" class="img-responsive" alt="<?= $row['caption']?>">
									<figcaption class="mask">
										<!-- <h3>Coworking Space</h3>
										<p>Low Speed Internet Access,Free Flow Water,Convenience Space & Furniture </p> -->
									</figcaption>
									<ul class="external">
										<li><a class="fancybox" title="<?= $row['judul']?>" data-fancybox-group="3" href="AdminCocreative/asset/img/album/<?= $row['gambar']?>">
										<i class="fa fa-search"></i></a></li>
										<li><a href=""><i class="fa fa-link"></i></a></li>
									</ul>
								</li>
							<?php endforeach; ?>

						<!-- ----------------------- gallery display : Meeting Room --------------------->
							<?php foreach ( $alb3 as $row ): ?>
								<li class="portfolio-item">
									<img src="" class="img-responsive" alt="<?= $row['caption']?>">
									<figcaption class="mask">
										<!-- <h3>Coworking Space</h3>
										<p>Low Speed Internet Access,Free Flow Water,Convenience Space & Furniture </p> -->
									</figcaption>
									<ul class="external">
										<li><a class="fancybox" title="<?= $row['judul']?>" data-fancybox-group="4" href="AdminCocreative/asset/img/album/<?= $row['gambar']?>">
										<i class="fa fa-search"></i></a></li>
										<li><a href=""><i class="fa fa-link"></i></a></li>
									</ul>
								</li>
							<?php endforeach; ?>

						<!-- ----------------------- gallery display : Ameneties --------------------->
							<?php foreach ( $alb4 as $row ): ?>
								<li class="portfolio-item">
									<img src="" class="img-responsive" alt="<?= $row['caption']?>">
									<figcaption class="mask">
										<!-- <h3>Coworking Space</h3>
										<p>Low Speed Internet Access,Free Flow Water,Convenience Space & Furniture </p> -->
									</figcaption>
									<ul class="external">
										<li><a class="fancybox" title="<?= $row['judul']?>" data-fancybox-group="5" href="AdminCocreative/asset/img/album/<?= $row['gambar']?>">
										<i class="fa fa-search"></i></a></li>
										<li><a href=""><i class="fa fa-link"></i></a></li>
									</ul>
								</li>
							<?php endforeach; ?>

						<!-- ----------------------- gallery display : office Space --------------------->
							<?php foreach ( $alb5 as $row ): ?>
								<li class="portfolio-item">
									<img src="" class="img-responsive" alt="<?= $row['caption']?>">
									<figcaption class="mask">
										<!-- <h3>Coworking Space</h3>
										<p>Low Speed Internet Access,Free Flow Water,Convenience Space & Furniture </p> -->
									</figcaption>
									<ul class="external">
										<li><a class="fancybox" title="<?= $row['judul']?>" data-fancybox-group="6" href="AdminCocreative/asset/img/album/<?= $row['gambar']?>">
										<i class="fa fa-search"></i></a></li>
										<li><a href=""><i class="fa fa-link"></i></a></li>
									</ul>
								</li>
							<?php endforeach; ?>

						</ul>
					</div>
				</div>
			</section>

			<section id="event"> 
				<div class="overlay">
				<div class="container">
					<div class="row">
						<div class="sec-title text-center white wow animated fadeInDown">
							<h2>OUR PARTNERS & CLIENTS</h2>
						</div>
						<div id="events" class=" wow animated fadeInUp">

						<!-- LOGO SECTION -->
						<div class="slider-1">
								<div class="container">
									<div class="row">
										<div class="col-lg-12">
											<!-- Card Slider -->
											<div class="slider-container">
												<div class="swiper-container card-slider">
													<div class="swiper-wrapper">
													<?php foreach ( $par as $row ): ?>
														<!-- Slide -->
														<div class="swiper-slide">
															<div class="card">
																<img class="card-image" src="./AdminCocreative/asset/img/partner/<?= $row['gambar'];?>" alt=""><br>
																<span><?= $row['nama'];?></span>
															</div>
														</div> <!-- end of swiper-slide -->
														<!-- end of slide -->
													<?php endforeach; ?>
													</div> <!-- end of swiper-wrapper -->
								
													<!-- Add Arrows -->
													<div class="swiper-button-next"></div>
													<div class="swiper-button-prev"></div>
													<!-- end of add arrows -->
								
												</div> <!-- end of swiper-container -->
											</div> <!-- end of slider-container -->
											<!-- end of card slider -->
						
										</div> <!-- end of col -->
									</div> <!-- end of row -->
								</div> <!-- end of container -->
							</div> <!-- end of slider-1 -->							
							<div class="events-item text-center">
													
													
												</div>
												
											</div>
											

										</div>
										

									</div>
								</div>
							</section>
			
			<!-- price -->
			<div  class="FAQ">
				<div class="container">
						<div class="tabs-res">
								<input type="radio" name="tabs" id="tabone" checked="checked">
								<label for="tabone">UPCOMING EVENTS</label>
								<div class="taba">
								  <h4>Be The First To know for Our Upcoming Events</h4>
										<div class="row">
										<?php $now = new DateTime();?>
										<?php $now = date("Y-m-d");?>
										<?php foreach ( $eve as $date => $row ): ?>
										<?php $date = $row['tanggal'];?>
											<?php if ($date > $now ) {?>
												<div class="col-md-4">
													<div class="eventtab" id="#event-tab">
														<div class="event-tittle">
															<span class="judul-event"><?= $row['judul'];?></span>
														</div>
														<a href="#"><img class="img-eventtab" src="./AdminCocreative/asset/img/event/<?= $row['gambar'];?>" alt="poster"></a>
														<table class="table-event" style="margin-top: 20px; color: black; font-size: 15px;">
															<tr>
																<td><?= $row['caption1'];?></td>
															</tr>
															<tr>
																<td><?= $row['caption2'];?></td>
															</tr>
															<tr>
																<td><?= $row['caption3'];?></td>
															</tr>
														</table>
													</div>
												</div>
											<?php }?>
										<?php endforeach; ?>
										</div>
								</div>
								
								<input type="radio" name="tabs" id="tabtwo">
								<label for="tabtwo">PAST EVENTS</label>
								<div class="taba">
								  <h4>What You Missed</h4>
									<div class="row">
									<?php $now = new DateTime();?>
										<?php $now = date("Y-m-d");?>
										<?php foreach ( $eve as $date => $row ): ?>
										<?php $date = $row['tanggal'];?>
											<?php if ($date < $now ) {?>
												<div class="col-md-4 col-sm-4 col-lg-4">
													<div class="eventtab" style="margin-bottom:20px; width:100%; height:400px;">
														<div class="event-tittle">
															<span class="judul-event"><?= $row['judul'];?></span>
														</div>
														<a href="#"><img class="img-eventtab" src="./AdminCocreative/asset/img/event/<?= $row['gambar'];?>" alt="poster"></a>
														<div class="ket-event">
															<span><?= $row['caption1'];?></span>
															<span><?= $row['caption2'];?></span>
															<span><?= $row['caption3'];?></span>
														</div>
													</div>
												</div>
											<?php }?>
										<?php endforeach; ?>
									</div>
								</div>
								
								<input type="radio" name="tabs" id="tabthree">
								<label for="tabthree">ALL EVENTS</label>
								<div class="taba">
								<h4></h4>
									<div class="row">
										<?php foreach ( $eve as $i => $row ): ?>
											<?php if ($i >= 0 && $i <= 4) {?>
												<div class="col-md-4 col-sm-4 col-lg-4">
													<div class="eventtab" style="margin-bottom:20px; width:100%; height:400px;">
														<div class="event-tittle">
															<span class="judul-event"><?= $row['judul'];?></span>
														</div>
														<a href="#"><img class="img-eventtab" src="./AdminCocreative/asset/img/event/<?= $row['gambar'];?>" alt="poster"></a>
														<div class="ket-event">
															<span><?= $row['caption1'];?></span>
															<span><?= $row['caption2'];?></span>
															<span><?= $row['caption3'];?></span>
														</div>
													</div>
												</div>
												<?php }?>
										<?php endforeach; ?>
										</div>
								</div>
							  </div>
				</div>
				</div>

			<div id="generic_price_table">   
		<!-- <section id="price">
        <div class="container">
            <div class="row">
            	<div class="sec-title text-center wow animated fadeInDown">
							<h2>Membership & Price</h2>
							<p>Working Space</p>
						</div>
                <div class="col-md-12"> -->
                    <!--PRICE HEADING START-->
                    <!-- <div class="price-heading clearfix">
                    </div> -->
                    <!--//PRICE HEADING END-->
                <!-- </div>
            </div>
        </div> -->
        <!-- <div class="container pricetag"> -->
            
            <!--BLOCK ROW START-->
            <!-- <div class="row"> -->
			<?php foreach ( $mem as $row ): ?>
                <!-- <div class="col-md-3"> -->
                
                	<!--PRICE CONTENT START-->
                    <!-- <div class="generic_content clearfix"> -->
                        
                        <!--HEAD PRICE DETAIL START-->
                        <!-- <div class="generic_head_price clearfix"> -->
                        
                            <!--HEAD CONTENT START-->
                            <!-- <div class="generic_head_content clearfix"> -->
                            
                            	<!--HEAD START-->
                             
                                <!-- <div class="head">
									<span><?= $row['judul']; ?></span>
                                </div> -->
                                <!--//HEAD END-->
                                
                            <!-- </div> -->
                            <!--//HEAD CONTENT END-->
                            
							<!--PRICE START-->
							<!-- <?php if ($row['diskon'] > 0){?>
								<div class="generic_price_tag clearfix">	
									<span class="price">
										<span class="sign">from <?= rupiah($row['hargalama']);?></span><br>
										<span class="currency"><?= rupiah($row['harga']); ?></span>
										<span class="cent"></span> -->
										<!-- <span class="month"> <br> /Hrs</span> -->
									<!-- </span>
								</div> -->
								<!--//PRICE END-->
								
							<!-- <?php } else { ?>
								<div class="generic_price_tag clearfix">	
									<span class="price">
										<span class="sign"></span><br>
										<span class="currency"><?= rupiah($row['harga']); ?></span>
										<span class="cent"></span> -->
										<!-- <span class="month"> <br> /Hrs</span> -->
									<!-- </span>
								</div> -->
								<!--//PRICE END-->
								<!-- <?php } ?>
                        </div>                             -->
                        <!--//HEAD PRICE DETAIL END-->
                        
                        <!--FEATURE LIST START-->
                        <!-- <div class="generic_feature_list">
                        	<ul>
                                <li><?= $row['fitur1']; ?></li>
                                <li><?= $row['fitur2']; ?></li>
                                <li><?= $row['fitur3']; ?></li>                      
                                <li><?= $row['fitur4']; ?></li>
                                <li><?= $row['fitur5']; ?></li>
                                <li><?= $row['fitur6']; ?></li>                      
                                <li><?= $row['fitur7']; ?></li>
                                <li><?= $row['fitur8']; ?></li>
                                <li><?= $row['fitur9']; ?></li>                      
                                <li><?= $row['fitur10']; ?></li>                      
                            </ul>
                        </div> -->
                        <!--//FEATURE LIST END-->
                        
                        <!--BUTTON START-->
                        <!-- <div class="generic_price_btn clearfix">
                        	<a class="" href="">Sign up</a>
                        </div> -->
                        <!--//BUTTON END-->
                        
                    <!-- </div> -->
                    <!--//PRICE CONTENT END-->
                        
				<!-- </div> -->
				<?php endforeach; ?>
            <!--//BLOCK ROW END-->
            
        <!-- </div> -->
        
	<footer>
    	
</div>
			
			<!-- Social section -->
			<section id="social" class="parallax">
				<div class="overlay">
					<div class="container">
						<div class="row">
						
							<div class="sec-title text-center white wow animated fadeInDown">
								<h2>FOLLOW US</h2>
								<p>Our Social Media</p>
							</div>
							
							<ul class="social-button">
								<li class="wow animated zoomIn"><a href="<?= $soc[0]['link']; ?>" target="_blank"><i class="fa fa-thumbs-up fa-2x"></i></a></li>	
								<li class="wow animated zoomIn"><a href="<?= $soc[1]['link']; ?>" target="_blank"><i class="fab fa-instagram fa-2x"></i></a></li>	
								<li class="wow animated zoomIn"><a href="<?= $soc[2]['link']; ?>" target="_blank"><i class="fab fa-twitter-square fa-2x"></i></a></li>			
							</ul>
							
						</div>
					</div>
				</div>
			</section>
			<!-- end Social section -->
			
			<!-- Contact section -->
			<section id="contact" >
				<div class="container">
					<div class="row">
						
						<div class="sec-title text-center wow animated fadeInDown">
							<h2>Contact</h2>
							<p>Leave a Message</p>

						</div>
						
						
						<div class="col-md-7 contact-form wow animated fadeInLeft">
							<form action="" method="post" style="margin: 0 0 30px;">
								<div class="input-field">
									<input type="text" name="name" class="form-control" placeholder="Your Name...">
								</div>
								<div class="input-field">
									<input type="email" name="email" class="form-control" placeholder="Your Email...">
								</div>
								<div class="input-field">
									<input type="text" name="subject" class="form-control" placeholder="Subject...">
								</div>
								<div class="input-field">
									<textarea name="comment" class="form-control" placeholder="Messages..."></textarea>
								</div>
						       	<button type="submit" name="submit" id="submit" class="btn btn-blue btn-effect">Send</button>
							</form>
						</div>
						
						<div class="col-md-5 wow animated fadeInRight">
							<address class="contact-details">
								<h3>Contact Us</h3>
								<h4 style="color: #E78060; padding-bottom: 10px;"><?= $ctc[0]["nama"];?></h4>						
								<p style="padding-right: 170px;"><i class="fa fa-pencil"></i><?= $ctc[0]["alamat"];?></p><br>
								<p><i class="fas fa-mobile-alt"></i><?= $ctc[0]["telepon"];?></p><br>
								<p><i class="fa fa-envelope"></i><?= $ctc[0]["email"];?></p>
							</address>
						</div>
			
					</div>
				</div>
			</section>
			<!-- end Contact section -->
			
			<!-- <section id="google-map">
				<div id="map-canvas" class="wow animated fadeInUp"></div>
			</section> -->

			<div id="googleMap" style="width:100%;height:380px;"></div>
		
		</main>
		
		<footer id="footer">
			<div class="container">
				<div class="row text-center">
					<div class="footer-content">
						<div class="wow animated fadeInDown">
							<p>newsletter signup</p>
							<p>Get Cool Stuff! We hate spam!</p>
						</div>
						<form action="#" method="post" class="subscribe-form wow animated fadeInUp">
							<div class="input-field">
								<input type="email" class="subscribe form-control" placeholder="Enter Your Email...">
								<button type="submit" class="submit-icon">
									<i class="fa fa-paper-plane fa-lg"></i>
								</button>
							</div>
						</form>
						<!-- <div class="footer-social">
							<ul>
								<li class="wow animated zoomIn"><a href="#"><i class="fa fa-thumbs-up fa-3x"></i></a></li>
								<li class="wow animated zoomIn" data-wow-delay="0.3s"><a href="#"><i class="fa fa-twitter fa-3x"></i></a></li>
								<li class="wow animated zoomIn" data-wow-delay="0.6s"><a href="#"><i class="fa fa-skype fa-3x"></i></a></li>
								<li class="wow animated zoomIn" data-wow-delay="0.9s"><a href="#"><i class="fa fa-dribbble fa-3x"></i></a></li>
								<li class="wow animated zoomIn" data-wow-delay="1.2s"><a href="#"><i class="fa fa-youtube fa-3x"></i></a></li>
							</ul>
						</div> -->
						
						<p>Copyright &copy; 2019 Developed by <a href="#">PT.BTI</a>  Original Design by <a href="http://www.themefisher.com">Themefisher</a> 
						</p>
					</div>
				</div>
			</div>
		</footer>

		<!-- Essential jQuery Plugins
		================================================== -->
		<!-- Main jQuery -->
        <script src="js/jquery-1.11.1.min.js"></script>
		<!-- Twitter Bootstrap -->
        <script src="js/bootstrap.min.js"></script>
		<!-- Single Page Nav -->
        <script src="js/jquery.singlePageNav.min.js"></script>
		<!-- jquery.fancybox.pack -->
        <script src="js/jquery.fancybox.pack.js"></script>
		<!-- Google Map API -->
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAnxnh_pgnqVwKiuPKkuATbIFXP14yggOI"></script>

		<!-- <script src="http://maps.google.com/maps/api/js?sensor=false"></script>  -->
		<!-- Owl Carousel -->
        <script src="js/owl.carousel.min.js"></script>
        <!-- jquery easing -->
        <script src="js/jquery.easing.min.js"></script>
        <!-- Fullscreen slider -->
        <script src="js/jquery.slitslider.js"></script>
        <script src="js/jquery.ba-cond.min.js"></script>
		<!-- onscroll animation -->
        <script src="js/wow.min.js"></script>
		<!-- Custom Functions -->
        <script src="js/main.js"></script>
		<script src="https://kit.fontawesome.com/f62a47ce2e.js"></script>
		
		
		<script src="js/swiper.min.js"></script>
    	<script src="js/morphext.min.js"></script> <!-- Morphtext rotating text in the header -->
   	 	<script src="js/scripts.js"></script> <!-- Custom scripts -->


       
    </body>
</html>
