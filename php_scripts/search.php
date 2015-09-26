
<?php 
include_once 'database.php';

if (isset($_POST['orderIdeas']))
{
	$q=$_POST['orderIdeas'];
    if($q==0)
	  $q=2;	
}
else $q=2;
//echo $q;


if (isset($_POST['sending']))
{
	
	$sql="";
	$data=mysqli_real_escape_string($link, $_POST['sending']); 
	$data=mb_strtolower($data);
	if (!empty($data)){
		if ($q==1){
		$sql="Select * from ideas i inner join users u on u.UserID=i.LeaderID where (Title COLLATE UTF8_GENERAL_CI LIKE '%$data%') or (Keywords COLLATE UTF8_GENERAL_CI LIKE '%$data%') or (Technologies COLLATE UTF8_GENERAL_CI LIKE '%$data%') or (Description COLLATE UTF8_GENERAL_CI LIKE '%$data%') order by i.Rating desc";
			$query=mysqli_query($link,$sql);
			
		}
		else if($q==2){
			$sql="Select * from ideas i inner join users u on u.UserID=i.LeaderID where (Title COLLATE UTF8_GENERAL_CI LIKE '%$data%') or (Keywords COLLATE UTF8_GENERAL_CI LIKE '%$data%') or (Technologies COLLATE UTF8_GENERAL_CI LIKE '%$data%') or (Description COLLATE UTF8_GENERAL_CI LIKE '%$data%') order by i.Date desc";
			$query=mysqli_query($link,$sql);
		   
		}
		}
	else {
		if ($q==1){
			//echo "Q IS 1";
			$sql="Select * from ideas i inner join users u on u.UserID=i.LeaderID order by i.Rating desc limit 6";
			$query=mysqli_query($link,$sql);
		   
		}
		else if($q==2){
			$sql="Select * from ideas i inner join users u on u.UserID=i.LeaderID order by i.Date desc limit 6";
			//echo "Q IS 2";
			$query=mysqli_query($link,$sql);
		  
		}
		
	}
		if (mysqli_num_rows($query)!=0){
			while ($row=mysqli_fetch_assoc($query))
			{
				
			 
          	?>
						<div class="col-md-4 col-sm-6" style="height: 30%">
                        <div class="center"> 
                           <a href="userProfile.php?id=<?php echo $row['UserID'] ?>" ><img src="<?php echo $row['Image'] ?>" class="icon-lg"></a>
                            <a href="ideaDetails.php?ideaId=<?php echo $row['IdeaID'] ?>" style="color:black !important;"><h4><?php echo $row['Title'] ?></h4>
                            <p><?php 
                            $str = wordwrap($row['Description'], 40);
							$str = explode("\n", $str);
							$str = $str[0] . ' ...';
                            echo $str; ?>
                            </p>
                            </a>
                        </div>
              </div>
      <?php  }
      
		}
		else echo "Нема резултати.";
	}
else{
	echo "NOT SEARCHING";
//no search
		if ($q==1)
			$query=mysqli_query($link,"Select * from ideas i inner join users u on u.UserID=i.LeaderID order by i.Rating desc limit 6");
		
		else
			$query=mysqli_query($link,"Select * from ideas i inner join users u on u.UserID=i.LeaderID order by i.Date desc limit 6");
		
		
		if (mysqli_num_rows($query)!=0){
			while ($row=mysqli_fetch_assoc($query))
			{
				
			 
          	?>
						<div class="col-md-4 col-sm-6">
                        <div class="center"> 
                           <a href="userProfile.php?id=<?php echo $row['UserID'] ?>" ><img src="images/UserImg/<?php echo $row['Image'] ?>" class="icon-lg"></a>
                            <a href="ideaDetails.php?ideaId=<?php echo $row['IdeaID'] ?>" style="color:black !important;"><h4><?php echo $row['Title'] ?></h4>
                            <p><?php 
                            $str = wordwrap($row['Description'], 40);
							$str = explode("\n", $str);
							$str = $str[0] . ' ...';
                            echo $str; ?>
                            </p>
                            </a>
                        </div>
              </div>
      <?php  }
      
		}
		}
?>
