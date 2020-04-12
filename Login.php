<?php
	// Initialize the session
	session_start();
	 
	// Check if the user is already logged in, if yes then redirect him to welcome page
	if( isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
		header("location:Home.php");
		exit;
	}
 
	// Include config file
	require_once "Configure.php";
	 
	// Define variables and initialize with empty values
	$username = $password = "";
	$username_err = $password_err = "";
	 
	// Processing form data when form is submitted
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
	 
		// Check if username is empty
		if(empty(trim($_POST["username"]))){
			$username_err = "Please enter username.";
		} else{
			$username = trim($_POST["username"]);
		}
		
		// Check if password is empty
		if(empty(trim($_POST["password"]))){
			$password_err = "Please enter your password.";
		} else{
			$password = trim($_POST["password"]);
		}
		
		// Validate credentials
		if(empty($username_err) && empty($password_err)){
			// Prepare a select statement
			$sql = "SELECT id, username, password FROM employee WHERE username = ?";
			
			if($stmt = $conn->prepare($sql)){
				// Bind variables to the prepared statement as parameters
				$stmt->bind_param("s", $param_username);
				
				// Set parameters
				$param_username = $username;
				
				// Attempt to execute the prepared statement
				if($stmt->execute()){
					// Store result
					$stmt->store_result();
					
					// Check if username exists, if yes then verify password
					if($stmt->num_rows == 1){                    
						// Bind result variables
						$stmt->bind_result($id, $username, $hashed_password);
						// $stmt->fetch() will fetch results from a prepared statement into the bound variables
						if($stmt->fetch()){
							//password_verify ( string $password , string $hash ) : bool
							//	password : The user's password.
							//  hash : A hash created by password_hash().
							if(password_verify($password, $hashed_password)){
								// Password is correct, so start a new session
								session_start();
                                $cookie_name = "nameCookie";
                                setcookie( $cookie_name , $name, time()+ (86400 * 30), "/");
								
								// Store data in session variables
								$_SESSION["loggedin"] = true;
								$_SESSION["id"] = $id;
								$_SESSION["username"] = $username;                            
								
								// Redirect user to welcome page
								header("location:Home.php?user=$username");
							} else{
								// Display an error message if password is not valid
								$password_err = "The password you entered was not valid.";
							}
						}
					} else{
						// Display an error message if username doesn't exist
						$username_err = "No account found with this username.";
					}
				} else{
					echo "Oops! Something went wrong. Please try again later.";
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
    <title> SECURE+ | Login </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="External%20Styles.css" rel="stylesheet">
    <style type="text/css">
        
        .wrapper{
            height: 600px;
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
        <h2>
            &nbsp; &nbsp; &nbsp;<a href="index.php" style="color: #5d5d5d;">Home</a> > <span class="media">Login</span>
        </h2>
        <br>
        <p>Please fill in your credentials to login.</p>
        <br>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (empty($username_err)) ? '': 'has-error'; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (empty($password_err)) ? '': 'has-error'; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <br>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login" style="background-color: #9d426b; border-color: #9d426b">
            </div>
            <br>
            <p>Don't have an account? <a href="Sign%20Up.php">Sign up now</a>.</p>
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