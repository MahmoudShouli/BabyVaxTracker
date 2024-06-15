<!doctype html>
<html class="no-js" lang="zxx">
    <head>

        <!-- Meta Tags -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="keywords" content="Site keywords here">
		<meta name="description" content="">
		<meta name='copyright' content=''>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<!-- Title -->
        <title>Contact Us</title>
		
		<!-- Favicon -->
        <link rel="icon" href="../../Resources/images/favicon.png">
		
		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<!-- Nice Select CSS -->
		<link rel="stylesheet" href="../css/nice-select.css">
		<!-- Font Awesome CSS -->
        <link rel="stylesheet" href="../css/font-awesome.min.css">
		<!-- icofont CSS -->
        <link rel="stylesheet" href="../css/icofont.css">
		<!-- Slicknav -->
		<link rel="stylesheet" href="../css/slicknav.min.css">
		<!-- Owl Carousel CSS -->
        <link rel="stylesheet" href="../css/owl-carousel.css">
		<!-- Datepicker CSS -->
		<link rel="stylesheet" href="../css/datepicker.css">
		<!-- Animate CSS -->
        <link rel="stylesheet" href="../css/animate.min.css">
		<!-- Magnific Popup CSS -->
        <link rel="stylesheet" href="../css/magnific-popup.css">
		
		<!-- Medipro CSS -->
        <link rel="stylesheet" href="../css/normalize.css">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/responsive.css">
		<script src="../js/auto-email-sender.js"></script>
    </head>
    <body>
	
		<!-- Preloader -->
        <div class="preloader">
            <div class="loader">
                <div class="loader-outter"></div>
                <div class="loader-inner"></div>

                <div class="indicator"> 
                    <svg width="16px" height="12px">
                        <polyline id="back" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
                        <polyline id="front" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
                    </svg>
                </div>
            </div>
        </div>
        <!-- End Preloader -->

<?php

session_start();
?>
	
		<!-- Header Area -->
		<header class="header" >
			<!-- Topbar -->
			<div class="topbar">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 col-md-5 col-12">
							<!-- Contact -->
							<ul class="top-link">
							</ul>
							<!-- End Contact -->
						</div>
						<div class="col-lg-6 col-md-7 col-12">
							<!-- Top Contact -->
							<ul class="top-contact">
								<li><i class="fa fa-phone"></i>+0593021843</li>
								<li><i class="fa fa-envelope"></i><a href="mailto:support@yourmail.com">communicraftt@gmail.com</a></li>
							</ul>
							<!-- End Top Contact -->
						</div>
					</div>
				</div>
			</div>
			<!-- End Topbar -->
			<!-- Header Inner -->
			<div class="header-inner">
				<div class="container">
					<div class="inner">
						<div class="row">
							<div class="col-lg-3 col-md-3 col-12">
								<!-- Main Menu -->
								<div class="main-menu">
									<nav class="navigation">
										<ul class="nav menu">
											<li><a href="index.php" style="font-style: italic; font-size: larger; color: blue;">Home</a></li>


										</ul>
									</nav>
								</div>
								<!--/ End Main Menu -->
								<!-- Mobile Nav -->
								<div class="mobile-nav"></div>
								<!-- End Mobile Nav -->
							</div>
							<div class="col-lg-7 col-md-9 col-12">

							</div>
							<div class="col-lg-2 col-12">
								<div class="get-quote">
									<a href="appointment.php" class="btn">Book Appointment</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--/ End Header Inner -->
		</header>
		<!-- End Header Area -->
	
		<!-- Breadcrumbs -->
		<div class="breadcrumbs overlay">
			<div class="container">
				<div class="bread-inner">
					<div class="row">
						<div class="col-12">
							<h2>Contact Us</h2>
							<ul class="bread-list">
								<li><a href="index.php">Home</a></li>
								<li><i class="icofont-simple-right"></i></li>
								<li class="active">Contact Us</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Breadcrumbs -->
				
		<!-- Start Contact Us -->
		<section class="contact-us section">
			<div class="container">
				<div class="inner">
					<div class="row"> 
						<div class="col-lg-6">
							<div class="contact-us-left">
								<!--Start Google-map -->
								<div id="myMap"></div>
								<!--/End Google-map -->
							</div>
						</div>
						<div class="col-lg-6">
							<div class="contact-us-form">
								<h2>Contact With Us</h2>
								<p>If you have any questions please fell free to contact with us.</p>
								<!-- Form -->
								<form class="form" method="post" action="../../BackEnd/php/contact.php">
									<div class="row" style="text-transform: none">

										<div class="col-lg-6">
											<div class="form-group" >
												<input type="email" name="email" placeholder="Email" required="" style="text-transform: none">
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<input type="text" name="subject" placeholder="Subject" required="" style="text-transform: none">
											</div>
										</div>
										<div class="col-lg-12">
											<div class="form-group">
												<textarea name="message" placeholder="Your Message" required="" style="text-transform: none"></textarea>
											</div>
										</div>
										<div class="col-12">
											<div class="form-group login-btn">
												<button class="btn" type="submit" >Send</button>
											</div>
											<p id="msg" style="color: green;display: none">thanks for contacting us!</p>

										</div>
									</div>
								</form>
								<!--/ End Form -->
							</div>
						</div>
					</div>
				</div>
				<div class="contact-info">
					<div class="row">
						<!-- single-info -->
						<div class="col-lg-4 col-12 ">
							<div class="single-info">
								<i class="icofont icofont-ui-call"></i>
								<div class="content">
									<h3>+(970) 5930 21843</h3>
									<p>communicraftt@gmail.com</p>
								</div>
							</div>
						</div>
						<!--/End single-info -->
						<!-- single-info -->
						<div class="col-lg-4 col-12 ">
							<div class="single-info">
								<i class="icofont-google-map"></i>
								<div class="content">
									<h3>Rafidyia Street</h3>
									<p>Nablus, Palestine</p>
								</div>
							</div>
						</div>
						<!--/End single-info -->
						<!-- single-info -->
						<div class="col-lg-4 col-12 ">
							<div class="single-info">
								<i class="icofont icofont-wall-clock"></i>
								<div class="content">
									<h3>Sunday - Thursday: 8am - 4pm</h3>
								</div>
							</div>
						</div>
						<!--/End single-info -->
					</div>
				</div>
			</div>
		</section>
		<!--/ End Contact Us -->

		<!-- Footer Area -->
		<footer id="footer" class="footer ">
			<!-- Footer Top -->
			<div class="footer-top">
				<div class="container">
					<div class="row">
						<div class="col-lg-3 col-md-6 col-12">
							<div class="single-footer">
								<h2>Social Media</h2>
								<!-- Social -->
								<ul class="social">
									<li><a href="#"><i class="icofont-facebook"></i></a></li>
									<li><a href="#"><i class="icofont-instagram"></i></a></li>
									<li><a href="#"><i class="icofont-twitter"></i></a></li>
								</ul>
								<!-- End Social -->
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-12">
							<div class="single-footer f-link">
								<h2>Quick Links</h2>
								<div class="row">
									<div class="col-lg-6 col-md-6 col-12">
										<ul>
											<li><a href="#header"><i class="fa fa-caret-right" aria-hidden="true"></i>Home</a></li>
											<li><a href="#about"><i class="fa fa-caret-right" aria-hidden="true"></i>About Us</a></li>
											<li><a href="#service"><i class="fa fa-caret-right" aria-hidden="true"></i>Services</a></li>
										</ul>
									</div>
									<div class="col-lg-6 col-md-6 col-12">
										<ul>
											<li><a href="#news"><i class="fa fa-caret-right" aria-hidden="true"></i>News</a></li>
											<li><a href="contact_page.php"><i class="fa fa-caret-right" aria-hidden="true"></i>Contact Us</a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-12">
							<div class="single-footer">
								<h2>Open Hours</h2>
								<ul class="time-sidual">
									<li class="day">Sunday-Thursday: <span>8:00am-4:00 pm</span></li>

								</ul>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-12">
							<div class="single-footer">
								<h2>Newsletter</h2>
								<a href ="#newsletter" style="color:white;">subscribe to our newsletter to get all our news in your inbox</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--/ End Footer Top -->
			<!-- Copyright -->
			<div class="copyright">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-12">
							<div class="copyright-content">
								<p>© Copyright 2024  |  All Rights Reserved</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--/ End Copyright -->
		</footer>
		<!--/ End Footer Area -->
		<?php
		if($_SESSION['contact']=='yes') {

					echo '
		<script>
			
				document.getElementById("msg").style.display = "block";
			
		</script>
		';
				}
		?>
		<!-- jquery Min JS -->
        <script src="../js/jquery.min.js"></script>
		<!-- jquery Migrate JS -->
		<script src="../js/jquery-migrate-3.0.0.js"></script>
		<!-- jquery Ui JS -->
		<script src="../js/jquery-ui.min.js"></script>
		<!-- Easing JS -->
        <script src="../js/easing.js"></script>
		<!-- Color JS -->
		<script src="../js/colors.js"></script>
		<!-- Popper JS -->
		<script src="../js/popper.min.js"></script>
		<!-- Bootstrap Datepicker JS -->
		<script src="../js/bootstrap-datepicker.js"></script>
		<!-- Jquery Nav JS -->
        <script src="../js/jquery.nav.js"></script>
		<!-- Slicknav JS -->
		<script src="../js/slicknav.min.js"></script>
		<!-- ScrollUp JS -->
        <script src="../js/jquery.scrollUp.min.js"></script>
		<!-- Niceselect JS -->
		<script src="../js/niceselect.js"></script>
		<!-- Tilt Jquery JS -->
		<script src="../js/tilt.jquery.min.js"></script>
		<!-- Owl Carousel JS -->
        <script src="../js/owl-carousel.js"></script>
		<!-- counterup JS -->
		<script src="../js/jquery.counterup.min.js"></script>
		<!-- Steller JS -->
		<script src="../js/steller.js"></script>
		<!-- Wow JS -->
		<script src="../js/wow.min.js"></script>
		<!-- Magnific Popup JS -->
		<script src="../js/jquery.magnific-popup.min.js"></script>
		<!-- Counter Up CDN JS -->
		<script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
		<!-- Google Map API Key JS -->
		<script src="https://maps.google.com/maps/api/js?key=AIzaSyDGqTyqoPIvYxhn_Sa7ZrK5bENUWhpCo0w"></script>
		<!-- Gmaps JS -->
		<script src="../js/gmaps.min.js"></script>
		<!-- Map Active JS -->
		<script src="../js/map-active.js"></script>
		<!-- Bootstrap JS -->
		<script src="../js/bootstrap.min.js"></script>
		<!-- Main JS -->
		<script src="../js/main.js"></script>
    </body>
</html>