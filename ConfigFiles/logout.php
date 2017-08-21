<?php
session_start();
session_unset();
session_destroy();
//include "config.php";
?>
<h3>Logging out wait for 2sec...</h3>
<meta http-equiv="refresh" content="2,url=../AdminFiles/AdminLogin.php">