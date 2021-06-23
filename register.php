<?php
/// this script is where the user comes new into the website and register by putting details
/// these details are then INSERTED into the database
	//to use session
	session_start();

	//for mysqli database connection
	include('database/dbconnection.php');
	$currentpage = 'register';

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Register</title>

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
				<div class="col-md-6 col-sm-6 col-xs-12  col-md-offset-3 col-sm-offset-3 main_form" style="padding: 20px;">
					<div class="row">
						<form class="form-horizontal form-label-left" method="post">
						
							<h3 style="text-align: center"><i class="fa fa-user-circle"></i> Enter Details</h3><br>
							<div id="personaldetail">
								<div class="form-group">
									<label for="customername" class="control-label col-md-4 col-sm-4 col-xs-12"><i class="fa fa-user"></i> Full Name</label>
									<div class="col-md-7 col-sm-7 col-xs-12">
										<input type="text" class="form-control" required name="customername" placeholder="John">
									</div>
								</div>
														
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="customeremail"><i class="fa fa-envelope"></i> Email Address</label>
									<div class="col-md-7 col-sm-7 col-xs-12">
										<input type="email" class="form-control" required name="customeremail" placeholder="example@email.com">
									</div>
								</div>
														
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="customerusername" ><i class="fa fa-user-circle-o"></i> Username</label>
								
									<div class="col-md-7 col-sm-7 col-xs-12">
										<input type="text" class="form-control" required  name="customerusername" pattern=".{8,}" title="8 characters minimum" placeholder="example123">
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="customerpassword"><i class="fa fa-unlock"></i> Password</label>
									<div class="col-md-7 col-sm-7 col-xs-12">
										<input type="password" class="form-control" required pattern=".{8,}" title="8 characters minimum" name="customerpassword" placeholder="Must be at least 8 letters">
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="confirmpassword"><i class="fa fa-unlock"></i> Confirm Password</label>
									<div class="col-md-7 col-sm-7 col-xs-12">
										<input type="password" class="form-control" required pattern=".{8,}" title="8 characters minimum" name="confirmpassword" placeholder="Must be at least 8 letters">
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="customergender"><i class="fa fa-male"></i> Gender</label>
									<div class="col-md-4 col-sm-4 col-xs-12">
										<input type="radio" name="customergender" id="male" required="required" value="male"><label for="male"><i class="fa fa-male"></i> Male</label>
									</div>
									<div class="col-md-4 col-sm-4 col-xs-12">
										<input type="radio" name="customergender" id="female" value="female"><label for="female"><i class="fa fa-female"></i> Female</label>
									</div>
								</div>
								
								
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="customerdob"><i class="fa fa-calendar"></i> Date of Birth</label>
									<div class="col-md-7 col-sm-7 col-xs-12">
									<input type="date" class="form-control" placeholder="mm/dd/yyyy" required  name="customerdob">
									</div>
								</div>
								<div class="form-group">
									<input type="submit" value="Register" name="submit" class="btn btn-primary center-block">
								</div>

						</form>
					</div>
				</div>
			</div>
		</div>

	<!-- jQuery -->
	<script src="javascripts/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script src="javascripts/bootstrap.min.js"></script>
	<!-- SweetAlert -->
	<script src="javascripts/sweetalert-dev.js"></script>

			
	</body>
		<?php
			if (isset($_POST['submit'])):
				$customername = $_POST['customername'];
				$customeremail = $_POST['customeremail'];
				$customerusername = $_POST['customerusername'];
				$customerpassword = $_POST['customerpassword'];
				$confirmpassword = $_POST['confirmpassword'];
				$customergender = $_POST['customergender'];
				$customerdob = $_POST['customerdob'];

                if ($customerpassword != $confirmpassword) {
                    echo "<script>swal({
                    title: 'Oops!',
                    text: 'Your passwords do not match. Please Try Again!',
                    type: 'error',
                    timer: 1000,
                    showConfirmButton: false
                    }, function(){
                    window.location.href = 'register.php';
                    });</script>";
                }

                else{

	                $checkemailsql = mysqli_query($conn,"SELECT * FROM users where customeremail = '$customeremail'");
	                $checkemailnumrow = mysqli_num_rows($checkemailsql);
	                if ($checkemailnumrow > 0) {
	                    echo "<script>swal({
	                    title: 'Oops!',
	                    text: 'Your Email is already in use. Please Try Again!',
	                    type: 'error',
	                    timer: 1000,
	                    showConfirmButton: false
	                    }, function(){
	                    window.location.href = 'register.php';
	                    });</script>";
	                }

	                else{

		                $checkusername = mysqli_query($conn,"SELECT * FROM users where customerusername = '$customerusername'");
		                $rownousername = mysqli_num_rows($checkusername);
		                if($rownousername > 0) {
		                    echo "<script>swal({
		                    title: 'Oops!',
		                    text: 'Your Username is already in use. Try Again',
		                    type: 'error',
		                    timer: 1000,
		                    showConfirmButton: false
		                    }, function(){
		                    window.location.href = 'register.php';
		                    });</script>";
		                }

		                else{
		                	$customerpassword = md5($customerpassword);

						  	$getlatestid = mysqli_query($conn,"SELECT customerid FROM users WHERE SUBSTRING(customerid,4) = (SELECT MAX(CAST(SUBSTRING(customerid,4) AS SIGNED)) FROM users)"); 
							$queryrow = mysqli_num_rows($getlatestid);
							
							if ($queryrow < 1){
								$customerid = 'cus1';
							}

							else{
								  while ($row = mysqli_fetch_assoc($getlatestid)):
								    $lastid =  $row['customerid'];
									$lastid = preg_replace("/[^0-9]/","",$lastid);
								  endwhile;
								  $lastid = $lastid + 1;
								  $customerid = 'cus'.$lastid;
							}

			                $registersql = mysqli_query($conn,"insert into users(customerid, customername, customerusername, customeremail, customerpassword, customergender, customerdob, customerphoto, signuptime) values('$customerid','$customername', '$customerusername', '$customeremail', '$customerpassword', '$customergender', '$customerdob', 'customer.png', NOW())") or die(mysqli_error($conn));

						    $_SESSION['authentication'] = true;
						    $_SESSION['customerusername'] = $customerusername;
						    $_SESSION['customerid'] = $customerid;
		                    echo "<script>swal({
		                    title: 'Success!',
		                    text: 'Your account has been created!',
		                    type: 'success',
		                    timer: 500,
		                    showConfirmButton: false
		                    }, function(){
		                    window.location.href = 'index.php';
		                    });</script>";
		                }
		            }
	            }
			endif;
		?>
</html>