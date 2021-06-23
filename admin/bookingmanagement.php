<?php
	session_start();
	include('../database/dbconnection.php');
	if (!isset($_SESSION['managerauth'])) {
		echo "<script>window.location='../adminlogin.php'</script>";
	}

	$staffid = $_SESSION['staffid'];
	$username = $_SESSION['staffusername'];

	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);


	$getstaffsql = mysqli_query($conn, "Select * from administrator where staffid = '$staffid'");
	$rowgetstaff = mysqli_fetch_assoc($getstaffsql);
	$staffrole = $rowgetstaff['staffrole'];
	$staffname = $rowgetstaff['staffname'];

	$officeid = $rowgetstaff['officeid'];
	$staffphoto = $rowgetstaff['staffphoto'];

	$getofficename = mysqli_query($conn, "Select officename from Office where officeid = '$officeid'");
	$rowgetoffice = mysqli_fetch_assoc($getofficename);
	$officename = $rowgetoffice['officename'];

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Manage Bookings</title>

		<!-- Bootstrap -->
		<link href="../style/bootstrap.min.css" rel="stylesheet">
		<!-- Font Awesome -->
		<link href="../fa/css/font-awesome.min.css" rel="stylesheet">
		<!-- Site Logo -->
		<link href = "../images/design/logoo.jpg" rel="icon" type="image/jpg">

		<link href="../style/datatable.min.css" rel="stylesheet">

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
						<div class="page-title">
							<div class="title_left">
								<h3>All Bookings from the <?php echo $officename; ?> Office</h3>
							</div>
						</div>

						<div class="clearfix"></div>

						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="x_panel">
								<?php
									$getallBookingsql = mysqli_query($conn, "SELECT * FROM Bookings where officeid = '$officeid' ORDER BY confirmstatus DESC");
								?>
									<div class="x_content">
					                    <table id="datatable-fixed-header" class="table table-striped table-bordered">
											<thead>
												<tr>
													<td>Customer Name</td>
													<td>Pickup Time</td>
													<td>Return Time</td>
													<td>Pickup Location</td>
													<td>Return Location</td>
													<td>Car Name</td>
													<td>Driver Name</td>
													<td>Payment Method</td>
													<td>Total Cost</td>
													<td>Confirmation</td>
													<td>View Details</td>
												</tr>
											</thead>
											<tbody>
												<?php
													while ($rowgetallBookings = mysqli_fetch_assoc($getallBookingsql)) {
												?>
												<tr>
													<td>
														<?php
															$customerid = $rowgetallBookings['customerid']; 
															$getcusname = mysqli_query($conn, "select customername from users where customerid = '$customerid'");
															$rowcusname = mysqli_fetch_assoc($getcusname);
															echo $rowcusname['customername'];
														?>
													</td>
													<td><?php echo $rowgetallBookings['pickuptime']; ?></td>
													<td><?php echo $rowgetallBookings['returntime']; ?></td>
													<td><?php echo $rowgetallBookings['pickuplocation']; ?></td>
													<td><?php echo $rowgetallBookings['returnlocation']; ?></td>
													<td>
														<?php
															$carid = $rowgetallBookings['carid']; 
															$getcarname = mysqli_query($conn, "select carname from Cars, OfficeCars  where cars.carno = OfficeCars.carno AND OfficeCars.carid = '$carid'");
															$rowcarname = mysqli_fetch_assoc($getcarname);
															echo $rowcarname['carname'];
														?>
													</td>
													<td>
														<?php
															$driverid = $rowgetallBookings['driverid']; 
															$getdrivername = mysqli_query($conn, "select drivername from Drivers where driverid = '$driverid'");
															$rowdrivername = mysqli_fetch_assoc($getdrivername);
															echo $rowdrivername['drivername'];
														?>
													</td>
													<td><?php echo $rowgetallBookings['paymentmethod']; ?></td>
													<td>£ <?php echo $rowgetallBookings['totalcost']; ?></td>
													<td><?php echo $rowgetallBookings['confirmstatus']; ?></td>
													<td>
														<a href="bookingdetail.php?bookingid=<?php echo $rowgetallBookings['bookingid']; ?>"><button class="btn btn-round btn-info btn-sm">View Details</button></a>
													</td>
												</tr>
												<?php
													}
												?>
												
											</tbody>
					                    </table>

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
		<!-- DataTable -->
		<script src="../javascripts/datatable.min.js"></script>
		
		<!-- Custom Theme Scripts -->
		<script src="../javascripts/custom.min.js"></script>
		<!-- SweetAlert -->
		<script src="../javascripts/sweetalert-dev.js"></script>
	</body>
</html>
