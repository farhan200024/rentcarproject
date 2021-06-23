<?php

	//to use session
	session_start();

	//for mysqli database connection
	include('database/dbconnection.php');
	
	if (!isset($_SESSION['authentication'])) {
		echo "<script>window.location.href = 'index.php';</script>";
	}
	

	$customerid = $_SESSION['customerid'];

	$getcustomer = mysqli_query($conn,"select * from users where customerid = '$customerid'") or die(mysqli_error($conn));

	$rowgetcustomerdata = mysqli_fetch_assoc($getcustomer);
	$currentpage = 'index';

	

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>My Profile</title>

		<!-- Bootstrap -->
		<link href="style/bootstrap.min.css" rel="stylesheet">
		<!-- Font Awesome -->
		<link href="fa/css/font-awesome.min.css" rel="stylesheet">
		<!-- Sweet Alert -->
		<link rel="stylesheet" href="style/sweetalert.css">
		<!-- Custom Style -->
		<link href="style/customstyle.css" rel="stylesheet">
		<!-- Site Logo -->
		<link href = "images/design/logoo.jpg" rel="icon" type="image/jpg">

	</head>

	<body class="other">

		<?php include '_navigationbar.php'; ?> <!-- navigation bar -->


		<div class="container adjustnavpositon">
			<div class="row">
				<div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-2 col-sm-offset-3 main_form" id="main" style="padding: 20px;">
					<div class="pull-center" style="text-align: center">
							<div id="divedit">
								<i onclick="changeinput()" class="fa fa-edit fa-lg pull-right" style="cursor:pointer;"> Edit</i>
							</div>
							<div id="divcancel" style="display: none;">
								<i onclick="changecancel()" class="fa fa-ban fa-lg pull-right" style="cursor:pointer;"> Cancel</i>
							</div>
							<h1>Your Details</h1>
							<hr>
							<div class="col-md-8 col-md-offset-2">
							<form method="post" enctype="multipart/form-data">
							<div class="profile_img">
								<div id="crop-avatar">
								<!-- Current avatar -->
									<img class="center-block img-circle avatar-view" width="200px" height="200px" src="images/customerphoto/<?php echo $rowgetcustomerdata['customerphoto']; ?>" alt="Avatar">
									<br>

									<div class="form-group">
										<input type="hidden" class="form-control" name="customerphoto" id="customerphoto">
									</div>
								</div>
							</div>
							<h4  id="divname">
								<i class="fa fa-user"></i> <?php echo $rowgetcustomerdata['customername']; ?>
							</h4>
							<div class="form-group">
								<input type="hidden" class="form-control" name="customername" id="customername" value="<?php echo $rowgetcustomerdata['customername']; ?>" required="">
							</div>

							<ul class="list-unstyled user_data">
								<li>
									<div id="divusername"><i class="fa fa-user-circle-o"></i> Username : <?php echo $rowgetcustomerdata['customerusername']; ?></div>
									<div class="form-group">
										<input type="hidden" class="form-control" readonly name="customerusername" id="customerusername" value="<?php echo $rowgetcustomerdata['customerusername']; ?>" required="">
									</div>
								</li>

								<li>
									<div id="divemail"><i class="fa fa-envelope"></i> Email : <?php echo $rowgetcustomerdata['customeremail']; ?></div>
									<div class="form-group">
										<input type="hidden" class="form-control" name="customeremail" id="customeremail" value="<?php echo $rowgetcustomerdata['customeremail']; ?>" required="">
									</div>
								</li>

								<li>
									<div id="divgender"><i class="fa fa-male"></i> Gender : <?php echo $rowgetcustomerdata['customergender']; ?></div>
									<div class="form-group">
										<input type="hidden" class="form-control" name="customergender" id="customergender" value="<?php echo $rowgetcustomerdata['customergender']; ?>" required="">
									</div>
								</li>

								<li>
									<div id="divdob"><i class="fa fa-calendar"></i> Date of Birth : <?php echo $rowgetcustomerdata['customerdob']; ?></div>
									<div class="form-group">
										<input type="hidden" class="form-control" name="customerdob" id="customerdob" value="<?php echo $rowgetcustomerdata['customerdob']; ?>" required="">
									</div>
								</li>
								<div class="form-group">
									<input type="hidden" class="btn btn-primary center-block" name="submit" id="button" value="Update">
								</div>
							</ul>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

			
	</body>

	<!-- jQuery -->
	<script src="javascripts/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script src="javascripts/bootstrap.min.js"></script>
	<!-- SweetAlert -->
	<script src="javascripts/sweetalert-dev.js"></script>
	<script>

		function changeinput() {
				document.getElementById('customerphoto').type = "file";

				document.getElementById('customerusername').type = "text";
				document.getElementById('customerusername').required = "required";
				document.getElementById("divusername").style.visibility = "hidden";

				document.getElementById('customername').type = "text";
				document.getElementById('customername').required = "required";
				document.getElementById("divname").style.visibility = "hidden";

				document.getElementById('customeremail').type = "text";
				document.getElementById('customeremail').required = "required";
				document.getElementById("divemail").style.visibility = "hidden";

				document.getElementById('customergender').type = "text";
				document.getElementById('customergender').required = "required";
				document.getElementById("divgender").style.visibility = "hidden";

				document.getElementById('customerdob').type = "date";
				document.getElementById('customerdob').required = "required";
				document.getElementById("divdob").style.visibility = "hidden";

				document.getElementById('button').type = "submit";
				document.getElementById('divedit').style.display = "none";
				document.getElementById('divcancel').style.display = "block";
				document.getElementById('paypalbutton').style.display = "none";

			}

		function changecancel(){
				document.getElementById('customerphoto').type = "hidden";

				document.getElementById('customerusername').type = "hidden";
				document.getElementById('customerusername').required = "";
				document.getElementById("divusername").style.visibility = "visible";

				document.getElementById('customername').type = "hidden";
				document.getElementById('customername').required = "";
				document.getElementById("divname").style.visibility = "visible";

				document.getElementById('customeremail').type = "hidden";
				document.getElementById('customeremail').required = "";
				document.getElementById("divemail").style.visibility = "visible";

				document.getElementById('customergender').type = "hidden";
				document.getElementById('customergender').required = "";
				document.getElementById("divgender").style.visibility = "visible";

				document.getElementById('customerdob').type = "hidden";
				document.getElementById('customerdob').required = "";
				document.getElementById("divdob").style.visibility = "visible";

				document.getElementById('button').type = "hidden";
				document.getElementById('divedit').style.display = "block";
				document.getElementById('divcancel').style.display = "none";

		}

	</script>

	<?php
	if (isset($_POST['submit'])) {
		$customername = $_POST['customername'];
		$customergender = $_POST['customergender'];
		$customeremail = $_POST['customeremail'];
		$customerdob = $_POST['customerdob'];
  
		$customerphoto = $_FILES['customerphoto']['name'];
		$tmp = $_FILES['customerphoto']['tmp_name'];

		if ($customerphoto) {

			$allowfiletype =  array('GIF','PNG' ,'JPG', 'gif', 'png', 'jpg');
			$ext = end((explode(".", $customerphoto)));
			if(!in_array($ext, $allowfiletype) ) {
			    echo "<script>swal({
			    title: 'Oops!',
			    text: 'Only Image Files (gif, png, jpg) are allowed!',
			    type: 'error',
			    timer: 1500,
			    showConfirmButton: false
			    }, function(){
			    window.location.href = 'profile.php';
			    });</script>";
			}
			else{
			    move_uploaded_file($tmp, "images/customerphoto/$customerphoto");
			    $updatesql = mysqli_query($conn,"update users set customername = '$customername',  customeremail = '$customeremail', customergender = '$customergender', customerphoto = '$customerphoto' where customerid = '$customerid'") or die(mysqli_error($conn));
			    echo "<script>swal({
			    title: 'Success!',
			    text: 'Your Profile has been updated!',
			    type: 'success',
			    timer: 1500,
			    showConfirmButton: false
			    }, function(){
			    window.location.href = 'profile.php';
			    });</script>";
			}
		}
		else{
		    $updatesql = mysqli_query($conn,"update users set customername = '$customername',  customeremail = '$customeremail', customergender = '$customergender' where customerid = '$customerid'") 
		    or die(mysqli_error($conn));
		    echo "<script>swal({
		    title: 'Success!',
		    text: 'Your Profile has been updated!',
		    type: 'success',
		    timer: 1000,
		    showConfirmButton: false
		    }, function(){
		    window.location.href = 'profile.php';
		    });</script>";
		}
	}

	?>
</html>