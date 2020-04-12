<?php
    require_once 'Configure.php';
    session_start();
    if(isset($_POST['search'])){
        $searchq=$_POST['search'];
        
        $queryProject=mysqli_query($conn,"SELECT * FROM project WHERE name='$searchq'");
        $countProject=mysqli_num_rows($queryProject);

        $queryTask=mysqli_query($conn,"SELECT * FROM task WHERE name='$searchq'");
        $countTask=mysqli_num_rows($queryTask);      
 ?>


<!DOCTYPE html>
<html>

<head>
     <title> Secure+ | <?php echo $name; ?> </title>
     <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="External%20Styles.css" rel="stylesheet">
    </head>

    <body>
        <!-- search by project -->
        <?php
            if($countProject==0){ 
        ?>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="BodyCourses-item " >
                        <center>
                            <div class="BodyCourses-caption ">
                                <p style=" color: #9d426b; font-size: 18px; "> <?php echo "No result Found!" ; ?></p> 
                            </div>
                        </center>
                    </div>
                </div>
            </div>
      
        <?php 
            }else{
      
                while ($row=mysqli_fetch_array($queryProject)){
                    $name=$row['Name'];
                    header("location:ProjectInfo.php?name=$name");
                    die();
   
                }
            } 
        ?>
    
        <!-- search by task -->
        <?php 
            if($countTask==0){ 
        ?>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="BodyCourses-item " >
                            <center>
                                <div class="BodyCourses-caption ">
                                    <p style=" color: #9d426b; font-size: 18px; "> <?php echo "No result Found!" ; ?></p> 
                                </div>
                            </center>
                        </div>
                    </div>
                </div>        
<?php 
            }else{
                while ($row=mysqli_fetch_array($queryTask)){
                    $name=$row['Name'];
                    header("location:TaskInfo.php?name=$name");
                    die();
   
                }
            } 

    }//post
?>            
    </body>

</html>