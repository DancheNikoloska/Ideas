<?php
session_start();
include_once 'database.php';
$najavenID=$_SESSION['userID'];
$ideaId=$_GET['ideaId'];
$no = $_POST['getresult'];
//echo $ideaId;
 
		$sql=mysqli_query($link, "select commentID,UserID,Text,Username,date(Time) as d  from comments c inner join users u on u.UserID=c.idUser where idIdea='$ideaId' order by Time desc limit $no,2");
		while($row=mysqli_fetch_assoc($sql))
		{ 
			$userId=$row['UserID'];
			$comId=$row['commentID'];
			
			?>
			<div>
				<?php if ($userId==$najavenID) {?>
				<a href="?ideaId=<?php echo $ideaId."&deletecom=".$comId; ?>"  style="color:red;"><span class="glyphicon glyphicon-remove-circle"></span></a>&nbsp;&nbsp; <?php } ?>
				<span><?php echo '<i>('.$row['d'].')</i> '.'<b>'. $row['Username'].':</b>'; ?></span><br />
				<span><?php echo $row['Text'] ?></span><br /><br />
				
			</div>
			
		
		<?php } ?>