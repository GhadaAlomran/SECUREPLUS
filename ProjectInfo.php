<?php
    require_once 'Configure.php';
    session_start();
    $name = $_GET['name'];
    $sqlProject= mysqli_query($conn,"SELECT * FROM project WHERE Name='$name'");
    $sqlProject2= mysqli_query($conn,"SELECT * FROM project WHERE Name='$name'");

?>
 

<!DOCTYPE html>
<html>
    <head>
        <title> Secure+ | <?php echo $name; ?> Project </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
                            <p class="head"> &nbsp;<span class="media"> GSKY </span> Management </p>
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
        
        <div class="container">
            <h2>
                &nbsp; &nbsp; &nbsp;<a href="Home.php" style="color: #5d5d5d;">Home</a> > <a href="MyProjects.php" style="color: #5d5d5d;"> My Projects</a> > <span class="media">Project Information</span>
            </h2>
                <br>
        <center>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h2 class="BodyCourses-heading text-uppercase" > 
                        <span class="media"> 
                            <?php 
                                echo
                                    $name;
                            ?>  
                        </span>
                        Project 
                    </h2>
                </div>
            </div>

            <div class="row">
                <?php  
                    while ($row=mysqli_fetch_array($sqlProject)){  
                        $id =$row['ID'];
                        $name=$row['Name'];
                        $brief_des=$row['des'];
                        $img=$row['img'];
                        $doc=$row['doc'];
                ?>

                <div class="col-md-12">
                    <div class="projectInfo" >
                        <nav >                
                            <div class="projectInfo-img" >
                                <img src= "<?php echo  $img;  ?> " width="400px" hight="200px" alt="Project's image">
                            </div> 
                        </nav>
                        <article>
                            <div class='projectInfo-names'>  
                                    <b>Project ID: &nbsp;</b>  
                                    <span >
                                        <?php 
                                            echo $id; 
                                        ?> 
                                    </span>
                                    <br>
                            </div>
                              
                            <div class='projectInfo-des'> 
                                <b>Project Description:&nbsp;</b> 
                                <span>
                                    <?php
                                        echo nl2br($brief_des);
                                    ?> 
                                </span>
                            </div>

                            <div class="viewDoc">        
                                <a onclick="openDoc()" >
                                    <span class='glyphicon glyphicon-folder-open' id="DocLink"> 
                                    </span> 
                                    View document
                                </a>
                                <script>
                                    function openDoc(){
                                        window.location.assign('<?php echo $row['doc']; ?>');
                                    }
                                </script>
                            
                                <script>
                                    $(document).ready(function()){
                                                        $("DocLink").hover(function(){
                                                                            $(this).css("text-decoration","underline","font-weight","bold");
                                                                        });
                                                        }
                                </script>
                            </div>      
                        </article>
                    </div>
                </div>        
                <?php
                    } 
                ?>  
            </div>
            
        </center>
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
          