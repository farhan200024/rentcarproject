<?php
	session_start();
	include 'database/dbconnection.php';
	
	if (!isset($_SESSION['authentication'])) {
		echo "<script>window.location.href = 'index.php';</script>";
	}

	$carno = $_GET['carno'];
	$customerid = $_GET['customerid'];

	$deleteratingsql = mysqli_query($conn,"delete from ratingscar where customerid = '$customerid' and carno='$carno'") or die(mysqli_error($conn));

	$updateratingavg = mysqli_query($conn,"UPDATE cars SET carrating = (SELECT AVG(carrating) FROM ratingscar WHERE ratingscar.carno = '$carno') WHERE cars.carno = '$carno'") or die(mysqli_error($conn));
	
	echo "<script>window.location.href = 'cars.php';</script>";

?>