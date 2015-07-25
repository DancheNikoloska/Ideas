<?php 
include_once 'header.php';
include_once 'database.php';
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




?>

 <div class="container">
        <section style="padding-bottom: 50px; padding-top: 120px;">
            <div class="row">
                <div class="col-md-4">
                    <img src="images/UserImg/<?php echo $img; ?>" style="margin-left: 15%" width="155px" height="155px" class="img-responsive center"  />
                    <br />
                    <br />
                    </div>
                  <div class="col-md-8">
                  	  <div class="alert alert-info" style="height: 100%">
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
                    <button class="btn btn-success" type="submit" name="updateUser">Промени податоци</button>
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
                        <button type="submit" class="btn btn-warning" name="changePass">Промени лозинка</button>
                        <label  style="margin-left:12%; color: <?php echo $color; ?>"><?php echo $msgPass; ?></label>
                        </form>
                    </div>
                </div>
            </div>
            <!-- ROW END -->


        </section>
        <!-- SECTION END -->
    </div>
    <!-- CONATINER END -->
  
    <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    &copy; 2013 <a target="_blank" href="http://shapebootstrap.net/" title="Free Twitter Bootstrap WordPress Themes and HTML templates">ShapeBootstrap</a>. All Rights Reserved.
                </div>
                <div class="col-sm-6">
                    <img class="pull-right" src="images/shapebootstrap.png" alt="ShapeBootstrap" title="ShapeBootstrap">
                </div>
            </div>
        </div>
    </footer><!--/#footer-->

   
    
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
</body>
</html>

