
<?php 
include_once 'header.php';
include_once 'database.php';
if ($_SESSION['user']==true&&isset($_SESSION['user'])){
$najavenID=$_SESSION["userID"];}
else{$najavenID="";}
$userId=$_GET['id'];
//updateUser
if (isset($_POST['updateUser'])){
	$user=$_POST['username'];
	$first=$_POST['firstname'];
	$last=$_POST['lastname'];
	$em=$_POST['email'];
	if(mysqli_query($link, "Update users set Username='$user', FirstName='$first', LastName='$last', Email='$em' where UserID='$userId'")==false) echo mysqli_error($link);
		
}
//end updateUser

//changePass
$msgPass="";
$color="";
if (isset($_POST['changePass']))
{
	$p=$_POST['oldpass'];
	if (mysqli_num_rows(mysqli_query($link, "Select * from users where UserID='$userId' and Password='$p'"))>0){
	if (!empty($_POST['newpass'])||!empty($_POST['newpass2'])){
		if($_POST['newpass']==$_POST['newpass2'])
		{
			$np=$_POST['newpass'];
			mysqli_query($link, "Update users set Password='$np' where UserID='$userId'");
			$msgPass="Лозинката е променета!"; $color="green";
		}
		else {$msgPass="Лозинките не се совпаѓаат!"; $color="red";}	
	}
	else {$msgPass="Пополнете ги сите полиња!"; $color="red";}
	}
	
	else {$msgPass= "Неточна лозинка!"; $color="red";}

}
//end changePass

//userInfo
$res=mysqli_query($link,"Select * from users where UserID='$userId'");
while ($row=mysqli_fetch_assoc($res))
{
	$username=$row['Username'];
	$email=$row['Email'];
	$firstname=$row['FirstName'];
	$lastname=$row['LastName'];
	$about=$row['About'];
	$password=$row['Password'];
	$img=$row['Image'];

}

//echo $_GET['id'];

//add new project

if (isset($_POST['newProjectSubmit']))
{
	if (!empty($_POST['projectTitle'])&&!empty($_POST['projectDesc'])&&!empty($_POST['projectTech'])&&!empty($_POST['projectYear'])){
	$titlePr=$_POST['projectTitle'];
	$descPr=$_POST['projectDesc'];
	$techPr=$_POST['projectTech'];
	$yearPr=$_POST['projectYear'];
	
	if(mysqli_query($link, "INSERT INTO userprojects(UserID,Title,Description,Technologies,Year) values('$userId','$titlePr','$descPr','$techPr','$yearPr')")==false)
	echo mysqli_error($link);
	else{
		echo "<div id=\"projectAlert\" class=\"alert alert-success alert-reg col-md-4 center\" role=\"alert\"><span class=\"glyphicon glyphicon-ok\"> </span>  Проектот беше додаден. </div>";
			
	}
}
else{
		echo "<div id=\"projectAlert2\" class=\"alert alert-danger alert-reg col-md-4 center\" role=\"alert\"><span class=\"glyphicon glyphicon-remove\"> </span>  Пополнете ги сите полиња. </div>";
			
	}

}
//add new experience

if (isset($_POST['newExpSubmit']))
{
	if (!empty($_POST['expTitle'])&&!empty($_POST['expDesc'])&&!empty($_POST['expOrg'])&&!empty($_POST['expYear'])){
	$titleExp=$_POST['expTitle'];
	$descExp=$_POST['expDesc'];
	$orgExp=$_POST['expOrg'];
	$yearexp=$_POST['expYear'];
	
	if(mysqli_query($link, "INSERT INTO userexperiences(UserID,Title,Organization,Description,Year) values('$userId','$titleExp','$orgExp','$descExp','$yearexp')")==false)
	echo mysqli_error($link);
	else{
		echo "<div id=\"projectAlert\" class=\"alert alert-success alert-reg col-md-4 center\" role=\"alert\"><span class=\"glyphicon glyphicon-ok\"> </span>  Искуството беше додадено. </div>";
			
	}
}
else{
		echo "<div id=\"projectAlert2\" class=\"alert alert-danger alert-reg col-md-4 center\" role=\"alert\"><span class=\"glyphicon glyphicon-remove\"> </span>  Пополнете ги сите полиња. </div>";
			
	}

}
//delete projects
if(isset($_GET['delete']))
{
$id=$_GET['delete'];

$sql = "delete from userprojects where uProjectID='$id'";
mysqli_query($link, $sql);
}
//delete experiences
if(isset($_GET['delete2']))
{
$id=$_GET['delete2'];

$sql = "delete from userexperiences where uExperienceID='$id'";
mysqli_query($link, $sql);
}
?>

 <div class="container">
        <section style="padding-bottom: 50px; padding-top: 120px;">
            <div class="row">
                <div class="col-md-4">
                    <img src="images/UserImg/<?php echo $img; ?>" style="margin-left: 25%" width="155px" height="155px" class="img-responsive center"  />
                    <br />
                    <br />
                    </div>
                  <div class="col-md-8">
                  	  <div class="alert alert-info" style="height: 100%;background-color: #BEE3F5 !important;border-color:#BEE3F5 !important;color:#666 !important ">
                        <h2><?php echo $firstname.' '.$lastname;  ?> </h2>
                        <h4><?php echo $username; ?> </h4>
                        <p>
                           <?php echo $about; ?>
                        </p>
                    </div>
                    <div>
                        <a href="#" class="btn btn-social btn-facebook">
                            <i class="fa fa-facebook"></i>&nbsp; Facebook</a>
                        <a href="#" class="btn btn-social btn-google">
                            <i class="fa fa-google-plus"></i>&nbsp; Google</a>
                        <a href="#" class="btn btn-social btn-twitter">
                            <i class="fa fa-twitter"></i>&nbsp; Twitter </a>
                        <a href="#" class="btn btn-social btn-linkedin">
                            <i class="fa fa-linkedin"></i>&nbsp; Linkedin </a>
                        <a href="mailto:<?php echo $email; ?>" class="btn btn-social btn-google" data-toggle="tooltip" title="<?php echo $email; ?>">
                            <i class="fa fa-envelope-o"></i>&nbsp; Email </a>
                    </div><br />
                  </div>
                
              </div>
              <!--end of row-->
              <?php if ($userId==$najavenID) {?>
              <div class="row">
              	<div class="col-md-4">
              		  <form action="#" method="post">
                    <label>Корисничко име</label>
                    <input type="text" class="form-control" name="username"  value=<?php echo $username; ?>>
                    <label>Име</label><label style="margin-left: 42%">Презиме</label><br />
                    <input type="text" class="form-control" style="display:inline !important; width: 49%;" name="firstname" value=<?php echo $firstname;  ?>>
                    <input type="text" class="form-control" style="display:inline !important; width:49.5%;" name="lastname" value=<?php echo $lastname;  ?>><br />
                    <label>Емаил</label>
                    <input type="text" class="form-control" name="email" value=<?php echo $email; ?>>
                    <br>
                    <button class="btn btn-primary" type="submit" name="updateUser">Промени податоци</button>
                    <br /><br/>
                    </form>
              	</div>
                <div class="col-md-8">
                    <div class="form-group col-md-8">
                        <form action="#" method="post">
                        <label>Внеси стара лозинка:</label>
                        <input name="oldpass" type="password" class="form-control">
                        <label>Внеси нова лозинка:</label>
                        <input name="newpass" type="password" class="form-control">
                        <label>Потврди нова лозинка:</label>
                        <input name="newpass2" type="password" class="form-control" />
                        <br>
                        <button type="submit" class="btn btn-primary"  name="changePass">Промени лозинка</button>
                        <label  style="margin-left:12%; color: <?php echo $color; ?>"><?php echo $msgPass; ?></label>
                        </form>
                    </div>
                </div>
            </div>
            <?php } ?>
            <!-- ROW END -->


        </section>
        <!-- SECTION END -->
        <!-- PROJECTS -->
        <h4>Проекти</h4>
        
        <?php if ($userId==$najavenID) {?>
        <ul>
        <li class="pull-right btn btn-primary" style="margin-top: -3.5%"  data-toggle="modal" data-target=".bs-modal-sm3">Додај проект</li>
        </ul>
       
        <?php } $sql=mysqli_query($link, "select * from userprojects where UserID='$userId'");
		while($row=mysqli_fetch_assoc($sql))
		{ 
			$title=$row['Title'];
			$desc=$row['Description'];
			$tech=$row['Technologies'];
			$year=$row['Year'];
			$prId=$row['uProjectID'];
			?>
        <div class="panel panel-default record" id="record-',$prId,'">
        	<div class="panel-heading"><?php echo "<b>".$title."</b> <br />".$year; ?> </div>
        	<div class="panel-body"><?php echo $desc."<br />Користени технологии: ".$tech; ?></div>
        	 <?php if ($userId==$najavenID) {?>
        <a href="?id=<?php echo $userId."&delete=".$prId; ?>" class="delete"><span class="glyphicon glyphicon-remove pull-right" style="cursor:pointer; margin-top: -2%;margin-right: 1%"></span></a>
       	<?php } ?>
       	</div>
        <?php } ?>
    <br />
    <!-- PROJECTS END-->
     <!-- EXPERIENCES -->
        <h4>Искуства</h4>
         <?php if ($userId==$najavenID) {?>
        <ul>
        	<li class="pull-right btn btn-primary" style="margin-top: -3.5%"  data-toggle="modal" data-target=".bs-modal-sm4">Додај искуство</li></ul>
        </ul>
        
        <?php } $sql=mysqli_query($link, "select * from userexperiences where UserID='$userId'");
		while($row=mysqli_fetch_assoc($sql))
		{ 
			$title=$row['Title'];
			$desc=$row['Description'];
			$org=$row['Organization'];
			$year=$row['Year'];
			$expId=$row['uExperienceID'];
			?>
        <div class="panel panel-default">
        	<div class="panel-heading"><?php echo "<b>".$title."</b> <br />".$org.", ".$year; ?> </div>
        	<div class="panel-body"><?php echo $desc; ?></div>
        	 <?php if ($userId==$najavenID) {?>
        <a href="?id=<?php echo $userId."&delete2=".$expId; ?>" class="delete2"><span class="glyphicon glyphicon-remove pull-right" style="cursor:pointer; margin-top: -2%;margin-right: 1%"></span></a>
       	<?php } ?>
        </div>
        <?php } ?>
    </div>
    <!-- EXPERIENCES END-->
   </div>
    <!-- CONTAINER END -->
    
    <!-- newProject -->
  <div class="modal fade bs-modal-sm3" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-margin2">
    <div class="modal-content col-md-12 col-sm-12 col-xs-6" style="background-color:rgba(255,255,255,.9)">
        <br>
        
      <div class="modal-body">
         <!-- Nav tabs -->
									  <ul class="nav nav-pills" style="border-bottom: 1px solid #BEE3F5" role="tablist">
									    <li role="presentation" class="active"><a href="#Login" aria-controls="home" role="tab" data-toggle="tab" style="color: #666;">Нов проект</a></li>
									   </ul>
									
									  <!-- Tab panes -->
									  <div class="tab-content">
									    <div role="tabpanel" class="tab-pane active" id="Login"><br />
									    	<form action="#" method="post">
                                             <input class="form-control" type="text" placeholder="Наслов" name="projectTitle"><br />
                                             <textarea class="form-control"  placeholder="Опис" rows="4" name="projectDesc"></textarea><br />
                                              <input class="form-control" type="text" placeholder="Технологии" name="projectTech"><br />
                                             <input class="form-control" type="text" placeholder="Година" name="projectYear"><br />
                                             <div class="center"><input class="btn" style="color: white; background-color: #5CB8E6;" type="submit" value="Додај" name="newProjectSubmit"/></div><br />
                                             
                                             </form>
                                        </div>
									  
									  </div>
       
    </div>
      </div>
     
    </div>
  </div>
     <!-- newExperience -->
  <div class="modal fade bs-modal-sm4" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-margin2">
    <div class="modal-content col-md-12 col-sm-12 col-xs-6" style="background-color:rgba(255,255,255,.9)">
        <br>
        
      <div class="modal-body">
         <!-- Nav tabs -->
									  <ul class="nav nav-pills" style="border-bottom: 1px solid #BEE3F5" role="tablist">
									    <li role="presentation" class="active"><a href="#Login" aria-controls="home" role="tab" data-toggle="tab" style="color: #666;">Ново искуство</a></li>
									   </ul>
									
									  <!-- Tab panes -->
									  <div class="tab-content">
									    <div role="tabpanel" class="tab-pane active" id="Login"><br />
									    	<form action="#" method="post">
                                             <input class="form-control" type="text" placeholder="Позиција" name="expTitle"><br />
                                             <input class="form-control" type="text" placeholder="Организација" name="expOrg"><br />
                                             <textarea class="form-control"  placeholder="Опис" rows="4" name="expDesc"></textarea><br />                                              
                                             <input class="form-control" type="text" placeholder="Година" name="expYear"><br />
                                             <div class="center"><input class="btn" style="color: white; background-color: #5CB8E6;" type="submit" value="Додај" name="newExpSubmit"/></div><br />
                                             
                                             </form>
                                        </div>
									  
									  </div>
       
    </div>
      </div>
     
    </div>
  </div>
  <!-- newProject end-->
  
  
 <?php include_once 'footer.php'; ?>

   
    
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script> 
    <script>
	  
	  $('li.dropdown.mega-dropdown a').on('click', function (event) {
    	$(this).parent().toggleClass('open');
    
	  });
	  $('body').on('click', function (e) {
    	if (!$('li.dropdown.mega-dropdown').is(e.target) && $('li.dropdown.mega-dropdown').has(e.target).length === 0 && $('.open').has(e.target).length === 0) {
        	$('li.dropdown.mega-dropdown').removeClass('open');
    	}
	  });
	  
    </script>
    <script>
	$(document).ready(function(){
	    $('[data-toggle="tooltip"]').tooltip();   
	});
	</script>
	<script>
		setTimeout(fade_out, 3000);
		function fade_out() {
		  $("#projectAlert").fadeOut().empty();
		  $("#projectAlert2").fadeOut().empty();
		}
	</script>
	<script>
	$(function() {

		$(".delete").click(function(){
		var del_id = element.attr("id");
		var info = 'id=' + del_id;
		
		$.ajax({
		type: "GET",
		url: "userProfile.php",
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
   <script>
	$(function() {

		$(".delete2").click(function(){
		var del_id = element.attr("id");
		var info = 'id=' + del_id;
		
		$.ajax({
		type: "GET",
		url: "userProfile.php",
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

	
	

</body>
</html>

