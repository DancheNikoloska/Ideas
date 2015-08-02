<div class="row col-md-12" id="result_para"><br /> <br />
<?php 
include_once 'database.php';
if (isset($_POST['sending']))
{
	$data=mysqli_real_escape_string($link, $_POST['sending']); 
	$data=strtolower($data);
	if (!empty($data)){
		$query=mysqli_query($link,"Select * from ideas i inner join users u on u.UserID=i.LeaderID where (Title COLLATE UTF8_GENERAL_CI LIKE '%$data%') or (Keywords COLLATE UTF8_GENERAL_CI LIKE '%$data%') or (Technologies COLLATE UTF8_GENERAL_CI LIKE '%$data%') order by i.Date desc");
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
		else echo "Нема резултати."; 
	}
}
?>
</div>