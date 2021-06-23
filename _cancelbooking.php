<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Booking Cancel</title>

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

	<body class="other">
<!-- jQuery -->
<script src="javascripts/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="javascripts/bootstrap.min.js"></script>
<!-- SweetAlert -->
<script src="javascripts/sweetalert-dev.js"></script>
</body>
<?php
	//to use session
	session_start();

	//for mysqli database connection
	include('database/dbconnection.php');
	
	if (!isset($_SESSION['authentication'])) {
		echo "<script>window.location.href = 'index.php';</script>";
	}

	if (!isset($_GET['bookingid'])) {
		echo "<script>window.location.href = 'reservation.php';</script>";
	}
	else{

	$customerid = $_SESSION['customerid'];
	$bookingid = $_GET['bookingid'];

	//$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);


	$getbookingsql = mysqli_query($conn, "select * from bookings where bookingid = '$bookingid' and customerid = '$customerid'") or die(mysqli_error($conn));
	$rowbooking = mysqli_fetch_assoc($getbookingsql); 
	$date1=strtotime("$rowbooking[pickuptime]");
	$date2 = date("Y-m-d H:i:s");
	$date2=strtotime("$date2");
	$days = abs(($date1 - $date2)/60/60/24);
	if ($days > 5):
		$deletebookingsql = mysqli_query($conn, "delete from bookings where bookingid = '$bookingid'") or die(mysqli_error($conn));


	echo "
  		<script>
  		swal({
		  title: 'Success!',
		  text: 'Your booking has been successfully cancelled!',
		  type: 'success',
		  timer: 1000,
		  showConfirmButton: false
		}, function(){
		      window.location.href = 'reservation.php';
		});</script>
		";
	else:
		echo "<script>window.location.href = 'reservation.php';</script>";
	endif;

	}
?>
</html>