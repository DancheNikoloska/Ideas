<?php 
include_once 'database.php';
$userId=$_GET['user_id'];
if(isset($_GET['delete_id']))
{
     if(mysqli_query($link,"DELETE FROM userexperiences WHERE uExperienceID=".$_GET['delete_id'])==false)
	echo mysqli_error($link);
     
     header("Location: userProfile.php?id=".$userId);
}

?>