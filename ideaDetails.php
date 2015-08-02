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
	  <h5 class="pull-left" style="margin-top: 4%;">Објавено од: <a href="userProfile.php?id="><?php echo $leaderName." ".$leaderLast; ?></a> </h5><br /><br />
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
	 
	
      
	</div>
	



</div>

</div>
<br /><br /> <br />
 <?php include_once 'footer.php'; ?>
<?php } 
else header("Location: index.php");
die();
?>


