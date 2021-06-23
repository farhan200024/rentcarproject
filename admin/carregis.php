<?php
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

		<title>Register Car</title>

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
								<h3>Car Registration</h3>
							</div>
						</div>

						<div class="clearfix"></div>

						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<form method="post" class="form-horizontal form-label-left" enctype="multipart/form-data">

									<div class="form-group">

										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="carno">Car ID
										</label>

										<?php
										  	$getlatestid = mysqli_query($conn,"SELECT carno FROM Cars WHERE SUBSTRING(carno,4) = (SELECT MAX(CAST(SUBSTRING(carno,4) AS SIGNED)) FROM Cars)"); 
											$queryrow = mysqli_num_rows($getlatestid);

											if ($queryrow < 1):
												$newid = 'car1';

											else:
												  while ($row = mysqli_fetch_assoc($getlatestid)):
												    $lastid =  $row['carno'];
													$lastid = preg_replace("/[^0-9]/","",$lastid);
												  endwhile;
												  $lastid = $lastid + 1;
												  $newid = 'car'.$lastid;

											endif;
										?>

										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" name="carno" required="required" readonly value="<?php echo $newid; ?>" class="form-control col-md-7 col-xs-12">
										</div>
									</div>

									<div class="form-group">

										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="carname">Car Name
										</label>

										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" name="carname" required="required" class="form-control col-md-7 col-xs-12">
										</div>

									</div>

									<div class="form-group">
										<label for="cartype" class="control-label col-md-3 col-sm-3 col-xs-12">Car Type</label>

										<div class="col-md-6 col-sm-6 col-xs-12">
											<select name="cartype" required="required" class="form-control">
												<option value="Economy">Economy</option>
												<option value="Premium">Premium</option>
												<option value="Sporty">Sporty</option>
												<option value="SUV">SUV</option>
												<option value="Luxury">Luxury</option>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label for="cartransmission" class="control-label col-md-3 col-sm-3 col-xs-12">Car Transmission</label>

										<div class="col-md-6 col-sm-6 col-xs-12">
											<select name="cartransmission" required="required" class="form-control">
												<option value="Auto">Auto</option>
												<option value="Manual">Manual</option>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label for="carclass" class="control-label col-md-3 col-sm-3 col-xs-12">Car Class</label>

										<div class="col-md-6 col-sm-6 col-xs-12">
											<select name="carclass" class="form-control">
												<option value="Truck">Truck</option>
												<option value="SUV">SUV</option>
												<option value="Van">Van</option>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label for="carcapacity" class="control-label col-md-3 col-sm-3 col-xs-12">Car Capacity</label>

										<div class="col-md-6 col-sm-6 col-xs-12">
											<select name="carcapacity" required="required" class="form-control">
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
												<option value="6">6</option>
												<option value="7">7</option>
												<option value="8">8</option>
												<option value="9">9</option>
												<option value="10">10</option>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label for="carairbag" class="control-label col-md-3 col-sm-3 col-xs-12">Car Airbag</label>

										<div class="col-md-6 col-sm-6 col-xs-12">
											<select name="carairbag" required class="form-control">
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
												<option value="6">6</option>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="carotherdescription">Car Other Description
										</label>
										
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" name="carotherdescription" required="required" class="form-control col-md-7 col-xs-12">
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="carphoto">Car Photo
										</label>
										
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="file" name="carphoto" required class="form-control col-md-7 col-xs-12">
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="carcost">Car Cost
										</label>
										
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" placeholder="per six hours" name="carcost" required="required" class="form-control col-md-7 col-xs-12">
										</div>
									</div>

									<div class="ln_solid"></div>

									<div class="form-group">
										<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
											<input type="submit" name="submit" value="Submit" class="btn btn-success">
											<input type="reset" name="reset" value="Reset" class="btn btn-primary">
											<a href="carmanagement.php"><button class="btn btn-danger" type="button">Cancel</button></a>
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

				if($carphoto) {
					$allowfiletype =  array('GIF','PNG' ,'JPG', 'gif', 'png', 'jpg');
					$ext = end((explode(".", $carphoto)));
					if(!in_array($ext, $allowfiletype) ) {
					    echo "<script>swal({
					    title: 'Oops!',
					    text: 'Only Image Files (gif, png, jpg) are allowed!',
					    type: 'error',
					    timer: 1000,
					    showConfirmButton: false
					    }, function(){
					    window.location.href = 'carregis.php';
					    });</script>";
					}
					else{
						move_uploaded_file($tmp, "../images/carphoto/$carphoto");

						mysqli_query($conn, "Insert into Cars values('$carno', '$carname', '$carclass', '$cartransmission', '$carcost', '$cartype', '$carcapacity', '$carairbag', '$carotherdescription','5', '$carphoto')");
						echo "<script>swal({
						title: 'Success!',
						text: 'New Car Information has been saved!',
						type: 'success',
						timer: 1000,
						showConfirmButton: false
						}, function(){
						window.location.href = 'addnewcartooffice.php';
						});</script>";
					}
				}
				else{
					mysqli_query($conn, "Insert into Cars values('$carno', '$carname', '$carclass', '$cartransmission', '$carcost', '$cartype', '$carcapacity', '$carairbag', '$carotherdescription','5', '$carphoto')");
					echo "<script>swal({
					title: 'Success!',
					text: 'New Car Information has been saved!',
					type: 'success',
					timer: 1000,
					showConfirmButton: false
					}, function(){
					window.location.href = 'addnewcartooffice.php';
					});</script>";
				}
			endif;
		?>
	</body>
</html>
