<?php	
	if (!isset($_GET['carid'])) {
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

	$editcarid = $_GET['carid'];
	$geteditcarsql = mysqli_query($conn, "SELECT Cars.*, Officecars.* FROM Cars, OfficeCars WHERE Cars.carno = OfficeCars.carno AND OfficeCars.carid = '$editcarid'");
	$rowgeteditcar = mysqli_fetch_assoc($geteditcarsql);

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Edit the Car</title>

		<!-- Bootstrap -->
		<link href="../style/bootstrap.min.css" rel="stylesheet">
		<!-- Font Awesome -->
		<link href="../fa/css/font-awesome.min.css" rel="stylesheet">
		<!-- Site Logo -->
		<link href = "../images/design/logoo.jpg" rel="icon" type="image/jpg">

		<!-- Custom Theme Style -->
		<link href="../style/custom.min.css" rel="stylesheet">
		<link href="../style/customstyle.css" rel="stylesheet">
		<!-- Sweet Alert 
		<link rel="stylesheet" href="../style/sweetalert.css">
		 Sweet Alert 
		<link rel="stylesheet" href="../style/sweetalert.css"> -->
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
								<h3>Edit Car</h3>
							</div>
							<div class="pull-right"><a href="carmanagement.php"><i class="fa fa-close"></i></a></div>
						</div>

						<div class="clearfix"></div>

						<div class="row">
							<div class="x_panel">

							<div class="col-md-12 col-sm-12 col-xs-12">
								<h4>Edit Car Detail</h4>
								<form method="post" class="form-horizontal form-label-left" enctype="multipart/form-data">
									<div class="profile_img">
										<div id="crop-avatar">
										<!-- Current avatar -->
											<img class="img-circle center-block avatar-view" width="300" src="../images/carphoto/<?php echo $rowgeteditcar['carphoto']; ?>" alt="Avatar">
										</div>
									</div>

									<div class="form-group">

										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="carno">Car No <span class="required">*</span>
										</label>

										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" name="carno" required="required" readonly value="<?php echo $rowgeteditcar['carno']; ?>" class="form-control col-md-7 col-xs-12">
										</div>
									</div>

									<div class="form-group">

										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="carphoto">Car Photo
										</label>

										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="file" name="carphoto" class="form-control col-md-7 col-xs-12">
										</div>

									</div>

									<div class="form-group">

										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="carname">Car Name <span class="required">*</span>
										</label>

										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" name="carname" required="required" value="<?php echo $rowgeteditcar['carname']; ?>" class="form-control col-md-7 col-xs-12">
										</div>

									</div>

									<div class="form-group">
										<label for="cartype" class="control-label col-md-3 col-sm-3 col-xs-12">Car Type</label>

										<div class="col-md-6 col-sm-6 col-xs-12">
											<select name="cartype" class="form-control">
											<?php
												$cartype = array("Economy", "Premium", "Sporty", "SUV", "Luxury");
												foreach ($cartype as $value) {
													$selected = '';
													if ($value == $rowgeteditcar['cartype']) {
														$selected = 'selected';
													}
											?>
												<option <?php echo $selected; ?> value="<?php echo $value; ?>"><?php echo $value; ?></option>
											<?php
												}
											?>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label for="cartransmission" class="control-label col-md-3 col-sm-3 col-xs-12">Car Transmission</label>

										<div class="col-md-6 col-sm-6 col-xs-12">
											<select name="cartransmission" class="form-control" value="<?php echo $rowgeteditcar['cartransmission']; ?>">
											<?php
												$cartransmission = array("Auto", "Manual");
												foreach ($cartransmission as $value) {
													$selected = '';
													if ($value == $rowgeteditcar['cartransmission']) {
														$selected = 'selected';
													}
											?>
												<option <?php echo $selected; ?> value="<?php echo $value; ?>"><?php echo $value; ?></option>
											<?php
												}
											?>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label for="carclass" class="control-label col-md-3 col-sm-3 col-xs-12">Car Class</label>

										<div class="col-md-6 col-sm-6 col-xs-12">
											<select name="carclass" class="form-control">
											<?php
												$carclass = array("Truck", "SUV", "Van");
												foreach ($carclass as $value) {
													$selected = '';
													if ($value == $rowgeteditcar['carclass']) {
														$selected = 'selected';
													}
											?>
												<option <?php echo $selected; ?> value="<?php echo $value; ?>"><?php echo $value; ?></option>
											<?php
												}
											?>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label for="carcapacity" class="control-label col-md-3 col-sm-3 col-xs-12">Car Capacity</label>

										<div class="col-md-6 col-sm-6 col-xs-12">
											<select name="carcapacity" class="form-control">
											<?php
												$carcapacity = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10");
												foreach ($carcapacity as $value) {
													$selected = '';
													if ($value == $rowgeteditcar['carcapacity']) {
														$selected = 'selected';
													}
											?>
												<option <?php echo $selected; ?> value="<?php echo $value; ?>"><?php echo $value; ?></option>
											<?php
												}
											?>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label for="carairbag" class="control-label col-md-3 col-sm-3 col-xs-12">Car Airbag</label>

										<div class="col-md-6 col-sm-6 col-xs-12">
											<select name="carairbag" class="form-control">
											<?php
												$carairbag = array("2", "3", "4", "5", "6");
												foreach ($carairbag as $value) {
													$selected = '';
													if ($value == $rowgeteditcar['carairbag']) {
														$selected = 'selected';
													}
											?>
												<option <?php echo $selected; ?> value="<?php echo $value; ?>"><?php echo $value; ?></option>
											<?php
												}
											?>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="carotherdescription">Car Other Description<span class="required">*</span>
										</label>
										
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" name="carotherdescription" required="required" value="<?php echo $rowgeteditcar['carotherdescription']; ?>" class="form-control col-md-7 col-xs-12">
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="carcost">Car Cost <span class="required">*</span>
										</label>
										
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" name="carcost" required="required" value="<?php echo $rowgeteditcar['carcost']; ?>" class="form-control col-md-7 col-xs-12">
										</div>
									</div>
							
									<div class="ln_solid"></div>

									<div class="form-group">
										<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
											<input type="submit" name="cardetailsubmit" value="Submit" class="btn btn-success">
											<a href="carmanagement.php"><button class="btn btn-danger" type="button">Cancel</button></a>
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
		<!-- SweetAlert LOOK BACK INTO
		<script src="../javascripts/sweetalert-dev.js"></script>
		 SweetAlert 
		<script src="../../javascripts/sweetalert-dev.js"></script> -->

		<script>
			
		</script>

		<?php
			
			if (isset($_POST['cardetailsubmit'])):
				$carno = $_POST['carno'];
				$carname = $_POST['carname'];
				$carclass = $_POST['carclass'];
				$cartransmission = $_POST['cartransmission'];
				$cartype = $_POST['cartype'];
				$carcapacity = $_POST['carcapacity'];
				$carotherdescription = $_POST['carotherdescription'];
				$carairbag = $_POST['carairbag'];
				$carcost = $_POST['carcost'];
  
				$carphoto = $_FILES['carphoto']['name'];
				$tmp = $_FILES['carphoto']['tmp_name'];
				if ($carphoto) {

					$allowfiletype =  array('GIF','PNG' ,'JPG', 'gif', 'png', 'jpg');
					$ext = end((explode(".", $carphoto)));
					if(!in_array($ext, $allowfiletype) ) {
					    echo "<script>swal({
					    title: 'Oops!',
					    text: 'Only Image Files (gif, png, jpg) are allowed!',
					    type: 'error',
					    timer: 1000,
					    showConfirmButton: false
					    });</script>";
					}
					else{
				    move_uploaded_file($tmp, "../images/carphoto/$carphoto");
					$updatecarsql = mysqli_query($conn, "update Cars set carname = '$carname',carclass = '$carclass',cartransmission = '$cartransmission',carphoto = '$carphoto', cartype = '$cartype',carcapacity = '$carcapacity',carairbag = '$carairbag',carotherdescription = '$carotherdescription', carcost = '$carcost' where carno = '$carno'")or die(mysqli_error());
					echo "<script>
					window.location.href = 'carmanagement.php';
					</script>";
					}
				}
				else {
					$updatecarsql = mysqli_query($conn, "update Cars set carname = '$carname',carclass = '$carclass',cartransmission = '$cartransmission',cartype = '$cartype',carcapacity = '$carcapacity',carairbag = '$carairbag',carotherdescription = '$carotherdescription', carcost = '$carcost' where carno = '$carno'")or die(mysqli_error());
					echo "<script>
					window.location.href = 'carmanagement.php';
					</script>";
				}
			endif;
		?>
	</body>
</html>
