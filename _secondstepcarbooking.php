<?php
	session_start();

	if (!isset($_GET['carid'])) {
		echo "<script>window.location='index.php'</script>";
	}

	if (!isset($_SESSION['firstbooking'])) {
		echo "<script>window.location='index.php'</script>";
	}

	$carid = $_GET['carid'];
	$_SESSION['secondbooking'] = true;
	$_SESSION['carid'] = $carid;

	if ($_SESSION['driver'] == 'driver') {
		echo "<script>window.location='choosedriver.php'</script>";
	}
	elseif ($_SESSION['driver'] == 'nodriver') {
		echo "<script>window.location='finalbooking.php'</script>";
	}

?>