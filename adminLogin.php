 <?php 
 include_once 'database.php';
 session_start();
 $error="";
 if (isset($_POST['submit'])){
  	$username=$_POST['username'];
	$pass=$_POST['password'];
	$query=mysqli_query($link, "select * from users where Username='$username' and Password='$pass' and Type=1");
	if (mysqli_num_rows($query)>0)
	
	{
		$_SESSION['admin']="admin";
		header('Location: adminPage.php');
	}
	else {
		$error="Невалидни податоци!";
	}
  }
 ?> 
  <!DOCTYPE html>
    <html>
    	<body>
    		<head>
    			<meta charset="UTF-8">
    			 <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="css/plugins/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    		</head>
    <div class="container">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" style="border: 1px solid #428bca;" >
                    <div class="panel-heading" style="background-color: #428bca;">
                        <div class="panel-title" style="color: white">Најавете се</div>
                        <div style="float:right;  font-size: 80%; position: relative; top:-10px"><a href="#">Ја заборавивте вашата лозинка?</a></div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <form id="loginform" action="" method="post" class="form-horizontal" role="form">
                                    
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="username" type="text" class="form-control" name="username" value="" placeholder="корисничко име">                                        
                                    </div>
                                
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="password" type="password" class="form-control" name="password" placeholder="лозинка">
                                    </div>
                                    

                                <span class="pull-right" style="color:red;"><?php echo $error; ?></span><br>

                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 controls pull-right">
                                    	<input name="submit" type="submit" value="Најава" id="btn-login" class="btn btn-success" />       
                                    </div>
                                </div>


                              
                            </form>     



                        </div>                     
                    </div>  
        </div>
        
    </div>
    </body>
    </html>