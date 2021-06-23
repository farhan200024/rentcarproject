
<?php
	if (!isset($_GET['driverid'])) {
		echo "<script>window.location='mdashboard.php'</script>";
	}
	session_start();
	include('../database/dbconnection.php');
	if (!$_SESSION['managerauth']) {
		echo "<script>window.location='../adminlogin.php'</script>";
	}

	$staffid = $_SESSION['staffid'];
	$username = $_SESSION['staffusername'];

	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	$getstaffsql = mysqli_query($conn, "Select * from administrator where staffid = '$staffid'");
	$rowgetstaff = mysqli_fetch_assoc($getstaffsql);
	$staffname = $rowgetstaff['staffname'];
	$staffphoto = $rowgetstaff['staffphoto'];
	$officeid = $rowgetstaff['officeid'];

	$driverid = $_GET['driverid'];
	$getdriversql = mysqli_query($conn, "Select * from Drivers where driverid = '$driverid'");
	$rowgetdriver = mysqli_fetch_assoc($getdriversql);

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Driver Edit</title>

		<!-- Bootstrap -->
		<link href="../style/bootstrap.min.css" rel="stylesheet">
		<!-- Font Awesome -->
		<link href="../fa/css/font-awesome.min.css" rel="stylesheet">
		<!-- Logo -->
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
								<h3>Edit Driver</h3>
							</div>
							<div class="pull-right"><a href="drivermanagement.php"><i class="fa fa-close"></i></a></div>
						</div>

						<div class="clearfix"></div>

						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="x_panel">
								<form method="post" class="form-horizontal form-label-left" enctype="multipart/form-data">

									<div class="profile_img">
										<div id="crop-avatar">
										<!-- Current avatar -->
											<img class="img-circle avatar-view center-block" width="200px" height="200px" src="../images/driverphoto/<?php echo $rowgetdriver['driverphoto']; ?>" alt="Avatar"><br>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="driverphoto">Change Photo
										</label>
										
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="file" name="driverphoto" class="form-control col-md-7 col-xs-12">
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="driverusername">Driver Username <span class="required">*</span>
										</label>
										
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" name="driverusername" value="<?php echo $rowgetdriver['driverusername']; ?>" readonly required="required" class="form-control col-md-7 col-xs-12">
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="drivername">Driver Name <span class="required">*</span>
										</label>

										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" name="drivername" required="required" value="<?php echo $rowgetdriver['drivername']; ?>" class="form-control col-md-7 col-xs-12">
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="driveremail">Driver Email <span class="required">*</span>
										</label>
										
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" name="driveremail" value="<?php echo $rowgetdriver['driveremail']; ?>" required="required" class="form-control col-md-7 col-xs-12">
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="drivercost">Driver Cost <span class="required">*</span>
										</label>
										
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" name="drivercost" value="<?php echo $rowgetdriver['drivercost']; ?>" required="required" class="form-control col-md-7 col-xs-12">
										</div>
									</div>

									<div class="ln_solid"></div>

									<div class="form-group">
										<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
											<input type="submit" name="submit" value="Submit" class="btn btn-success">
											
											<input type="reset" name="reset" value="Reset" class="btn btn-primary">
											<a href="drivermanagement.php"><button class="btn btn-danger" type="button">Cancel</button></a>
										</div>
									</div>

								</form>
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

		<?php
			
			if (isset($_POST['submit'])):
				$drivername = $_POST['drivername'];
				$driveremail = $_POST['driveremail'];
				$drivercost = $_POST['drivercost'];
				//$driverstatus = $_POST['driverstatus'];
				$driverphoto = $_FILES['driverphoto']['name'];
				$tmp = $_FILES['driverphoto']['tmp_name'];

				if ($driverphoto) {
					$allowfiletype =  array('GIF','PNG' ,'JPG', 'gif', 'png', 'jpg');
					$ext = end((explode(".", $driverphoto)));
					if(!in_array($ext, $allowfiletype) ) {
					    echo "<script>swal({
					    title: 'Oops!',
					    text: 'Only Image Files (gif, png, jpg) are allowed!',
					    type: 'error',
					    timer: 1800,
					    showConfirmButton: false
					    });</script>";
					}
					else{
					move_uploaded_file($tmp, "../images/driverphoto/$driverphoto");

					$updatedriversql = mysqli_query($conn, "update Drivers set drivername ='$drivername', driveremail ='$driveremail', drivercost ='$drivercost', driverphoto='$driverphoto' where driverid = '$driverid'")or die(mysqli_error());
						echo "<script>swal({
						title: 'Success!',
						text: 'Driver Information has been updated!',
						type: 'success',
						timer: 1800,
						showConfirmButton: false
						}, function(){
						window.location.href = 'drivermanagement.php';
						});</script>";
					}
				}
				else{
					$updatedriversql = mysqli_query($conn, "update Drivers set drivername ='$drivername', driveremail ='$driveremail', drivercost ='$drivercost' where driverid = '$driverid'")or die(mysqli_error());
						echo "<script>swal({
						title: 'Success!',
						text: 'Driver Information has been updated!',
						type: 'success',
						timer: 1800,
						showConfirmButton: false
						}, function(){
						window.location.href = 'drivermanagement.php';
						});</script>";
				}
			endif;
		?>
	</body>
</html>
