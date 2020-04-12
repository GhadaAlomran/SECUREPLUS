<?php
	// Include config file
	require_once "Configure.php";
	 
	// Define variables and initialize with empty values
	$username = $password = $confirm_password = "";
	$username_err = $password_err = $confirm_password_err = "";
    
	 
	// Processing form data when form is submitted
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
        $name= $conn->real_escape_string($_POST['name']);
        $email= $conn->real_escape_string($_POST['email']);
		// Validate username 
		// The trim() function removes white space from both sides(left and right) of a string
		if(empty(trim($_POST["username"]))){
			$username_err = "Please enter a username.";
		} else{
			// Prepare a select statement
			$sql = "SELECT id FROM employee WHERE username = ?";
			
			if($stmt = $conn->prepare($sql)){
				// Bind variables to the prepared statement as parameters
				$stmt->bind_param("s", $param_username);
				
				// Set parameters
				$param_username = trim($_POST["username"]);
				
				// Attempt to execute the prepared statement
				if($stmt->execute()){
					// store result
					$stmt->store_result();
					
					if($stmt->num_rows == 1){
						$username_err = "This username is already taken.";
					} else{
						$username = trim($_POST["username"]);
					}
				} else{
					echo "Oops! Something went wrong. Please try again later.";
				}
			}
			 
			// Close statement
			$stmt->close();
		}
		
		// Validate password
		if(empty(trim($_POST["password"]))){
			$password_err = "Please enter a password.";     
		} elseif(strlen(trim($_POST["password"])) < 6){
			$password_err = "Password must have atleast 6 characters.";
		} else{
			$password = trim($_POST["password"]);
		}
		
		// Validate confirm password
		if(empty(trim($_POST["confirm_password"]))){
			$confirm_password_err = "Please confirm password.";     
		} else{
			$confirm_password = trim($_POST["confirm_password"]);
			if(empty($password_err) && ($password != $confirm_password)){
				$confirm_password_err = "Password did not match.";
			}
		}
		
		// Check input errors before inserting in database
		if(empty($username_err) && empty($password_err) && empty($confirm_password_err))
		{
			
			// Prepare an insert statement
			$sql = "INSERT INTO employee (username, password, Name, Email) VALUES (?, ?, '$name','$email')";
			 
			if($stmt = $conn->prepare($sql)){
				// Bind variables to the prepared statement as parameters
				$stmt->bind_param("ss", $param_username, $param_password);
				
				// Set parameters
				$param_username = $username;
				$param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
				
				// Attempt to execute the prepared statement
				if($stmt->execute()){
					// Redirect to login page
					header("location: Login.php");
				} else{
					echo "Something went wrong. Please try again later.";
				}
			}
			 
			// Close statement
		
		}
    
    // Close connection
    $conn->close();
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> GSKY | Sign Up </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="External%20Styles.css" rel="stylesheet">
    
    <style type="text/css">
        
        .wrapper{
            width: 800px; 
            padding: 40px; 
            margin-top: 30px;
            margin-left: auto;
            margin-right: auto;
        }

		body {
            background: url("Images/BG.png") no-repeat center top;
            background-size : cover;
            font-family: "Lato", sans-serif;
            transition: background-color .5s;
            font: 14px sans-serif;
        }
        
        .center {
          display: block;
          margin-left: auto;
          margin-right: auto;
        } 
    </style>
</head>
<body>   
    
    <div class="well wrapper" style="background-color: white; ">
        <img src= "Images/gsky.jpg" height="100px" width="300px" class="center">
        <br><br>
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" id="name">
            </div>    
            <div class="form-group <?php echo (empty($username_err)) ? '' : 'has-error' ; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div> 
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control"id="email">
            </div>  
            <div class="form-group <?php echo (empty($password_err)) ? '' : 'has-error' ; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (empty($confirm_password_err)) ? '' : 'has-error' ; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit" style="background-color: #9d426b; border-color: #9d426b">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="Login.php">Login here</a>.</p>
        </form>
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