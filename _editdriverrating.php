<?php
	session_start();
	include 'database/dbconnection.php';
	
	if (!isset($_SESSION['authentication'])) {
		echo "<script>window.location.href = 'index.php';</script>";
	}
	
	$driverid = $_GET['driverid'];
	$customerid = $_GET['customerid'];

	$deleteratingsql = mysqli_query($conn,"delete from ratingsdriver where customerid = '$customerid' and driverid='$driverid'") or die(mysqli_error($conn));

	$updateratingavg = mysqli_query($conn,"UPDATE drivers SET driverrating = (SELECT AVG(driverrating) FROM ratingsdriver WHERE ratingsdriver.driverid = '$driverid') WHERE drivers.driverid = '$driverid'") or die(mysqli_error($conn));
	
	
	echo "<script>window.location.href = 'drivers.php';</script>";

?>