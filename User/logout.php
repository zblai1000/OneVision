<?php

session_start();
error_reporting(0);

$_SESSION = array();
 

session_destroy();
 

header("location: signIn.php");
exit;
?>