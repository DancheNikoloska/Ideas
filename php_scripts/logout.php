<?php
session_start();
$_SESSION['user']="";
$_SESSION['userID']="";
header("Location: index.php");


?>