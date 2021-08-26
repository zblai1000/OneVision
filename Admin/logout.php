<?php
error_reporting(0);
session_start();
 

$_SESSION = array();
 

session_destroy();
 

header("location: signIn.php");
exit;
?>