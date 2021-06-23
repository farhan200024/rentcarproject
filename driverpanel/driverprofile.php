<?php
	session_start();
	include('../database/dbconnection.php');
	if (!$_SESSION['driverauth']) {
		echo "<script>window.location='../driverlogin.php'</script>";
	}

	$driverid = $_SESSION['driverid'];
	$driverusername = $_SESSION['driverusername'];

	$getdriversql = mysqli_query($conn,"Select * from drivers where driverid = '$driverid'");
	$rowgetdriver = mysqli_fetch_assoc($getdriversql);
	$drivername = $rowgetdriver['drivername'];
	$officeid = $rowgetdriver['officeid'];
	$driverphoto = $rowgetdriver['driverphoto'];

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Edit your Profile</title>

		<!-- Bootstrap -->
		<link href="../style/bootstrap.min.css" rel="stylesheet">
		<!-- Font Awesome -->
		<link href="../fa/css/font-awesome.min.css" rel="stylesheet">
		<!-- Site Logo -->
		<link href = "../images/design/logoo.jpg" rel="icon" type="image/jpg">
		<!-- Font Awesome -->
		<link href="../style/chosen.min.css" rel="stylesheet">

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
							<a href="ddashboard.php" class="site_title"><i class="fa fa-rocket"></i> 
								<span>Rent Cars</span>
							</a>
						</div>

						<div class="clearfix"></div>

						<!-- menu profile quick info -->
						<div class="profile clearfix">
							<div class="profile_pic">
								<img src="../images/driverphoto/<?php echo $driverphoto; ?>" alt="..." class="img-circle profile_img">
							</div>
							<div class="profile_info">
								<span>Welcome,</span>
								<h2><?php echo $drivername; ?></h2>
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
								<h3>Edit Profile</h3>
							</div>
						</div>

						<div class="clearfix"></div>

						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
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
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="driverusername">Driver Username
										</label>
										
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" required="required" readonly value="<?php echo $rowgetdriver['driverusername'] ?>" name="driverusername" class="form-control col-md-7 col-xs-12">
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="drivername">Driver Name
										</label>
										
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" required="required" value="<?php echo $rowgetdriver['drivername'] ?>" name="drivername" class="form-control col-md-7 col-xs-12">
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="driveremail">Driver Email
										</label>
										
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="email" required="required" value="<?php echo $rowgetdriver['driveremail'] ?>" name="driveremail" class="form-control col-md-7 col-xs-12">
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="driverage">Driver Age
										</label>
										
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" required="required" value="<?php echo $rowgetdriver['driverage'] ?>" name="driverage" class="form-control col-md-7 col-xs-12">
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="driverexperience">Driver Experience
										</label>
										
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" required="required" value="<?php echo $rowgetdriver['driverexperience'] ?>" name="driverexperience" class="form-control col-md-7 col-xs-12">
										</div>
									</div>

									<div class="ln_solid"></div>

									<div class="form-group">
										<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
											<input type="submit" name="submit" value="Submit" class="btn btn-success">
											<input type="reset" name="reset" value="Reset" class="btn btn-primary">
											<a href="ddashboard.php"><button class="btn btn-danger" type="button">Cancel</button></a>
										</div>
									</div>

								</form>

							</div>
						</div>
					</div>
				</div>
				<!-- /page content -->

				<!-- footer content -->
				<footer>
					<div class="pull-right">
						Online Car rental  
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
		<!-- FastClick -->
		<script src="../javascripts/chosen.jquery.min.js"></script>
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
			$driverage = $_POST['driverage'];
			$driverexperience = $_POST['driverexperience'];

			$driverphoto = $_FILES['driverphoto']['name'];
			$tmp = $_FILES['driverphoto']['tmp_name'];

			if($driverphoto) {
					$allowfiletype =  array('GIF','PNG' ,'JPG', 'gif', 'png', 'jpg');
					$ext = end((explode(".", $driverphoto)));
					if(!in_array($ext, $allowfiletype) ) {
					    echo "<script>swal({
					    title: 'Oops!',
					    text: 'Only Image Files (gif, png, jpg) are allowed!',
					    type: 'error',
					    timer: 1000,
					    showConfirmButton: false
					    }, function(){
					    window.location.href = 'driverprofile.php';
					    });</script>";
					}
					else{
						move_uploaded_file($tmp, "../images/driverphoto/$driverphoto");
						$updatedriverinfosql = mysqli_query($conn,"update drivers set drivername = '$drivername', driveremail = '$driveremail', driverphoto = '$driverphoto', driverage = '$driverage', driverexperience = '$driverexperience' where driverid = '$driverid'") or die(mysqli_error($conn));
						echo "<script>swal({
						title: 'Success!',
						text: 'Your driver information has been updated!',
						type: 'success',
						timer: 1000,
						showConfirmButton: false
						}, function(){
						window.location.href = 'ddashboard.php';
						});</script>";
				}
			}
			else {
				$updatedriverinfosql = mysqli_query($conn,"update drivers set drivername = '$drivername', driveremail = '$driveremail', driverage = '$driverage', driverexperience = '$driverexperience' where driverid = '$driverid'") or die(mysqli_error($conn));
				echo "<script>swal({
				title: 'Success!',
				text: 'Your driver information has been updated!',
				type: 'success',
				timer: 1000,
				showConfirmButton: false
				}, function(){
				window.location.href = 'ddashboard.php';
				});</script>";
			}
		endif;
		?>
	</body>
</html>
