<?php

	//to use session
	session_start();

	//for mysqli database connection
	include('database/dbconnection.php');
	
	if (!isset($_SESSION['authentication'])) {
		echo "<script>window.location.href = 'index.php';</script>";
	}
	

	$customerid = $_SESSION['customerid'];
	$customerusername = $_SESSION['customerusername'];

	$getcustomer = mysqli_query($conn,"select * from users where customerid = '$customerid'") or die(mysqli_error($conn));

	$rowgetcustomerdata = mysqli_fetch_assoc($getcustomer);
	$customeremail = $rowgetcustomerdata['customeremail'];
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

		<title>Change Password</title>

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
				<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 col-sm-offset-3 main_form" id="main" style="padding: 20px;">
				<h1 style="text-align: center;">Change Password</h1>
				<hr>
				<form method="post">
					
					<div class="form-group">
						<label for="oldpassword">Old Password</label>
						<input type="password" name="oldpassword" id="oldpassword" required placeholder="must be at least 8 characters"  class="form-control">
					</div>
					
					<div class="form-group">
						<label for="newpassword">New Password</label>
						<input type="password" name="newpassword" id="newpassword" required pattern=".{8,}" title="8 characters minimum" placeholder="must be at least 8 characters"  class="form-control">
					</div>
					
					<div class="form-group">
						<label for="confirmpassword">Confirm New Password</label>
						<input type="password" name="confirmpassword" id="confirmpassword" required  pattern=".{8,}" title="8 characters minimum" placeholder="must be at least 8 characters" class="form-control">
					</div>

					<div id="diverror" class="form-group" style="color: red;"></div>

					<div class="form-group">
						<input type="submit" name="submit" value="Change Password" class="btn btn-primary center-block">
					</div>
				</form>
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
	</script>

	<?php
	if (isset($_POST['submit'])) {
        $oldpassword = $_POST['oldpassword'];
        $newpassword = $_POST['newpassword'];
        $confirmpassword = $_POST['confirmpassword'];

        if ($newpassword != $confirmpassword) {
            echo "<script>swal({
            title: 'Oops!',
            text: 'Passwords do not match. Please Try Again!',
            type: 'error',
            timer: 1000,
            showConfirmButton: false
            }, function(){
            window.location.href = 'password.php';
            });</script>";
        }
        else{

		    if (7 > strlen($newpassword)) {
		        echo "<script>swal({
		        title: 'Oops!',
		        text: 'Password must be at least 8 characters. Please Try Again!',
		        type: 'error',
		        timer: 1000,
		        showConfirmButton: false
		        }, function(){
		        window.location.href = 'password.php';
		        });</script>";
		    }
	        else{
	        	///hash password
	            $oldpassword = md5($oldpassword);
	            $newpassword = md5($newpassword);

	            $checkpasswordsql = mysqli_query($conn,"SELECT * FROM users where customerusername = '$customerusername' AND customerpassword = '$oldpassword'") or die(mysqli_error($conn));
	            $rowcheckpassword = mysqli_num_rows($checkpasswordsql);

	            if ($rowcheckpassword < 1) {
		            echo "<script>swal({
		            title: 'Oops!',
		            text: 'Your old password is wrong. Please Try Again!',
		            type: 'error',
		            timer: 1000,
		            showConfirmButton: false
		            }, function(){
		            window.location.href = 'password.php';
		            });</script>";
	            }
	            else{
	                $changepasswordsql = mysqli_query($conn,"UPDATE users set customerpassword = '$newpassword' where customerusername = '$customerusername'") or die(mysqli_error($conn));

					   echo "<script>swal({
				            title: 'Success!',
				            text: 'Your password has been changed!',
				            type: 'success',
				            timer: 1000,
				            showConfirmButton: false
				            }, function(){
				            window.location.href = 'index.php';
				            });</script>";
					}
	            }
	        }
	    }

	?>
</html>