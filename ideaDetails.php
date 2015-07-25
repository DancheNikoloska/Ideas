<?php 
include_once 'header.php';
include_once 'database.php';
$ideaId=$_GET['ideaId'];
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
  	$newRating= $_POST['submitRate'];
	$newRating= number_format(($rating*$ratingsNo+$newRating)/$newRatingsNo,1);
  	$sql= "Update ideas set Rating='".$newRating."' where IdeaID=".$ideaId;
	mysqli_query($link,$sql);
	$sql2="Update ideas set RatingsNo='".$newRatingsNo."' where IdeaID=".$ideaId;
	mysqli_query($link,$sql2);
	$rating=$newRating;
  }


?>
<br /><br />
<div class="container" style="width: 70%;">
<div class="row col-md-12">
	<div class="col-md-6" style="margin-top: 15%">
		
	<div class="panel panel-info panel1" >
	  <div class="panel-heading panel2">
	    <h3 class="panel-title" style="color:white !important;"><?php echo $title; ?></h3>
	  </div>
	  <div class="panel-body">
	    <?php echo nl2br($desc); ?>
	    <h5 style="color:gray"><i><?php echo "Клучни зборови: " . $keyw; ?></i></h5>
	  </div>
	</div>
	</div>
	<div class="col-md-6" style="margin-top: 15%">
	 <ul class="nav nav-pills" style="border-bottom: 1px solid #e84c3d;"  role="tablist">
	 	<li style="box-sizing: border-box;margin-bottom: -1px;" class="active" role="presentation"><a data-toggle="tab" href="#details" style="color: gray">Детали</a></li>
	 	<li role="presentation" ><a data-toggle="tab" href="#comments" style="color: gray">Коментари</a></li>
	 </ul>
	 
	 <div class="tab-content">
	    <div role="tabpanel" class="tab-pane active" id="details" style="margin-top: 4%">
	     	<h5 class="pull-left" style="margin-top: 4%;">Објавено од: <a href="#"><?php echo $leaderName." ".$leaderLast." (".$leader.")"; ?></a> </h5>
	    	<h5 class="pull-left" style="margin-top: 10%;margin-left: -18%"><?php echo $date; ?></h5>
	    	<a class="pull-right" href="userProfile.php?id=<?php echo $leaderID; ?>" ><img src="images/UserImg/<?php echo $img; ?>" class="icon-md" ></a>
	   		
	   		<br /><br /><br />
	   		<hr />
	   		<h5>Технологии: <?php echo $tech; ?></h5>
	   		<hr />
	   		
	   		<div class="row">
	   		
	   		<div style="display:inline-block; float:left; color: #fde16d; text-shadow: 0 0 1px rgba(0,0,0,.7); font-size: 4em;" class="col-md-2 glyphicon glyphicon-star">
	   		
	   		<p class="center" style="position:relative; color:black; font-size: 25%; float: left;margin-top: -85%; margin-left: 32%" " ><?php echo $rating; ?></p>
	   		
	   		</div>
	   		
	   		<div class="col-md-10">
	   		<div style="display: inline-block">
	   		<span>Оцени: </span>
	   		
	   		</div>
	   		<div style="display: inline-block">
	   		<form action="" method="post" style="display: inline-block">
			 <input style="display: inline;" value="<?php echo $rating; ?>" id="input-1" type="submit" class="rating" name="submitRate" data-min="0" data-max="5" data-step="1">
			
			</form>
			</div>
			<div><span>Рејтинг: <?php echo $rating."/5". " од ".$ratingsNo. " корисници"; ?></span></div>
			</div>
			
	    	</div>
	    <div role="tabpanel" class="tab-pane" id="comments">Коментари таб</div>
	    
    </div>
	</div>




</div>
</div>