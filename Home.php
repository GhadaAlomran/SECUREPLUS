<?php
    require_once 'Configure.php';
    session_start();
    $sqlProject = mysqli_query($conn,"SELECT * FROM project");
    $sqlProject2 = mysqli_query($conn,"SELECT * FROM task");
?>
 
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title> SECURE+ | Home </title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="External%20Styles.css" rel="stylesheet">
	</head>
	<body>
        
        <!-- Side Nav -->        
        <div id="mySidenav" class="sidenav">
             <br>    
            <img style = "margin-left: 20px" width= "60px" height= "60px" src= "Images/user.png">
            <br>
            <span style="color: grey; margin-left: 20px; font-size: 24px;"><?php echo $_SESSION["username"]; ?></span>    
            <br><br><br>
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a style="font-size: 20px;" href="Home.php"><span class="glyphicon glyphicon-home"></span>    Home</a>
            <a style="font-size: 20px;" href="MyTasks.php"><span class="glyphicon glyphicon-ok-circle"></span>    My Tasks</a>
            <a style="font-size: 20px;" href="Inbox.php"><span class="glyphicon glyphicon-bell"></span>    Inbox</a>
            <a style="font-size: 20px;" href="MyProjects.php"><span class="glyphicon glyphicon-user"></span>    My Projects</a>
            <br><br><br><br><br><br><br><br><br><br><br><br>
            <span style="color: grey; margin-left: 15px"> ـــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــ  </span>
            <a style="font-size: 20px;" href="SignOut.php"><span class="glyphicon glyphicon-log-out"></span>    Sign Out </a>
            
        </div>
        <div id="main" >
            <nav class="navbar"> 
                <div class="navbar-header" style="border-bottom: 2px solid #9d426b; margin-top: 0px";>
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#TopNavbar" >
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>                        
					</button>
				</div>
                <div class="collapse navbar-collapse" style="border-bottom: 2px solid #9d426b;" id="TopNavbar">
                    <ul class="nav navbar-nav" >  
                        <li class="nav-item">
                            <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
                        </li>
                        <li class="nav-item">
                            <p class="head"> &nbsp;<span class="media"> SECURE+ </span>  </p>
                        </li>
                    </ul>
                    
                    <ul class="nav navbar-nav navbar-right" >
                        <li class="nav-item">
                            <a class="nav-link" href="AddProject.php" style="margin-bottom: 0px">
                                <span class="glyphicon glyphicon-plus "></span> 
                                New
                            </a>
                        </li> 
                        <li class="nav-item">
                            <a class="nav-link" href='Help.php'>
                                <span class= "glyphicon glyphicon-question-sign"></span>
                            </a>
                        </li>
                        <li class="nav-item" onmouseover="document.getElementById('searchForm').style.display='block'">
                            <a class="nav-link" onmousemove="document.getElementById('icon')";>
                                <span class="glyphicon glyphicon-search">
                                </span>
                            </a>        
                        </li>
                        <li class="nav-item">
                            <form class= "form-inline" onmouseover="document.getElementById('searchForm')" action= '<?php echo "Search.php"; ?>' method='post' onkeyup='searching(this.value)'>
                                <input style= "margin-top: 10px" class="form-control mr-sm-2" type='text' name='search' placeholder='Go to my project or task' onkeyup='showHint(this.value)'>
                            </form>
                        </li>
                        <script>
                                 function showHint(str) {
                                     var xhttp;
                                     if (str.length == 0) { 
                                        document.getElementById("txtHint").innerHTML = "";
                                        return;
                                     }
                                     xhttp = new XMLHttpRequest();
                                     xhttp.open("GET", "Data.php?q="+str, true);
                                     xhttp.send();  
                                     xhttp.onreadystatechange = function() {
                                                                    if (this.readyState == 4 && this.status == 200) {
                                                                            document.getElementById("txtHint").innerHTML = this.responseText;
                                                                    }
                                     };
                                 };
                            </script>
                        <li class="nav-item dropdown"> 
                            <a style="color: #9d426b;" class="nav-link dropdown-toggle media" data-toggle="dropdown" >
                                <span class="caret">
                                </span> 
                                <?php echo $_SESSION["username"]; ?>
                            </a>
                            <div width="100%" class="dropdown-menu">
                                <a style="margin-left: 30px;" class="dropdown-item " href="SignOut.php">
                                    <span class="glyphicon glyphicon-log-out">
                                    </span> 
                                    Sign Out
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        
        <script>
            function openNav() {
              document.getElementById("mySidenav").style.width = "250px";
              document.getElementById("main").style.marginLeft = "250px";
              document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
            }

            function closeNav() {
              document.getElementById("mySidenav").style.width = "0";
              document.getElementById("main").style.marginLeft= "0";
              document.body.style.backgroundColor = "white";
            }
        </script>
        <!-- End Side Nav -->
        
        <!-- Carousel -->
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <img style="width: 100%; height: 50%;" src="Images/rtac.png.jpg" alt="RTAC">
                </div>
                
                <div class="item">
                    <img style="width: 100%; height: 50%;" src="Images/stc.png.jpg" alt="STC">
                </div>

                <div class="item">
                  <img style="width: 1000%; height: 50%;" src="Images/gskyAD.png" alt="SECUREPLUS">
                </div>
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left">
                </span>
                <span class="sr-only">
                    Previous
                </span>
            </a>
            
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right">
                </span>
                <span class="sr-only">
                    Next
                </span>
            </a>
        </div>    
        <!-- End Carousel -->
        <br> <br>
        <div class="container">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#tab1" data-toggle="tab">
                        My Projects
                    </a>
                </li>
                <li>
                    <a href="#tab2" data-toggle="tab">
                        My Tasks
                    </a>
                </li>
                <li >
                    <a href="#tab3" data-toggle="tab">
                        Inbox
                    </a>
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane fade in active" id="tab1">
                    <br> 
                    <br>
                    <?php 
                    $sqlEmployee=mysqli_query($conn, "SELECT * FROM employee WHERE username='$_SESSION[username]'");
                        $rowEmp=mysqli_fetch_array($sqlEmployee);  
                        $Eid=$rowEmp['ID'];
                    
                    $sqlProjects=mysqli_query($conn, "SELECT * FROM project WHERE id IN(SELECT ProjectID FROM employee_project WHERE EmployeeID=$Eid)");
                    $count=0;
                    do {
                        $row=mysqli_fetch_array($sqlProjects); 
                        $countProject=mysqli_num_rows($sqlProjects);    
                        $id=$row['ID'];
                        $name=$row['Name'];               
                        $des=$row['des'];
                        $img= $row['img'];    
                        $doc=$row['doc'];   
                        $count++;                   
                    ?>
                    <div class="thumb" >
                        <br><br><br>
                        <img style="width: 150px; height: 150px; margin-left: 70px; margin-bottom: 50px;" src="<?php echo $img ?>">	                			
                        <p style="margin-left: 20px">
                            <span class="media">
                                <?php 
                        echo "Prject No.$id"."<br>".$name;
                                ?>
                            </span> 
                            <br>
                            <?php 
                        echo $des;
                            ?> 
                            <br>
                            <?php 
                        echo 
                            "<a href='ProjectInfo.php?name=$name'>
                            Explore projects
                            </a>";
                            ?>
                        </p>
                    </div>
                    <?php 
                    }while($count<$countProject) 
                    ?>   
                </div>
                                    
                <div class="tab-pane fade" id="tab2">
                    <br> 
                    <br>
                    <?php 
                        $sqlTasks=mysqli_query($conn, "SELECT * FROM task WHERE id>0");
                        $count=0;
                    do {
                        $row=mysqli_fetch_array($sqlTasks);
                        $countTask=mysqli_num_rows($sqlTasks);  
                        $id=$row['ID'];
                        $name=$row['Name'];               
                        $pid=$row['ProjectID'];   
                        $count++;                   
                    ?>
                    <div class="thumb">
                        <br><br><br>
                        <?php
                        $sql= mysqli_query($conn, "SELECT * FROM project WHERE id=$pid");
                            $row2=mysqli_fetch_array($sql); 
                            $img= $row2['img'];    
                        ?>
                        <img style="width: 150px; height: 150px; margin-left: 70px; margin-bottom: 50px;" src="<?php echo $img ?>">	                			
                        <p>
                            <span class="media">
                                <?php 
                        echo "Task No.$id"."<br>".$name;
                                ?>
                            </span> 
                            <br>
                            <?php 
                        echo "This task is for Project No.$pid";
                            ?> 
                            <br>
                            <?php 
                            echo 
                                "<a href='TaskInfo.php?id=$id'>
                                Explore Task
                                </a>";
                            ?>
                        </p>
                    </div>
                    <?php 
                    }while($count<$countTask) 
                    ?>   
                </div>
                                
                <div class="tab-pane fade" id="tab3">
                    <center>
                        <br>
                        <br>
                        <p class="head media" >
                            To Be Added Soon!
                        </p>
                    </center>
                </div>
            </div>
        </div>
        
        <!-- Footer -->
        <footer>
            <div class="container">
                <div class="row">
                    <img style="margin-top: 40px" height="100px" width="300px" src="fullLogo1.png">
                    <div class="col-sm-3 footer-box">
                        <h4>Contact Us</h4>
                        <div class="footer-box-text footer-box-text-contact">
	                        <p><i class="glyphicon glyphicon-map-marker"></i> Address: Riyadh, Saudi Arabia</p>
	                        <p><i class="glyphicon glyphicon-phone"></i> Phone: +966 55 565 6586</p>
	                        
	                        <p><i class="glyphicon glyphicon-envelope"></i> Email: help@secureplus.com </p>
                        </div>
                    </div>
                    
                  
                </div>
                
                <div class="row">
                	<div class="col-sm-12 wow fadeIn">
                		<div class="footer-border"></div>
                	</div>
                </div>
                
                
                <div class="row">
                    <div class="col-sm-12 footer-copyright" style="text-align:center;">
                        <p> Copyright &copy; - All rights reserved to Secure+. </p>
                    </div>
                   
                </div>
            </div>
        </footer>
        <!-- End Footer -->
    </body>
</html>