<?php
	session_start();
	include('../database/dbconnection.php');
	$staffid = $_SESSION['staffid'];

    /// when the admin logs out, the last login date will be set to at that time
	$sql = mysqli_query($conn, "update administrator set lastlogin = NOW() where staffid = '$staffid'");
	
	//destroy the login/session of the admin login
	session_destroy();

    ///redirecting to the index page of the website
	header("location: ../index.php");

?>

