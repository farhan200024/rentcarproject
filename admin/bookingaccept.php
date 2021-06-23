<?php
	if (!isset($_GET['bookingid'])) {
		echo "<script>window.location='mdashboard.php'</script>";
	}

	session_start();

	if (!(isset($_SESSION['managerauth']) || isset($_SESSION['staffauth']))) {
		echo "<script>window.location='../adminlogin.php'</script>";
	}

	include('../database/dbconnection.php');

	//$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);


	$acceptbookingid = $_GET['bookingid'];
	$checkbookingsql = mysqli_query($conn, "select * from bookings where bookingid = '$acceptbookingid'") or die(mysql_error());
	$rowcheckbooking = mysqli_fetch_assoc($checkbookingsql);

	$customerid = $rowcheckbooking['customerid'];
	$getcustomer = mysqli_query($conn, "select * from users where customerid = '$customerid'") or die(mysqli_error());
	$rowcustomer = mysqli_fetch_assoc($getcustomer);
	$customeremail = $rowcustomer['customeremail'];



	$staffid = $_SESSION['staffid'];

	mysqli_query($conn, "UPDATE Bookings SET confirmstatus = 'confirmed', staffid = '$staffid' where bookingid = '$acceptbookingid'");
	echo "<script>window.location='bookingmanagement.php'</script>";

	   echo '<script>alert("Booking Confirmation Completed"); window.location.href = "bookingmanagement.php";</script>';
?>