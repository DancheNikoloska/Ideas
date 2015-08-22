<?php
//proverka dali e najaven adminot i soodvetno prenasocuvanje
session_start();
if ($_SESSION['admin']!="admin"){
	header('Location: adminLogin.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<style>
	a{
		color:#428bca !important;
	}
</style>
<head>
<title>Администратор</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Администратор</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
     <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
	

    
   
</head>
<?php 

?>
<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0;border:0px; width:1280px; background-color: transparent !important">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html" style="margin-left: 100px;">Имам идеја
                </a>
            </div>
            <!-- /.navbar-header -->
	
            <ul class="nav navbar-top-links navbar-right">
            	
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                
              
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                        
                            <a href="logoutAdmin.php">
                                Logout
                            </a>
                       
                          
                        </li>
                    </ul>
                    
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation" style="margin-left: 100px;background-color: transparent !important">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                      
                        <li>
                            <a class="active" href="adminPage.php"><i class="fa fa-lightbulb-o fa-fw"></i> Идеи</a>
                       </li>
                
                        <li>
                            <a href="usersAdmin.php"><i class="fa fa-users fa-fw"></i> Корисници </a>
                        </li>
                        <li>
                            <a href="statistics.php"><i class="fa fa-bar-chart-o fa-fw"></i> Статистики </a>
                           
                        </li>
                                               
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper" style="width: 900px; margin-left: 350px;">
        	<div class="row">
            
                <div class="col-lg-12">
                    <h1 class="page-header">Идеи</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
         јкјк
        </div>
        <!--end of row -->
        </div>
        <!-- /#page-wrapper -->
        
        <div class="container">

				<hr>

				<?php include_once 'footer.php'; ?>

			</div><!-- /.container -->

    
   
</body>

</html>

