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
	
//apliciraj

if (isset($_POST['apliciraj']))
{
	if (mysqli_query($link, "Insert into applications values('$najavenID','$ideaId',0)")==false)
	echo mysqli_error($link);
	
}

//cancel application
if (isset($_POST['cancelApp']))
{
	if (mysqli_query($link, "Delete from applications where UserID='$najavenID' and IdeaID='$ideaId'")==false)
	echo mysqli_error($link);
	
}

 //accept application
		if (isset($_POST['accept']))
		{
			$user=$_REQUEST['user'];
			$idea=$_REQUEST['ideaId'];
			if (mysqli_query($link, "insert into team values('$idea','$user',3)")==false)
			echo mysqli_error($link);	
			if (mysqli_query($link, "delete from applications where UserID='$user' and IdeaID='$idea'")==false)
			echo mysqli_error($link);	
			
		}
//deny application
		if (isset($_POST['deny']))
		{
			$user=$_REQUEST['user'];
			$idea=$_REQUEST['ideaId'];
			
			if (mysqli_query($link, "delete from applications where UserID='$user' and IdeaID='$idea'")==false)
			echo mysqli_error($link);	
		}
	
?>

<!-- like and share button-->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.4";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!-- like and share button end -->
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
	  	<?php  if ($najavenID!=$leaderID) {?>
	  	<form action="" method="post">
	    <?php 
	    $app=mysqli_query($link, "select * from applications where UserID='$najavenID' and IdeaID='$ideaId'");
		if (mysqli_num_rows($app)>0){
	    ?>
	    <input type="submit" name="cancelApp" class="pull-right btn btn-primary" value="Откажи"/>
	    <?php } 
		else if (mysqli_num_rows($app)==0){
	    ?>
	    <input type="submit" name="apliciraj" class="pull-right btn btn-primary" value="Аплицирај" />
	    <?php } ?>
	    </form>
	    <?php } ?>
	   
	  </div>
	</div>
	<!-- like and share button-->
	<div class="fb-share-button" data-href="http://localhost/IdeasD/ideaDetails.php?ideaId=<?php echo $ideaId; ?>" data-layout="button_count"></div>
	<!-- twitter button -->
	
	<br /><br />
	<!-- applications from users -->
	<?php  if ($najavenID==$leaderID) {?>
	<h4>Аплицирале:</h4><hr>
	<div class="col-md-12">
	<?php 
	$appUsers=mysqli_query($link, "select * from applications a inner join users u on u.UserID=a.UserID where a.IdeaID='$ideaId'");
	while ($row=mysqli_fetch_assoc($appUsers)){
		$userF=$row['FirstName'];
		$userL=$row['LastName'];
		$uId=$row['UserID'];
	?>
	<div class="row">
		<a style="font-size: 1.2em" href="userProfile.php?id=<?php echo $row['UserID']; ?>"><?php echo $userF." ".$userL;  ?></a>
		<div class="pull-right">
		<form action="?ideaId=<?php echo $ideaId; ?>&user=<?php echo $uId; ?>" method="post">
		<!-- MOZE DA SE DODADE DA SE ISPRAKJA EMAIL KAKO ODGOVOR-->
		<a href="" data-toggle="tooltip" title="Прифати"><button type="submit" name="accept"><span class="glyphicon glyphicon-ok"></span></a></button>
		<a href="" data-toggle="tooltip" title="Одбиј"><button type="submit" name="deny"><span class="glyphicon glyphicon-remove" style="color:red"></span></a></button>
		</form>
		</div>
	</div><hr>
	<?php
	
	 
	}
	 
	 
	 ?>
	<!-- applications from users end -->
	
	</div>
	<?php } ?>
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
		  url: ('moreComments.php?ideaId=<?php echo $ideaId; ?>'),
		  dataType: 'html',
		  data: {
		    "getresult":val
		  },
		  success: function (response) {
		  	//alert(response);
		    var content = document.getElementById("result_p");
		    content.innerHTML = content.innerHTML+response;
		    
		
		    // We increase the value by 2 because we limit the results by 2
		    document.getElementById("result_no").value = Number(val)+2000000;
		  }
		  });
		}
	</script>
	<script>
	$(document).ready(function(){
	    $('[data-toggle="tooltip"]').tooltip(); 
	});
	</script>

 <?php include_once 'footer.php'; ?>
<?php } 
else header("Location: index.php");
die();
?>


