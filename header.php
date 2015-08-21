<?php
ob_start();
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
		echo "<div id=\"projectAlert3\" class=\"alert alert-success alert-reg col-md-4 center\" role=\"alert\"><span class=\"glyphicon glyphicon-ok\"> </span>  Идејата беше додадена. </div>";
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
    <script src="js/star-rating.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link href="css/font-awesome.css" rel="stylesheet";
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/test.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/star-rating.min.css" rel="stylesheet">
   
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
 <style type="text/css">
               .btn-social {
            color: white;
            opacity: 0.8;
        }

            .btn-social:hover {
                color: white;
                opacity: 1;
                text-decoration: none;
            }

        .btn-facebook {
            background-color: #3b5998;
        }

        .btn-twitter {
            background-color: #00aced;
        }

        .btn-linkedin {
            background-color: #0e76a8;
        }

        .btn-google {
            background-color: #c32f10;
        }
    </style>
  	<script type="text/javascript">
  	 var disqus_developer = 1; // this would set it to developer mode
  	</script>
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
                    <a class="navbar-brand" href="index.php"><img src="images/covecence.jpg" width="80px" height="60px" style="margin-top:-3%;margin-left:-20%;" /></a>
                </div>
                <div class="collapse navbar-collapse">
                	
                    <ul class="nav navbar-nav" <?php  if ($_SESSION['user']=="") echo 'style="margin-left: 5%"'; ?>>
                        <li id="homeicon" class="active"><a href="index.php" style="height:98%"><span class="glyphicon glyphicon-home"></span></a></li>
                        <li style=" <?php if ($_SESSION['user']=="") echo 'display:none'; ?>"><a href="#addIdea" data-toggle="modal" data-target=".bs-modal-sm">Додај идеја</a></li> 
                        <li><a href="#ideas">Идеи</a></li>
                        <li id="aboutus"><a href="#about-us">За нас</a></li>
                        <li id="loginActive" style=" <?php if ($_SESSION['user']!="") echo 'display:none'; ?>"><a href="#signin" data-toggle="modal" data-target=".bs-modal-sm2">Најава/Регистрација</a></li> 
                        <li class="dropdown mega-dropdown" style=" <?php if ($_SESSION['user']=="") echo 'display:none'; ?>"><a href="#" class="dropdown-toggle">Најавени сте како: <?php echo $_SESSION["user"] ?></a>
                        
                        	<ul class="dropdown-menu" style="width: 100%" id="logout">
                        		<li><a href="userProfile.php?id=<?php echo $_SESSION['userID']; ?>">Мојот профил</a></li>
                        		<li role="separator" class="divider"></li>
                        		<li><a href="logout.php">Одјави се</a></li>
                        	</ul>
                        	
                        </li>
                       </ul>
                       
                        
                </div>
            </div>
        </div>
    </header><!--/#header-->

  	  <!-- ModalNewIdea -->
<div class="modal fade bs-modal-sm" id="myModal" tabindex="-2" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-margin">
    <div class="modal-content" style="background-color:rgba(255,255,255,.9)">
        <br>
        <div class="modal-body">
          <ul class="nav nav-pills" style="border-bottom: 1px solid #BEE3F5" role="tablist">
			<li role="presentation" class="active"><a href="#newIdea" aria-controls="home" role="tab" data-toggle="tab" style="color: #666;background-color: #BEE3F5;">Додај идеја</a></li>
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
				      <button type="submit" name="addIdeaSubmit" class="btn btn-primary">Внеси</button>
				       <button type="button" class="btn btn-default" data-dismiss="modal">Откажи</button>
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
<!-- modalNew Idea End -->
 	  <!-- Modal -->
<div class="modal fade bs-modal-sm2" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-margin2">
    <div class="modal-content col-md-12 col-sm-12 col-xs-6" style="background-color:rgba(255,255,255,.9)">
        <br>
        
      <div class="modal-body">
         <!-- Nav tabs -->
									  <ul class="nav nav-pills" style="border-bottom: 1px solid #BEE3F5" role="tablist">
									    <li role="presentation" id="LoginLi" class="active"><a href="#Login" aria-controls="home" role="tab" data-toggle="tab" style="color: #666;">Најава</a></li>
									    <li role="presentation"><a href="#Register" aria-controls="profile" role="tab" data-toggle="tab" style="color: #666;">Регистрација</a></li>
									    
									  </ul>
									
									  <!-- Tab panes -->
									  <div class="tab-content">
									    <div role="tabpanel" class="tab-pane active" id="Login"><br />
									    	<form action="#" method="post">
                                             <input class="form-control" type="text" placeholder="Корисничко име" name="username1" required oninvalid="setCustomValidity('Ве молиме внесете корисничко име.')"><br />
                                             <input class="form-control" type="text" placeholder="Лозинка" name="password1" required oninvalid="setCustomValidity('Ве молиме внесете лозинка')"><br />
                                             <div class="center"><input class="btn" style="color: white; background-color: #5CB8E6;" type="submit" value="Најави се" name="loginButton"/></div><br />
                                             
                                             </form>
                                        </div>
									    <div role="tabpanel" class="tab-pane" id="Register"><br />
									    	<form id="register" action="#" method="post" enctype="multipart/form-data">
									    	 <input class="form-control" type="text" id="name" name="name" placeholder="Име*" ><br />
                                             <input class="form-control" type="text" id="lastname" name="lastname" placeholder="Презиме*" ><br />
                                           	<input class="form-control" type="text" id="username" name="username" placeholder="Корисничко име*" ><br />
                                            <input class="form-control" type="password" id="password" name="password" placeholder="Лозинка*" ><br />
                                             <input class="form-control" type="email" id="email" name="email" placeholder="Емаил*" ><br />
                                             <textarea class="form-control" type="text" id="about" name="about" placeholder="За Вас*" ></textarea><br />
                                             <input readonly="true" id="fileText" style="width: 65% !important;">
											 <button class="btn" style="color: white; background-color: #5CB8E6;" onclick="document.getElementById('fileID').click(); return false;" />Слика*</button>
												<input  type="file" name="image" id="fileID" onchange="document.getElementById('fileText').value= this.value" style="visibility: hidden;" />
                                             <label id="required" class="text-center col-md-12" style="color:red;font-size: 0.9em !important;margin-top: -5%;">Пополнете ги сите полиња.</label>
                                             <label id="email" class="text-center col-md-12" style="color:red;font-size: 0.9em !important;">Внесете валиден емаил.</label>
                                             <div class="center"><input class="btn" style="color: white; background-color: #5CB8E6;" type="submit" value="Регистрирај се" name="signUpButton"/></div><br />
                                             
                                             </form>
									    </div>
									  </div>
       
    </div>
      </div>
     
    </div>
  </div>
</div>
<script>
$('#register').on('submit', function() {
    var name=$("#name").val();
    var lastname= $("#lastname").val();
    var username= $("#username").val();
    var pass= $("#password").val();
    var email= $("#email").val();
    var about= $("#about").val();
    var pic= $("#fileID").val();
    
    alert(name+" "+lastname+" "+pass+" "+email+" "+about+" "+pic);
});

  //li active vo Najava
   $("#loginActive").on("click",function(){
   	 $("#Login").addClass('active');
   	 $("#LoginLi").addClass('active');
   });
   
</script>
  <script>
		setTimeout(fade_out, 2000);
		function fade_out() {
		  $("#projectAlert3").fadeOut().empty();
		 
		}
	</script>