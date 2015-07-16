<?php
include 'database.php';
session_start();
if (!isset($_SESSION['user'])){
$_SESSION['user']="";
}

//Registration
if (isset($_POST['signUpButton']))
{
	$name=$_POST['name'];
	$username=$_POST['username'];
	$lastname=$_POST['lastname'];
	$email=$_POST['email'];
	$about=$_POST['about'];
	$password=$_POST['password'];
	$image=$_FILES['image']['name'];
	$type=1;	
if (!empty($_POST['name'])&&!empty($_POST['lastname'])&&!empty($_POST['username'])&&!empty($_POST['email'])&&!empty($_POST['about']))
{
$sql="INSERT INTO users(Username, Email, FirstName, LastName, About,Password,Type,Image) values('$username','$email','$name','$lastname','$about','$password',$type,'$image')";
if(mysqli_query($link, $sql)==false)
echo mysqli_error($link);
else {
	{
		echo "<div class=\"alert alert-success alert-reg col-md-4 center\" role=\"alert\"><span class=\"glyphicon glyphicon-ok\"> </span>  Регистрацијата беше успешна!</div>";
	}
}
}
}

//Login
if (isset($_POST['loginButton']))
{
	$u=$_POST['username1'];
	$p=$_POST['password1'];
	if (!empty($_POST['username1'])&&!empty($_POST['password1']))
	{
		$sql="SELECT * FROM users where Username='$u' and Password='$p'";
		$res=mysqli_query($link, $sql);
		if (mysqli_num_rows($res)>0)
		{
			$row=mysqli_fetch_assoc($res);
			$_SESSION["user"]=$row['Username'];
			$_SESSION["userID"]=$row['UserID'];
		}
		
	}
	
}

//addIdea
if (isset($_POST['addIdeaSubmit'])){
	
	if ($_SESSION['userID']!="") 
	{
		
		$id=$_SESSION['userID'];
		$title=$_POST['title'];
		$desc=$_POST['desc'];
		$tech=$_POST['tech'];
		$keyw=$_POST['keyw'];
		$cate=$_POST['cate'];
		$date=date("Y-m-d");
		$c=mysqli_query($link, "select CategoryID from category where Title='$cate'");
		while ($row=mysqli_fetch_assoc($c))
		{$cateID=$row['CategoryID'];}
		$sql2="INSERT INTO ideas(LeaderID,Title,Description,CategoryID,Technologies,Keywords,Approved,Date) 
		values($id,'$title','$desc',$cateID,'$tech','$keyw',0,'$date')";
		if(mysqli_query($link, $sql2)==false)
		{
			echo mysqli_error($link);
		}
		else {
			{
		echo "<div class=\"alert alert-success alert-reg col-md-4 center\" role=\"alert\"><span class=\"glyphicon glyphicon-ok\"> </span>  Идејата беше додадена. </div>";
			}
		}
	}
	else echo "error";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Имам идеја</title>
     <script src="js/jquery.js"></script>
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
     <link href="css/test.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
   
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
    
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head><!--/head-->

<body data-spy="scroll" data-target="#navbar" data-offset="0">
	
    <header id="header" role="banner">
    	
        <div class="container">
            <div id="navbar" class="navbar navbar-default">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html"></a>
                </div>
                <div class="collapse navbar-collapse">
                	
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#main-slider"><i class="icon-home"></i></a></li>
                        <li style=" <?php if ($_SESSION['user']=="") echo 'display:none'; ?>"><a href="#addIdea" data-toggle="modal" data-target=".bs-modal-sm">Додај идеја</a></li> 
                        <li><a href="#portfolio">Portfolio</a></li>
                        <li><a href="#pricing">Pricing</a></li>
                        <li><a href="#about-us">About Us</a></li>
                        <li style=" <?php if ($_SESSION['user']!="") echo 'display:none'; ?>"><a href="#signin" data-toggle="modal" data-target=".bs-modal-sm2">Најава</a></li> 
                        <li class="dropdown mega-dropdown" style=" <?php if ($_SESSION['user']=="") echo 'display:none'; ?>"><a href="#" class="dropdown-toggle">Најавени сте како: <?php echo $_SESSION["user"] ?></a>
                        	<div style="width: 100%" id="logout" class="dropdown-menu">
                        	<ul>
                        		<li><a href="">Мојот профил</a></li>
                        		<li><a href="logout.php">Одјави се</a></li>
                        	</ul>
                        	</div>
                        </li>
                       
                        
                </div>
            </div>
        </div>
    </header><!--/#header-->

  	  <!-- ModalNewIdea -->
<div class="modal fade bs-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-margin">
    <div class="modal-content" style="background-color:rgba(255,255,255,.9)">
        <br>
        <div class="bs-example bs-example-tabs">
            <ul id="myTab" class="nav nav-tabs">
              <li class="active lead"><a href="#addIdea" data-toggle="tab" >Додај идеја</a></li>
              
            </ul>
        </div>
      <div class="modal-body">
        <div id="myTabContent" class="tab-content">
     
             <div class="box" style="background-color:rgba(255,255,255,.05)">
                               
                <div class="row">
                 
				 <form class="form-horizontal" action="#" method="post">
				 	 <div class="form-group">
				    <label class="col-sm-2 control-label">Категорија</label>
				    <div class="col-sm-4">
				      <select class="form-control" name="cate">
				      	<?php 
				      	$query=mysqli_query($link, "select * from category");
						while ($row=mysqli_fetch_assoc($query))
						{
						echo "<option>$row[Title]</option>";	
						}
				      	
				      	?>
				      </select>
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-2 control-label">Тема</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="Tema" name="title">
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-2 control-label">Опис</label>
				    <div class="col-sm-10">
				      <textarea class="form-control" id="opis" name="desc"></textarea>
				    </div>
				  </div>
				  
				    <div class="form-group">
				    <label class="col-sm-2 control-label">Технологии</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="tehnologii" name="tech">
				    </div>
				  </div>
				    <div class="form-group">
				    <label class="col-sm-2 control-label">Клучни зборови</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="keywords" name="keyw">
				    </div>
				  </div>
				 <br />
				  <div class="form-group center">
				    <div class="col-md-10 col-md-offset-1">
				      <button type="submit" name="addIdeaSubmit" class="btn btn-info">Внеси</button>
				       <button type="button" class="btn btn-danger" data-dismiss="modal">Откажи</button>
				    </div>
				  </div>
				</form>
              
            </div> 
        </div>
        </div>
       
    </div>
      </div>
     
    </div>
  </div>
</div>
<!-- modalLogin End -->
 	  <!-- Modal -->
<div class="modal fade bs-modal-sm2" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-margin2">
    <div class="modal-content col-md-12 col-sm-12 col-xs-6" style="background-color:rgba(255,255,255,.9)">
        <br>
        
      <div class="modal-body">
         <!-- Nav tabs -->
									  <ul class="nav nav-tabs" role="tablist">
									    <li role="presentation" class="active"><a href="#Login" aria-controls="home" role="tab" data-toggle="tab">Најава</a></li>
									    <li role="presentation"><a href="#Register" aria-controls="profile" role="tab" data-toggle="tab">Регистрација</a></li>
									    
									  </ul>
									
									  <!-- Tab panes -->
									  <div class="tab-content">
									    <div role="tabpanel" class="tab-pane active" id="Login"><br />
									    	<form action="#" method="post">
                                             <input class="form-control" type="text" placeholder="Корисничко име" name="username1"><br />
                                             <input class="form-control" type="text" placeholder="Лозинка" name="password1"><br />
                                             <div class="center"><input class=" btn btn-primary" type="submit" value="Најави се" name="loginButton"/></div><br />
                                             </form>
                                        </div>
									    <div role="tabpanel" class="tab-pane" id="Register"><br />
									    	<form action="#" method="post" enctype="multipart/form-data">
									    	 <input class="form-control" type="text" id="name" name="name" placeholder="Име"><br />
                                             <input class="form-control" type="text" id="lastname" name="lastname" placeholder="Презиме"><br />
                                           	<input class="form-control" type="text" id="username" name="username" placeholder="Корисничко име"><br />
                                            <input class="form-control" type="password" id="password" name="password" placeholder="Лозинка"><br />
                                             <input class="form-control" type="email" id="email" name="email" placeholder="Емаил"><br />
                                             <textarea class="form-control" type="text" id="about" name="about" placeholder="За Вас"></textarea><br />
                                             <input readonly="true" id="fileText">
											 <button class="btn btn-info" onclick="document.getElementById('fileID').click(); return false;" />Слика</button>
												<input type="file" name="image" id="fileID" onchange="document.getElementById('fileText').value= this.value" style="visibility: hidden;" />
                                             <div class="center"><input class="btn btn-primary" type="submit" value="Регистрирај се" name="signUpButton"/></div><br />
                                             </form>
									    </div>
									  </div>
       
    </div>
      </div>
     
    </div>
  </div>
</div>
<!-- modalLoginEnd -->
    <section class="slider" style="margin:auto">
		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		  <!-- Indicators -->
		  <ol class="carousel-indicators">
		    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
		    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
		    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
		  </ol>
		
		  <!-- Wrapper for slides -->
		  <div class="carousel-inner" role="listbox">
		    <div class="item active">
		      <img class="img img-responsive" src="images/bg3.jpg" alt="Responsive image" style="margin:auto">
		      <div class="carousel-caption">
		        
		      </div>
		    </div>
		    <!-- <div class="item ">
		      <img src="images/bg2.jpg" alt="">
		      <div class="carousel-caption">
		        
		      </div>
		    </div>-->
		   
		  	    
		  </div>
		
		  <!-- Controls -->
		  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
		    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		    <span class="sr-only">Previous</span>
		  </a>
		  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
		    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		    <span class="sr-only">Next</span>
		  </a>
		</div>
    </section><!--/#main-slider-->

    <section id="services">
        <div class="container">
            <div>
                <div class="row col-md-12" id="ideasList">
                    <?php
                    
					$query=mysqli_query($link,"Select * from ideas i inner join users u on u.UserID=i.LeaderID order by i.Date desc limit 6");
					while ($row=mysqli_fetch_assoc($query)){
						?>
						<div class="col-md-4 col-sm-6">
                        <div class="center"> 
                            <img src="images/UserImg/<?php echo $row['Image'] ?>" class="icon-md">
                            <h4><?php echo $row['Title'] ?></h4>
                            <p><?php echo substr($row['Description'],0,30)?></p>
                        </div>
                    </div>
					<?php } ?>
                    
                  
                   
                </div><!--/.row-->
            </div><!--/.box-->
        </div><!--/.container-->
    </section><!--/#services-->

    <section id="portfolio">
        <div class="container">
            <div class="box">
                <div class="center gap">
                    <h2>Portfolio</h2>
                    <p class="lead">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac<br>turpis egestas. Vestibulum tortor quam, feugiat vitae.</p>
                </div><!--/.center-->
                <ul class="portfolio-filter">
                    <li><a class="btn btn-primary active" href="#" data-filter="*">All</a></li>
                    <li><a class="btn btn-primary" href="#" data-filter=".bootstrap">Bootstrap</a></li>
                    <li><a class="btn btn-primary" href="#" data-filter=".html">HTML</a></li>
                    <li><a class="btn btn-primary" href="#" data-filter=".wordpress">Wordpress</a></li>
                </ul><!--/#portfolio-filter-->
                <ul class="portfolio-items col-4">
                    <li class="portfolio-item apps">
                        <div class="item-inner">
                            <div class="portfolio-image">
                                <img src="images/portfolio/thumb/item1.jpg" alt="">
                                <div class="overlay">
                                    <a class="preview btn btn-danger" title="Lorem ipsum dolor sit amet" href="images/portfolio/full/item1.jpg"><i class="icon-eye-open"></i></a>             
                                </div>
                            </div>
                            <h5>Lorem ipsum dolor sit amet</h5>
                        </div>
                    </li><!--/.portfolio-item-->
                    <li class="portfolio-item joomla bootstrap">
                        <div class="item-inner">
                            <div class="portfolio-image">
                                <img src="images/portfolio/thumb/item2.jpg" alt="">
                                <div class="overlay">
                                    <a class="preview btn btn-danger" title="Lorem ipsum dolor sit amet" href="images/portfolio/full/item2.jpg"><i class="icon-eye-open"></i></a>  
                                </div>
                            </div> 
                            <h5>Lorem ipsum dolor sit amet</h5>         
                        </div>
                    </li><!--/.portfolio-item-->
                    <li class="portfolio-item bootstrap wordpress">
                        <div class="item-inner">
                            <div class="portfolio-image">
                                <img src="images/portfolio/thumb/item3.jpg" alt="">
                                <div class="overlay">
                                    <a class="preview btn btn-danger" title="Lorem ipsum dolor sit amet" href="images/portfolio/full/item3.jpg"><i class="icon-eye-open"></i></a>        
                                </div> 
                            </div>
                            <h5>Lorem ipsum dolor sit amet</h5>          
                        </div>           
                    </li><!--/.portfolio-item-->
                    <li class="portfolio-item joomla wordpress apps">
                        <div class="item-inner">
                            <div class="portfolio-image">
                                <img src="images/portfolio/thumb/item4.jpg" alt="">
                                <div class="overlay">
                                    <a class="preview btn btn-danger" title="Lorem ipsum dolor sit amet" href="images/portfolio/full/item4.jpg"><i class="icon-eye-open"></i></a>          
                                </div>   
                            </div>
                            <h5>Lorem ipsum dolor sit amet</h5>        
                        </div>           
                    </li><!--/.portfolio-item-->
                    <li class="portfolio-item joomla html">
                        <div class="item-inner">
                            <div class="portfolio-image">
                                <img src="images/portfolio/thumb/item5.jpg" alt="">
                                <div class="overlay">
                                    <a class="preview btn btn-danger" title="Lorem ipsum dolor sit amet" href="images/portfolio/full/item5.jpg"><i class="icon-eye-open"></i></a>          
                                </div>  
                            </div>
                            <h5>Lorem ipsum dolor sit amet</h5>  
                        </div>       
                    </li><!--/.portfolio-item-->
                    <li class="portfolio-item wordpress html">
                        <div class="item-inner">
                            <div class="portfolio-image">
                                <img src="images/portfolio/thumb/item6.jpg" alt="">
                                <div class="overlay">
                                    <a class="preview btn btn-danger" title="Lorem ipsum dolor sit amet" href="images/portfolio/full/item6.jpg"><i class="icon-eye-open"></i></a>           
                                </div>  
                            </div>
                            <h5>Lorem ipsum dolor sit amet</h5>         
                        </div>           
                    </li><!--/.portfolio-item-->
                    <li class="portfolio-item joomla html">
                        <div class="item-inner">
                            <div class="portfolio-image">
                                <img src="images/portfolio/thumb/item5.jpg" alt="">
                                <div class="overlay">
                                    <a class="preview btn btn-danger" title="Lorem ipsum dolor sit amet" href="images/portfolio/full/item5.jpg"><i class="icon-eye-open"></i></a>          
                                </div>  
                            </div>
                            <h5>Lorem ipsum dolor sit amet</h5>  
                        </div>       
                    </li><!--/.portfolio-item-->
                    <li class="portfolio-item wordpress html">
                        <div class="item-inner">
                            <div class="portfolio-image">
                                <img src="images/portfolio/thumb/item6.jpg" alt="">
                                <div class="overlay">
                                    <a class="preview btn btn-danger" title="Lorem ipsum dolor sit amet" href="images/portfolio/full/item6.jpg"><i class="icon-eye-open"></i></a>           
                                </div>   
                            </div>
                            <h5>Lorem ipsum dolor sit amet</h5>        
                        </div>         
                    </li><!--/.portfolio-item-->
                </ul>   
            </div><!--/.box-->
        </div><!--/.container-->
    </section><!--/#portfolio-->
	<div id="dodajideja">
	    <section >
        <div class="container">
            <div class="box">
               
            </div> 
        </div>
    </section><!--/#pricing-->
   </div>

    <section id="about-us">
        <div class="container">
            <div class="box">
                <div class="center">
                    <h2>Meet the Team</h2>
                    <p class="lead">Pellentesque habitant morbi tristique senectus et netus et<br>malesuada fames ac turpis egestas.</p>
                </div>
                <div class="gap"></div>
                <div id="team-scroller" class="carousel scale">
                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="member">
                                        <p><img class="img-responsive img-thumbnail img-circle" src="images/team1.jpg" alt="" ></p>
                                        <h3>Agnes Smith<small class="designation">CEO &amp; Founder</small></h3>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="member">
                                        <p><img class="img-responsive img-thumbnail img-circle" src="images/team2.jpg" alt="" ></p>
                                        <h3>Donald Ford<small class="designation">Senior Vice President</small></h3>
                                    </div>
                                </div>        
                                <div class="col-sm-4">
                                    <div class="member">
                                        <p><img class="img-responsive img-thumbnail img-circle" src="images/team3.jpg" alt="" ></p>
                                        <h3>Karen Richardson<small class="designation">Assitant Vice President</small></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="member">
                                        <p><img class="img-responsive img-thumbnail img-circle" src="images/team3.jpg" alt="" ></p>
                                        <h3>David Robbins<small class="designation">Co-Founder</small></h3>
                                    </div>
                                </div>   
                                <div class="col-sm-4">
                                    <div class="member">
                                        <p><img class="img-responsive img-thumbnail img-circle" src="images/team1.jpg" alt="" ></p>
                                        <h3>Philip Mejia<small class="designation">Marketing Manager</small></h3>
                                    </div>
                                </div>     
                                <div class="col-sm-4">
                                    <div class="member">
                                        <p><img class="img-responsive img-thumbnail img-circle" src="images/team2.jpg" alt="" ></p>
                                        <h3>Charles Erickson<small class="designation">Support Manager</small></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="left-arrow" href="#team-scroller" data-slide="prev">
                        <i class="icon-angle-left icon-4x"></i>
                    </a>
                    <a class="right-arrow" href="#team-scroller" data-slide="next">
                        <i class="icon-angle-right icon-4x"></i>
                    </a>
                </div><!--/.carousel-->
            </div><!--/.box-->
        </div><!--/.container-->
    </section><!--/#about-us-->

    <section id="contact">
        <div class="container">
            <div class="box last">
                <div class="row">
                    <div class="col-sm-6">
                        <h1>Contact Form</h1>
                        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
                        <div class="status alert alert-success" style="display: none"></div>
                        <form id="main-contact-form" class="contact-form" name="contact-form" method="post" action="sendemail.php" role="form">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" required="required" placeholder="Name">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" required="required" placeholder="Email address">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Message"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-danger btn-lg">Send Message</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div><!--/.col-sm-6-->
                    <div class="col-sm-6">
                        <h1>Our Address</h1>
                        <div class="row">
                            <div class="col-md-6">
                                <address>
                                    <strong>Twitter, Inc.</strong><br>
                                    795 Folsom Ave, Suite 600<br>
                                    San Francisco, CA 94107<br>
                                    <abbr title="Phone">P:</abbr> (123) 456-7890
                                </address>
                            </div>
                            <div class="col-md-6">
                                <address>
                                    <strong>Twitter, Inc.</strong><br>
                                    795 Folsom Ave, Suite 600<br>
                                    San Francisco, CA 94107<br>
                                    <abbr title="Phone">P:</abbr> (123) 456-7890
                                </address>
                            </div>
                        </div>
                        <h1>Connect with us</h1>
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="social">
                                    <li><a href="#"><i class="icon-facebook icon-social"></i> Facebook</a></li>
                                    <li><a href="#"><i class="icon-google-plus icon-social"></i> Google Plus</a></li>
                                    <li><a href="#"><i class="icon-pinterest icon-social"></i> Pinterest</a></li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="social">
                                    <li><a href="#"><i class="icon-linkedin icon-social"></i> Linkedin</a></li>
                                    <li><a href="#"><i class="icon-twitter icon-social"></i> Twitter</a></li>
                                    <li><a href="#"><i class="icon-youtube icon-social"></i> Youtube</a></li>
                                </ul>
                            </div>
                        </div>
                    </div><!--/.col-sm-6-->
                </div><!--/.row-->
            </div><!--/.box-->
        </div><!--/.container-->
    </section><!--/#contact-->

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
</body>
</html>