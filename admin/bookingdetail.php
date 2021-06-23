<?php	
	session_start();
	
	if (!isset($_GET['bookingid'])) {
		echo "<script>window.location='mdashboard.php'</script>";
	}

	include('../database/dbconnection.php');

	if (!isset($_SESSION['managerauth'])) {
		echo "<script>window.location='../adminlogin.php'</script>";
	}

	$staffid = $_SESSION['staffid'];
	$username = $_SESSION['staffusername'];

	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);


	$getstaffsql = mysqli_query($conn, "Select * from administrator where staffid = '$staffid'");
	$rowgetstaff = mysqli_fetch_assoc($getstaffsql);
	$staffname = $rowgetstaff['staffname'];
	$staffrole = $rowgetstaff['staffrole'];
	$staffphoto = $rowgetstaff['staffphoto'];
	$officeid = $rowgetstaff['officeid'];

	$getofficename = mysqli_query($conn, "Select officename from Office where officeid = '$officeid'");
	$rowgetoffice = mysqli_fetch_assoc($getofficename);
	$officename = $rowgetoffice['officename'];

	$bookingid = $_GET['bookingid'];
	$getbooking = mysqli_query($conn, "SELECT * from Bookings where bookingid = '$bookingid'");
	$rowgetbooking = mysqli_fetch_assoc($getbooking);
	$totalcost = $rowgetbooking['totalcost'];

	$customerid = $rowgetbooking['customerid'];
	$getcustomer = mysqli_query($conn, "SELECT * FROM users where customerid = '$customerid'");
	$rowgetcustomerdetail = mysqli_fetch_assoc($getcustomer);

	$carid = $rowgetbooking['carid'];
	$getcar = mysqli_query($conn, "SELECT * FROM Cars, OfficeCars where Cars.carno = OfficeCars.carno AND OfficeCars.carid = '$carid'");
	$rowgetcar = mysqli_fetch_assoc($getcar);

	$driverid = $rowgetbooking['driverid'];
	

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Reserve Details</title>

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
							<a href="#" class="site_title"><i class="fa fa-rocket"></i><span>Rent Cars</span></a>
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
							include ("includes/_sidebarmenu.php");
						?>
						<!-- sidebar menu -->
					</div>
				</div>

				<!-- top navigation -->
						<?php
							include('includes/_navigationbar.php');
						?>
				<!-- /top navigation -->

				<!-- page content -->
		<div class="right_col" role="main">
		  <div class="">

			<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Booking Details of <?php echo $bookingid." from " .$officename ." Office"; ?></h2>
						<a href="bookingmanagement.php" class="pull-right"><i class="fa fa-close"></i></a>
						<?php if ($rowgetbooking['confirmstatus'] == 'pending'):?>
						<ul class="nav navbar-right panel_toolbox">
							<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
							</li>


							<li>
							<a href="bookingaccept.php?bookingid=<?php echo $bookingid;?>" role="button" class="btn btn-success"><i class="fa fa-wrench"> Accept</i></a>
							</li>

							<li>
							<a href="bookingdecline.php?bookingid=<?php echo $bookingid;?>" role="button" class="btn btn-danger"><i class="fa fa-wrench"> Decline</i></a>
							</li>

						</ul>
						<?php endif; ?>
						<div class="clearfix"></div>
					</div>

					<div class="x_content">
						<div class="col-md-3 col-sm-3 col-xs-12 profile_left">
							<h3><i class="fa fa-info"></i> Booking Detail</h4>

							<ul class="list-unstyled user_data">
								<li><i class="fa fa-home user-profile-icon"></i> Pickup from <?php echo $rowgetbooking['pickuplocation']; ?>
								</li>

								<li>
									<i class="fa fa-map-marker user-profile-icon"></i> Return to <?php echo $rowgetbooking['returnlocation']; ?>
								</li>

								<li><i class="fa fa-clock-o user-profile-icon"></i> From <?php echo $rowgetbooking['pickuptime']; ?>
								</li>
								
								<li><i class="fa fa-clock-o user-profile-icon"></i> to <?php echo $rowgetbooking['returntime']; ?>
								</li>
							</ul>
							<hr>

							<?php
							if ($driverid == 'nodriver'): ?>
								</div>
								<div class="col-md-3 col-sm-3 col-xs-12 profile_left">
							<?php endif; ?>


							<h3><i class="fa fa-user"></i> Customer Detail</h3>
							<div class="profile_img">
								<div id="crop-avatar">
								<!-- Current avatar -->
									<img class="img-circle avatar-view"  width="200px" height="200px" src="../images/customerphoto/<?php echo $rowgetcustomerdetail['customerphoto']; ?>" alt="Avatar">
								</div>
							</div>
							<h4><i class="fa fa-user user-profile-icon"></i> <?php echo $rowgetcustomerdetail['customername']; ?></h4>

							<ul class="list-unstyled user_data">
								<li><i class="fa fa-user-circle-o user-profile-icon"></i> <?php echo $rowgetcustomerdetail['customerusername']; ?>
								</li>

								<li>
								<i class="fa fa-envelope user-profile-icon"></i> <?php echo $rowgetcustomerdetail['customeremail']; ?>
								</li>

								<li>
								<i class="fa fa-male user-profile-icon"></i> <?php echo $rowgetcustomerdetail['customergender']; ?>
								</li>

								<li>
								<i class="fa fa-calendar user-profile-icon"></i> <?php echo $rowgetcustomerdetail['customerdob']; ?>
								</li>
							</ul>

							<?php
							if ($driverid == 'nodriver'): ?>
								</div>
								<div>
							<?php endif; ?>

						</div>

						<div class="col-md-3 col-sm-3 col-xs-12 profile_left">
							<h3 align="center"><i class="fa fa-car"></i> Car Detail</h3>
							<div class="profile_img">
								<div id="crop-avatar">
								<!-- Current avatar -->
									<img class="img-responsive img-circle avatar-view"  src="../images/carphoto/<?php echo $rowgetcar['carphoto']; ?>" alt="Avatar">
								</div>
							</div>
							<h4><i class="fa fa-car user-profile-icon"></i> <?php echo $rowgetcar['carname']; ?></h4>

							<ul class="list-unstyled user_data">
								<li>
									<i class="fa fa-bus user-profile-icon"></i> <?php echo $rowgetcar['carclass']; ?>
								</li>

								<li><i class="fa fa-cog user-profile-icon"></i> <?php echo $rowgetcar['cartransmission']; ?>
								</li>
								
								<li><i class="fa fa-car user-profile-icon"></i> <?php echo $rowgetcar['cartype']; ?>
								</li>
								
								<li id="passengerqty"><i class="fa fa-users user-profile-icon"></i> <?php echo $rowgetcar['carcapacity']; ?> Persons
								</li>
								
								<li><i class="fa fa-bolt user-profile-icon"></i> <?php echo $rowgetcar['carairbag'];  ?> Air Bags
								</li>
								
								<li><i class="fa fa-info user-profile-icon"></i> <?php echo $rowgetcar['carotherdescription'];  ?> Included
								</li>
								
								<li><i class="fa fa-star user-profile-icon"></i> <?php echo $rowgetcar['carrating'];  ?> Stars
								</li>
								
								<li><i class="fa fa-money user-profile-icon"></i> £ <?php echo $rowgetcar['carcost'];  ?> per Six Hours
								</li>
							</ul>
						</div>


						<?php

							if ($driverid == 'nodriver'):
							else:
								$getdriver = mysqli_query($conn, "select * from Drivers where driverid = '$driverid'");
								$rowgetdriver = mysqli_fetch_assoc($getdriver);

						?>
						<div class="col-md-3 col-sm-3 col-xs-12 profile_left">
								<h3 align="center"><i class="fa fa-male"></i> Driver Detail</h3>
								<div class="profile_img">
									<div id="crop-avatar">
									<!-- Current avatar -->
										<img class="img-responsive img-circle avatar-view"  src="../images/driverphoto/<?php echo $rowgetdriver['driverphoto']; ?>" alt="Avatar">
									</div>
								</div>
								<h4><?php echo $rowgetdriver['drivername']; ?></h4>

								<ul class="list-unstyled user_data">
									<li><i class="fa fa-user-circle-o user-profile-icon"></i> <?php echo $rowgetdriver['driverusername']; ?>
									</li>

									<li>
									<i class="fa fa-envelope user-profile-icon"></i> <?php echo $rowgetdriver['driveremail']; ?>
									</li>

									<li>
									<i class="fa fa-male user-profile-icon"></i> <?php echo $rowgetdriver['drivergender']; ?>
									</li>

									<li>
									<i class="fa fa-drivers-license-o user-profile-icon">Age:</i> <?php echo $rowgetdriver['driverage']; ?>
									</li>

									<li>
									<i class="fa fa-money user-profile-icon"></i> £ <?php echo $rowgetdriver['drivercost']; ?> per Hour
									</li>

									<li>
									<i class="fa fa-star user-profile-icon"></i> <?php echo $rowgetdriver['driverrating']; ?> Stars
									</li>
								</ul>
								<hr>
						</div>
						<?php
							endif;
						?>

						<div class="col-md-3 col-sm-3 col-xs-12 profile_left">
							<h3 align="center"><i class="fa fa-money"></i> Payment</h3>

							<ul class="list-unstyled user_data">
								<li>
								<i class="fa fa-clock-o user-profile-icon"></i> Hire Time :  <?php $durationinhours = $rowgetbooking['durationinhours']; echo $durationinhours;?> Hours
								</li>
								<li>
								<i class="fa fa-credit-card user-profile-icon"></i> Payment Method :  <?php echo $rowgetbooking['paymentmethod'];?> 
								</li>
							</ul>

							<table class="table">
								<thead>
									<tr>
										<td>Title</td>
										<td>Detail</td>
										<td>Unit Price</td>
										<td>Price</td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><i class="fa fa-car"></i></td>
										<td><?php echo $rowgetcar['carname']; ?></td>
										<td>£ <?php echo $rowgetcar['carcost']; ?> per six hours</td>
										<td>£ <?php echo floor($rowgetcar['carcost']*($durationinhours/6)); ?></td>
									</tr>

									<?php if ($rowgetbooking['driverid'] == 'nodriver'): ?>
									<?php else: ?>
									<tr>
										<td><i class="fa fa-male"></i> </td>
										<td><?php echo $rowgetdriver['drivername']; ?></td>
										<td>£<?php echo $rowgetdriver['drivercost']; ?> per day</td>
										<td>£<?php echo floor($rowgetdriver['drivercost']*($durationinhours/24)); ?></td>
									</tr>
									<?php endif ?>
									<tr>
										<td colspan="3"><i class="fa fa-money"></i> Total Cost</td>
										<td>£<?php echo $totalcost; ?></td>
									</tr>
								</tbody>
							</table>
						</div>

					</div>
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

		<script>
			
		</script>
	</body>
</html>
