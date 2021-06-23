<?php
	session_start();
	include('../database/dbconnection.php');
	if (!$_SESSION['managerauth']) {
		echo "<script>window.location='../adminlogin.php'</script>";
	}


	$staffid = $_SESSION['staffid'];
	$username = $_SESSION['staffusername'];

	$getstaffsql = mysqli_query($conn, "Select * from administrator where staffid = '$staffid'");
	$rowgetstaff = mysqli_fetch_assoc($getstaffsql);
	$staffname = $rowgetstaff['staffname'];
	$officeid = $rowgetstaff['officeid'];

	$staffphoto = $rowgetstaff['staffphoto'];

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title> Admin Panel</title>

		<!-- Bootstrap -->
		<link href="../style/bootstrap.min.css" rel="stylesheet">
		<!-- Font Awesome -->
		<link href="../fa/css/font-awesome.min.css" rel="stylesheet">
		<!-- Site Logo -->
		<link href = "../images/design/logoo.jpg" rel="icon" type="image/jpg">

		<!-- Custom Theme Style -->
		<link href="../style/custom.min.css" rel="stylesheet">
		<link href="../style/customstyle.css" rel="stylesheet">
		<!-- Sweet Alert -->
		<link rel="stylesheet" href="../style/sweetalert.css">
	</head>

	<body class="nav-md">
		<div class="container body">
			<div class="main_container">
				<div class="col-md-3 left_col">
					<div class="left_col scroll-view">
						<div class="navbar nav_title" style="border: 0;">
							<a href="mdashboard.php" class="site_title"><i class="fa fa-rocket"></i><span>Rent Cars</span></a>
						</div>

						<div class="clearfix"></div>

						<!-- menu profile quick info -->
						<div class="profile clearfix">
							<div class="profile_pic">
								<img src="../images/staffphoto/<?php echo $staffphoto; ?>" alt="..." class="img-circle profile_img">
							</div>
							<div class="profile_info">
								<span>Welcome,</span>
								<h2><?php echo $staffname; ?></h2>
							</div>
							<div class="clearfix"></div>
						</div>
						<!-- /menu profile quick info -->

						<br />

						<!-- sidebar menu -->
						<?php
              include "../admin/includes/_sidebarmenu.php";

						?>
					</div>
				</div>

				<!-- top navigation -->
						<?php
							//include('misc/_navigationbar.php');
              include "../admin/includes/_navigationbar.php";

						?>
				<!-- /top navigation -->

				<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="row top_tiles">
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><!-- <i class="fa fa-caret-square-o-right" style="color: #26B99A;"></i> --></div>
                  <?php

                  $totalbookingsql = mysqli_query($conn, "select count(bookingid) as countbooking from bookings where month(bookingtime) = month(now())") or die(mysql_error());
                  $totalbookingnumrow = mysqli_num_rows($totalbookingsql);
                  if ($totalbookingnumrow < 0) {
                  	$newbooking = 0;
                  }
                  else {
	                  $countrow = mysqli_fetch_assoc($totalbookingsql);
	                  $newbooking = $countrow['countbooking'];
                  }
                  ?>
                  <div class="count"><?php echo $newbooking; ?></div>
                  <h3>New Bookings</h3>
                  <p>You have <?php echo $newbooking; ?> bookings in this month!</p>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"></div>
                  <?php
                  $totalcarratingsql = mysqli_query($conn, "select count(carno) as countcarrating from ratingscar where month(ratingtime) = month(now())") or die(mysql_error());
                  $totalcarratingnumrow = mysqli_num_rows($totalcarratingsql);
                  if ($totalcarratingnumrow < 0) {
                  	$newcarrating = 0;
                  }
                  else {
	                  $countrow = mysqli_fetch_assoc($totalcarratingsql);
	                  $newcarrating = $countrow['countcarrating'];
                  }
                  ?>
                  <div class="count"><?php echo $newcarrating; ?></div>
                  <h3>New Car Reviews</h3>
                  <p>You have <?php echo $newcarrating; ?> car reviews in this month!</p>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><!-- <i class="fa fa-sort-amount-asc" style="color: #9B59B6;"></i> --></div>
                  <div class="count" id="newnoti"><?php echo $noti; ?></div>
                  <h3>New Notifications</h3>
                  <p>You have new nofications!</p>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><!-- <i class="fa fa-check-square-o" style="color: #F7C7C2;"></i> --></div>
                  <?php
                  $totalsignupsql = mysqli_query($conn, "select count(customerid) as countsignup from users where month(signuptime) = month(now())") or die(mysql_error());
                  $totalsignupnumrow = mysqli_num_rows($totalsignupsql);
                  if ($totalsignupnumrow < 0) {
                  	$newsignup = 0;
                  }
                  else {
	                  $countrow = mysqli_fetch_assoc($totalsignupsql);
	                  $newsignup = $countrow['countsignup'];
                  }
                  ?>
                  <div class="count" id="newsignup"><?php echo $newsignup; ?></div>
                  <h3>New Sign ups</h3>
                  <p>New Customers in this month!</p>
                </div>
              </div>
            </div>
          </div>
        </div>
				<!-- /page content -->

				<!-- footer content -->
				<footer>
					<div class="pull-right">
						Online Car Rental
					</div>
					<div class="clearfix"></div>
				</footer>
				<!-- /footer content -->
			</div>
		</div>

		<!-- jQuery -->
		<script src="../javascripts/jquery.min.js"></script>
		<!-- Bootstrap -->
		<script src="../javascripts/bootstrap.min.js"></script>
		<!-- FastClick -->
		<script src="../javascripts/fastclick.js"></script>
		
		<!-- Custom Theme Scripts -->
		<script src="../javascripts/custom.min.js"></script>
		<!-- SweetAlert -->
		<script src="../javascripts/sweetalert-dev.js"></script>
	</body>
</html>
