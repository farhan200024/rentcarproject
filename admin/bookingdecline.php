<?php
	if (!isset($_GET['bookingid'])) {
		echo "<script>window.location='mdashboard.php'</script>";
	}

	session_start();
	
	if (!isset($_SESSION['managerauth'])) {

		echo "<script>window.location='../adminlogin.php'</script>";
	}

	include('../database/dbconnection.php');


	$declinebookingid = $_GET['bookingid'];

	//$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	$checkbookingsql = mysqli_query($conn, "select * from bookings where bookingid = '$declinebookingid'") or die(mysqli_error());
	$rowcheckbooking = mysqli_fetch_assoc($checkbookingsql);
	$paymentmethod = $rowcheckbooking['paymentmethod'];

	$customerid = $rowcheckbooking['customerid'];
	$getcustomer = mysqli_query($conn, "select * from users where customerid = '$customerid'") or die(mysqli_error());
	$rowcustomer = mysqli_fetch_assoc($getcustomer);
	$customeremail = $rowcustomer['customeremail'];

	$totalcost = $rowcheckbooking['totalcost'];
	
	$staffid = $_SESSION['staffid'];

	mysqli_query($conn, "UPDATE Bookings SET confirmstatus = 'declined', staffid = '$staffid' where bookingid = '$declinebookingid'");


	   echo '<script>alert("Booking Declined Completed"); window.location.href = "bookingmanagement.php";</script>';
?>