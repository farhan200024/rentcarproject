<?php
	if (!isset($_GET['customerid'])) {
		echo "<script>window.location='mdashboard.php'</script>";
	}

	session_start();

	if (!$_SESSION['managerauth']) {
		echo "<script>window.location='../adminlogin.php'</script>";
	}

	include('../database/dbconnection.php');


	$bancustomerid = $_GET['customerid'];

	
	mysqli_query($conn, "Update users SET active = 0 where customerid = '$bancustomerid'");
	
	echo "<script>window.location='usersmanagement.php'</script>";

?>