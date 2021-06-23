<?php
	if (!isset($_GET['carid'])) {
		echo "<script>window.location='mdashboard.php'</script>";
	}

	session_start();
	
	if (!$_SESSION['managerauth']) {
		echo "<script>window.location='../adminlogin.php'</script>";
	}

	include('../database/dbconnection.php');


	$deletecarid = $_GET['carid'];

	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    /// if the car is booked, then delete the from the bookings table
	mysqli_query($conn, "delete from bookings where carid = '$deletecarid'") 
	or die(mysqli_error());


    ///if the car is added to the office then delete it from the officecars but dont delete it from the main cars table
	mysqli_query($conn, "delete from OfficeCars where carid = '$deletecarid'");

	echo "<script>window.location='carmanagement.php'</script>";

?>