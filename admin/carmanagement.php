<?php
	session_start();
	include('../database/dbconnection.php');
	if (!$_SESSION['managerauth']) {
		echo "<script>window.location='../adminlogin.php'</script>";
	}

	$staffid = $_SESSION['staffid'];
	$username = $_SESSION['staffusername'];

	//$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	$getstaffsql = mysqli_query($conn, "Select * from administrator where staffid = '$staffid'");
	$rowgetstaff = mysqli_fetch_assoc($getstaffsql);
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

		<title>Manage Cars</title>

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
							include ('includes/_sidebarmenu.php');
						?>
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
								<h3>All cars from the <?php echo $officename; ?> Office</h3>
							</div>
						</div>

						<div class="clearfix"></div>

						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="x_panel">
								<?php
									$getallcarsql = mysqli_query($conn, "SELECT Cars.*, Officecars.* FROM Cars, OfficeCars WHERE Cars.carno = OfficeCars.carno AND OfficeCars.officeid = '$officeid'");
								?>
									<div class="x_content">
					                    <table id="datatable-fixed-header" class="table table-responsive table-striped table-bordered">
											<thead>
												<tr>
													<td>Name</td>
													<td>Transmission</td>
													<td>Type</td>
													<td>Capacity</td>
													<td>Airbag</td>
													<td>Rating</td>
													<td>Description</td>
													<td>Cost</td>
													<td>Edit</td>
													<td>Delete</td>
												</tr>
											</thead>
											<tbody>
												<?php
													while ($rowgetallcars = mysqli_fetch_assoc($getallcarsql)) {
												?>
												<tr>
													<td><?php echo $rowgetallcars['carname']; ?></td>
													<td><?php echo $rowgetallcars['cartransmission']; ?></td>
													<td><?php echo $rowgetallcars['cartype']; ?></td>
													<td><?php echo $rowgetallcars['carcapacity']; ?></td>
													<td><?php echo $rowgetallcars['carairbag']; ?></td>
													<td><?php echo $rowgetallcars['carrating']; ?></td>
													<td><?php echo $rowgetallcars['carotherdescription']; ?></td>
													<td>£ <?php echo $rowgetallcars['carcost']; ?></td>
													<td>
														<a href="caredit.php?carid=<?php echo $rowgetallcars['carid']; ?>"><button class="btn btn-round btn-primary btn-sm">Edit</button></a></td><td>
														<a href="cardelete.php?carid=<?php echo $rowgetallcars['carid']; ?>"><button class="btn btn-round btn-danger btn-sm">Delete</button></a>
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