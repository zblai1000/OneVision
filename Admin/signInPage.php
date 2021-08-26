<?php 
error_reporting(0);
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    $user = $_SESSION["usernameAdmin"]; 
    header("location: welcome.php");
    
   
}
else{
    $user = "Sign In"; 
}
 
// This script performs an INSERT query to add a record to the users table.

?>


<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="./style.css">
    <script src="javascript.js"></script>
     
    <title>Sign In</title>

    <style>

    .button {
    background-color: rgb(67, 167, 48);
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;

    }

    .button:hover{
        
        background-color: rgb(71, 233, 39);
    }

    input{
    width: 25em;
  padding: 10px 16px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit]{
  width: 8em;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

    </style>
    
  </head>
  <body>

    <header>

        <div class="div" style="height: 12vh;">
            <div class="inDiv"></div>
            <div class="inDiv" ><h1 class="top">OneVision</h1></div>
            <div class="inDiv" style="align-self: center;">
                <div class="inDiv"></div>
                <div class="inDiv"></div>
                <div class="inDiv"></div>
                <div class="inDiv"></div>
                <div class="inDiv"><div class="div" style="align-self: center;">
                    <a href="signIn.php" style="text-decoration: none; color: #000000;"><?php echo $user; ?></a>
                </div></div>
            
            </div>
        </div>


        
  
     

    </header>
    <div id="mySidenav" class="sidenav">
        <br>
        <br>
        
        
    </div>
    
    <div class="divNav" style="width:100vw; background-color: black;">

        
    
        <div class="visibleSide">
            <span style="font-size:30px;cursor:pointer;" onclick="openNav()">&#9776;</span>
        </div>

        <div class="inDiv" style="width:100vw; background-color: black;">

            <nav class="nav" style="margin: auto;">   
                
                
                
            
            </nav>
        </div>
      
        
    </div>
    
  

    <br>
    <br>
    <br>
    <br>




    <h1 style="text-align: center;">Sign In</h1>

    
    <hr style="border: 0; height: 3px; clear:both; display:block; width: 70%; background-color:#000000;">

    <div class="productDiv" style="width: 90%; text-align: left; margin: 20px;">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div <?php echo (!empty($username_error)) ? 'has-error' : ''; ?>>
                <label>Username</label>
                <br>
                <input type="text" name="username" class="input" value="<?php //echo $username; ?>">
                <span class="help-block"><?php //echo $username_error; ?></span>
            </div>   
            <br> 
            <div <?php echo (!empty($pass_error)) ? 'has-error' : ''; ?>>
                <label>Password</label>
                <br>
                <input type="password" name="pass" class="input">
                <span class="help-block"><?php //echo $errors; ?></span>
            </div>
            <br>
            <div>
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="signUp.php">Sign up now</a>.</p>

            <?php
            require ('mysqli_connect.php'); 
            // Print any error messages, if they exist:
                if (isset($errors) && !empty($errors)) {
                            
                    foreach ($errors as $msg) {
                        echo "$msg<br />\n";
                    }
                

                }

            // Display the form:

            ?>
        </form>
    </div>


    
    <button onclick="topFunction()" id="myBtn" title="Go to top">Back to Top</button>


    <br>
    <br>
    <br>
    <br>
    <hr>
    <small><i>Copyright &copy; 2020 OneVision</i></small>
    <br>
    <br>
  



  </body>
</html>