<?php
include("database.php");
if($_GET['id'])
{
$id=$_GET['id'];

$sql = "delete from userprojects where uProjectID='$id'";
mysqli_query($link, $sql);
}
?>