<?php
 // default values for Xampp when accessing the MySQL database:

  $dbhost = "localhost";
  $dbuser = "root";
  $dbpass = "";  //no password for our database
  $dbname = "rentcar_project";  //database name in PHPMYADMIN


  $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

  //show success massage if accessed this page OR when connected
  //echo "Sucessfully connected to the database";

?>



