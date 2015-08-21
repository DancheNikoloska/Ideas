<?php
session_start();
include('./functions.php');
include('database.php');
/*defined settings - start*/
ini_set("memory_limit", "99M");
ini_set('post_max_size', '20M');
ini_set('max_execution_time', 600);
define('IMAGE_MEDIUM_DIR', 'images/UserImg/');
define('IMAGE_MEDIUM_SIZE', 550);
/*defined settings - end*/

if(isset($_FILES['image_upload_file'])){
	$output['status']=FALSE;
	set_time_limit(0);
	$allowedImageType = array("image/gif",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
	
	if ($_FILES['image_upload_file']["error"] > 0) {
		$output['error']= "Error in File";
	}
	elseif (!in_array($_FILES['image_upload_file']["type"], $allowedImageType)) {
		$output['error']= "You can only upload JPG, PNG and GIF file";
	}
	elseif (round($_FILES['image_upload_file']["size"] / 1024) > 5000) {
		$output['error']= "You can upload file size up to 4 MB";
	} else {
		/*create directory with 777 permission if not exist - start*/
		
		createDir(IMAGE_MEDIUM_DIR);
		/*create directory with 777 permission if not exist - end*/
		$path[0] = $_FILES['image_upload_file']['tmp_name'];
		$file = pathinfo($_FILES['image_upload_file']['name']);
		$fileType = $file["extension"];
		$desiredExt='jpg';
		$fileNameNew = rand(333, 999) . time() . ".$desiredExt";
		$path[1] = IMAGE_MEDIUM_DIR . $fileNameNew;
		
		
		if (createThumb($path[0], $path[1], $fileType, IMAGE_MEDIUM_SIZE, IMAGE_MEDIUM_SIZE,IMAGE_MEDIUM_SIZE)) {
		
				$output['status']=TRUE;
				$output['image_medium']= $path[1];
				
				//upload to database
				$id=$_SESSION["userID"];
				$sql="UPDATE `users` SET `Image`='".$output['image_medium']."' WHERE UserID=".$id;
				if(mysqli_query($link,$sql))
				{
					
				}else echo "Настана грешка при внес во база";
			
		}
	}
	echo json_encode($output);
}
?>	