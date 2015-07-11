<?php
$link=mysqli_connect("localhost" , "root" ,  "" , "Ideas");
$link->set_charset("utf8");
if(!$link) die("Error:" .mysqli_connect_error() );
?>