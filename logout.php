<?php
///when user clicked logout
//the session will destroy meaning it will log the user out
  session_start();
  session_destroy();
  
  header("location: index.php");
?>