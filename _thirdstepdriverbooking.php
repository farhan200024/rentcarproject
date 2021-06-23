<?php
	session_start();

	if (!isset($_GET['driverid'])) {
		echo "<script>window.location='index.php'</script>";
	}

	if (!isset($_SESSION['secondbooking'])) {
		echo "<script>window.location='index.php'</script>";
	}

	$driverid = $_GET['driverid'];
	$_SESSION['thirdbooking'] = true;
	$_SESSION['driverid'] = $driverid;
	echo "<script>window.location='finalbooking.php'</script>";

?>