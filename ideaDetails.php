<?php 
include_once 'header.php';
if ($_SESSION['user']==true&&isset($_SESSION['user'])){


include_once 'database.php';
$ideaId=$_GET['ideaId'];
$najavenID=$_SESSION["userID"];
//echo $ideaId;

$res=mysqli_query($link, "Select * from ideas i inner join users u on u.UserID=i.LeaderID where i.IdeaID='$ideaId'");
while ($row=mysqli_fetch_assoc($res))
{
	$ideaId=$row['IdeaID'];
	
	$title=$row['Title'];
	$desc=$row['Description'];
	$keyw=$row['Keywords'];
	$leader=$row['Username'];
	$leaderName=$row['FirstName'];
	$leaderLast=$row['LastName'];
	$img=$row['Image'];
	$date=$row['Date'];
	$leaderID=$row['LeaderID'];
	$tech=$row['Technologies'];
	$rating=$row['Rating'];
	$ratingsNo=$row['RatingsNo'];
	$newRatingsNo=$ratingsNo+1;
}

 if(isset($_POST["submitRate"])){
  	$newRating2= $_POST['rate'];
	
	$sel=mysqli_query($link,"select * from ratinglike where UserID=".$najavenID." and IdeaID=".$ideaId);
	if (mysqli_num_rows($sel)==0){
	
	$newRating= number_format(($rating*$ratingsNo+$newRating2)/$newRatingsNo,1);
  	$sql= "Update ideas set Rating='".$newRating."' where IdeaID=".$ideaId;
	mysqli_query($link,$sql);
	$sql2="Update ideas set RatingsNo='".$newRatingsNo."' where IdeaID=".$ideaId;
	mysqli_query($link,$sql2);
	$rating=$newRating;
	$sql3="Insert into ratinglike(UserID,IdeaID,RateValue) values('$najavenID','$ideaId','$newRating2')";
	mysqli_query($link,$sql3);
	$ratingsNo=$newRatingsNo;
	$oceniMsg="Благодариме!";
	}
  }

	if (isset($_POST["comButton"]))
	{
		$com=$_POST['com'];
		mysqli_query($link, "INSERT INTO comments(Text,idUser,idIdea,Time) values('$com','$najavenID','$ideaId',NOW())");
	}
	
	//delete comments
	
	if(isset($_GET['deletecom']))
	{
	$id=$_GET['deletecom'];
	
	$sql = "delete from comments where commentID='$id'";
	mysqli_query($link, $sql);
	}
	
?>
<br /><br />
<div class="container" style="width: 70%;">
<div class="row col-md-12">
	<div class="col-md-7" style="margin-top: 15%">
		
	<div class="panel panel-info panel1" >
	  <div class="panel-heading panel2">
	    <h3 class="panel-title" style="color:#666 !important;"><?php echo $title; ?></h3>
	  </div>
	  <div class="panel-body">
	  <h5 class="pull-left" style="margin-top: 4%;">Објавено од: <a href="userProfile.php?id=<?php echo $leaderID; ?>"><?php echo $leaderName." ".$leaderLast; ?></a> </h5><br /><br />
	   <!--rating  -->
	   <div class="row">
	   			   		
	  	<div class="col-md-12">
	   		  
	   		<div class="pull-left" style="display: inline-block; margin-top: 1.3%"><span>Оцена:  &nbsp;&nbsp;</span></div>	   		
	   		
	   		<div style="display: inline-block">
	   		<form	 action="" method="post" style="display: inline-block">
	   		<span style="display: inline-block">	
			 <input name="rate" style="display: inline-block;" value="<?php echo $rating; ?>" id="input-1"  class="rating pull-left"  data-min="0" data-max="5" data-step="1">
			</span> 
			
			<?php 
			$sel=mysqli_query($link,"select * from ratinglike where UserID=".$najavenID." and IdeaID=".$ideaId);
			if (mysqli_num_rows($sel)==0){
			
			if ($najavenID!=$leaderID) {?>
			 
			 <input type="submit" class="btn btn-primary"  style="display:inline-block; "  name="submitRate" value="Оцени">
			
			<?php }} ?>
			<div  style="display: inline-block"><?php echo "&nbsp (". $ratingsNo. " оцени)"; ?></span> 
			</form>
			</div>
			</div>
			
			
		
			
		</div>
		</div>
		<br />
			
	   <!--end rating -->
	    <?php echo nl2br($desc); ?>
	    <h5 style="color:gray"><i>Технологии: <?php echo $tech; ?></i></h5>
	    <h5 style="color:gray"><i><?php echo "Клучни зборови: " . $keyw; ?></i></h5>
	    <input type="button" class="pull-right btn btn-primary" value="Аплицирај" />
	   
	  </div>
	</div>
	</div>
	<div class="col-md-5" style="margin-top: 15%">
	 <ul class="nav nav-pills" style="border-bottom: 1px solid #BEE3F5;"  role="tablist">
	 	<li role="presentation" class="active" ><a data-toggle="tab" href="#comments" style="color: #666 !important;background-color: #BEE3F5 !important">Коментари</a></li>
	 </ul>
	 
	<!-- comments -->
	<br />
	<form action="#" method="post">
		<textarea placeholder="Вашиот коментар тука..." rows="5" name="com" style="width:100%"></textarea><br /><br />
		<input type="submit" value="Коментирај" name="comButton" style="width: 30%" class="btn btn-primary pull-right"/>
	</form>
	<br /><br /><br />
	<div id="result_p">
		<?php 
		$sql=mysqli_query($link, "select commentID,UserID,Text,Username,date(Time) as d  from comments c inner join users u on u.UserID=c.idUser where idIdea='$ideaId' order by Time desc limit 0,2");
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
		<input type="hidden" id="result_no" value="2">
		</div>
		  <input type="button" class="btn btn-primary pull-right" style="width: 30%" value="Повеќе" onclick="loadmoreC()" />
		
	


	<!-- comments end -->
      
	</div>
	



</div>

</div>
<br /><br /> <br />
 <script>
	$(function() {

		$(".deletecom").click(function(){
		var del_id = element.attr("id");
		var info = 'id=' + del_id;
		
		$.ajax({
		type: "GET",
		url: "ideaDetails.php",
		data: info,
		success: function(){
		}
		});
		$(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");
		
		return false;
		});
		});
   </script>
   <script type="text/javascript">
	
	function loadmoreC()
		{
		  var val = document.getElementById("result_no").value;
		  $.ajax({
		  type: 'post',
		  url: 'moreComments.php?ideaId='.$ideaId,
		  data: {
		    getresult:val
		  },
		  success: function (response) {
		    var content = document.getElementById("result_p");
		    content.innerHTML = content.innerHTML+response;
		
		    // We increase the value by 2 because we limit the results by 2
		    document.getElementById("result_no").value = Number(val)+2;
		  }
		  });
		}
	</script>

 <?php include_once 'footer.php'; ?>
<?php } 
else header("Location: index.php");
die();
?>


