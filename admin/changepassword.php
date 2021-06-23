<?php
	session_start();
	include('../database/dbconnection.php');
	if (!$_SESSION['companyauth']) {
		echo "<script>window.location='../adminlogin.php'</script>";
	}

	$staffid = $_SESSION['staffid'];
	$username = $_SESSION['staffusername'];

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

		<title>Change Password</title>

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
							  include "../admin/includes/_sidebarmenu.php";
						?>
					</div>
				</div>

				<!-- top navigation -->
						<?php
							  include "../admin/includes/_navigationbar.php";
						?>
				<!-- /top navigation -->

				<!-- page content -->
				<div class="right_col" role="main">
					<div class="">
						<div class="page-title">
							<div class="title_left">
								<h3>Change Password</h3>
							</div>
						</div>

						<div class="clearfix"></div>

						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<form method="post" class="form-horizontal form-label-left" enctype="multipart/form-data">

									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="oldpassword">Old Password
										</label>
										
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="password" required="required" placeholder="must be at least 8 characters" name="oldpassword" class="form-control col-md-7 col-xs-12">
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="newpassword">New Password
										</label>
										
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="password" required="required" pattern=".{8,}" title="8 characters minimum" placeholder="must be at least 8 characters" name="newpassword" class="form-control col-md-7 col-xs-12">
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="confirmpassword">Confirm new Password
										</label>
										
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="password" required="required" pattern=".{8,}" title="8 characters minimum" placeholder="must be at least 8 characters" name="confirmpassword" class="form-control col-md-7 col-xs-12">
										</div>
									</div>

									<div class="ln_solid"></div>

									<div class="form-group">
										<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
											<input type="submit" name="submit" value="Submit" class="btn btn-success">
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
	            window.location.href = 'changepassword.php';
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
			        window.location.href = 'changepassword.php';
			        });</script>";
			    }
			    

		        else{
		            $oldpassword = md5($oldpassword);
		            $newpassword = md5($newpassword);

		            $checkpasswordsql = mysqli_query($conn, "SELECT * FROM administrator where staffid = '$staffid' AND staffpassword = '$oldpassword'") or die(mysqli_error());
		            $rowcheckpassword = mysqli_num_rows($checkpasswordsql);

		            if ($rowcheckpassword < 1) {
			            echo "<script>swal({
			            title: 'Oops!',
			            text: 'Your old password is wrong. Please Try Again!',
			            type: 'error',
			            timer: 1500,
			            showConfirmButton: false
			            }, function(){
			            window.location.href = 'changepassword.php';
			            });</script>";
		            }
		            else{
		                $changepasswordsql = mysqli_query($conn, "UPDATE administrator set staffpassword = '$newpassword' where staffid = '$staffid'") or die(mysqli_error());
				            echo "<script>swal({
				            title: 'Success!',
				            text: 'Your password has been changed!',
				            type: 'success',
				            timer: 1500,
				            showConfirmButton: false
				            }, function(){
				            window.location.href = 'mdashboard.php';
				            });</script>";
		            }
		        }
		    }
	        
		endif;
		?>
	</body>
</html>
