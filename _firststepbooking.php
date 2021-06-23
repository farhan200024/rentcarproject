<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>First step Booking</title>

		<!-- Bootstrap -->
		<link href="style/bootstrap.min.css" rel="stylesheet">
		<!-- Font Awesome -->
		<link href="fa/css/font-awesome.min.css" rel="stylesheet">
		<!-- Sweet Alert -->
		<link rel="stylesheet" href="style/sweetalert.css">
		<!-- Site Logo -->
		<link href = "images/design/logoo.jpg" rel="icon" type="image/jpg">
		<!-- Custom Style -->
		<link href="style/customstyle.css" rel="stylesheet">

	</head>

	<body class="onepagebody">
<!-- jQuery -->
<script src="javascripts/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="javascripts/bootstrap.min.js"></script>
<!-- SweetAlert -->
<script src="javascripts/sweetalert-dev.js"></script>
</body>
<?php
	include ('database/dbconnection.php');
	session_start();
	
	if (!isset($_SESSION['authentication'])) {
		echo "<script>window.location.href = 'index.php';</script>";
	}
	
		$fromtodatetime = $_POST['fromtodatetime'];
		$arrayexplode = explode(' - ', $fromtodatetime);
		$pickuptime = $arrayexplode[0];
		$returntime = $arrayexplode[1];

		$date1=strtotime("$pickuptime");
		$date2=strtotime("$returntime");

		$checkdate = abs($date1 - $date2);
		if ($checkdate <= 0) {
			echo "<script>swal({
			title: 'Oops!',
			text: 'Pickup Time must be early than Return Time!',
			type: 'error',
			timer: 1500,
			showConfirmButton: false
			}, function(){
			window.location.href = 'index.php';
			});</script>";
		}

		$todaytime = date("Y-m-d H:i:s");
		$todaytime=strtotime("$todaytime");
		$days = ($date1 - $todaytime)/60/60/24;
		if ($days < 1) {
			echo "<script>swal({
			title: 'Oops!',
			text: 'Pickup Time must be 24 Hours apart from today to make booking!',
			type: 'error',
			timer: 1500,
			showConfirmButton: false
			}, function(){
			window.location.href = 'index.php';
			});</script>";
		}
		else{
			$hours = abs(($date1 - $date2)/60/60);
			$_SESSION['durationinhours'] = $hours;

			$_SESSION['firstbooking'] = true;
			$_SESSION['officeid'] = $_POST['officeid'];
			$_SESSION['pickuplocation'] = $_POST['pickuplocation'];
			$_SESSION['returnlocation'] = $_POST['returnlocation'];
			$_SESSION['pickuptime'] = $pickuptime;
			$_SESSION['returntime'] = $returntime;
			$_SESSION['driver'] = $_POST['driver'];
			echo "<script>window.location='choosecar.php'</script>";
		}

?>
</html>