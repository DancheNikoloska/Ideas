<?php

###### db ##########
$db_username = 'root';
$db_password = '';
$db_name = 'ideas';
$db_host = 'localhost';
################

//check we have username post var
if(isset($_REQUEST["username"]))
{
	//echo $_REQUEST["username"];
	
	
     //check if its an ajax request, exit if not
     if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
       die();
     }   

         //try connect to db
     $connecDB = mysqli_connect($db_host, $db_username, $db_password,$db_name)or die('could not connect to database');
     mysqli_set_charset($connecDB, "utf8");
     //trim and lowercase username
     $username =  trim($_REQUEST["username"]); 
     
     
     
     //check username in db
     $sql="SELECT Username FROM users WHERE Username='".$username."'";
	 //echo $sql;
	 
     $results = mysqli_query($connecDB,$sql);
     //echo mysqli_error($connecDB);
     //return total count
     $username_exist = mysqli_num_rows($results); //total records
     
     //if value is more than 0, username is not available
     if($username_exist) {
         echo '<img id="user-result-img" value="na" src="images/not-available.png" />';
     }else{
         echo '<img id="user-result-img" value="av" src="images/available.png" />';
     }
     
     //close db connection
     mysqli_close($connecDB);
} 
?>