<?php
session_start();
error_reporting(0);
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    $user = $_SESSION["usernameAdmin"]; 
   
}
else{
    $user = "Sign In"; 
}

 

$username = $pass1 =  $pass2 = $pass_match = "";
$username_err = $pass_error =  $pass_error2  = $pass_match_error = "";
$errors = 0; 

if($_SERVER["REQUEST_METHOD"] == "POST"){

    require ('mysqli_connect.php');
 
   
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
        $errors = $errors + 1; 
    } else{
        
        $sql = "SELECT id FROM admins WHERE username = ?";
        
        if($stmt = mysqli_prepare($OneVision, $sql)){
           
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            
            $param_username = trim($_POST["username"]);
            
        
            if(mysqli_stmt_execute($stmt)){
             
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                    $errors = $errors + 1; 
                } else{
                  
                    $u = mysqli_real_escape_string($OneVision,  trim($_POST["username"]));
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

           
           // mysqli_stmt_close($stmt);
        }
    }

	
	
	
        if(empty(trim($_POST["pass1"]))){
            $pass_error = "Please enter a password.";    
            $errors = $errors + 1;  
        } elseif(strlen(trim($_POST["pass1"])) < 6){
            $pass_error = "Password must have at least 6 characters.";
            $errors = $errors + 1; 
        }else{
            $pass1 = trim($_POST["pass1"]);
        }
        
        
        if(empty(trim($_POST["pass2"]))){
            $pass_error2 = "Please confirm password.";     
            $errors = $errors + 1; 
        }  elseif(strlen(trim($_POST["pass2"])) < 6){
            $pass_error2 = "Password must have atleast 6 characters.";
            $errors = $errors + 1; 
        }else{
            $pass2 = trim($_POST["pass2"]);
            if($pass1 != $pass2){
                $pass_match_error = "Password did not match.";
                $errors = $errors + 1; 
            }
            else{

                $p = mysqli_real_escape_string($OneVision, trim($_POST['pass1'])); 
            }
        }
    
   
        if($errors == 0){
        
       
            $q = "INSERT INTO admins (username, pass) VALUES ('$u', SHA1('$p'))";
            $r = @mysqli_query ($OneVision, $q); // Run the query.
            if ($r) { // If it ran OK.
		
                // Print a message:
               header("Location: welcome.php");
   
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $id;
                $_SESSION["usernameAdmin"] = trim($_POST["username"]);                       
                            
            }
            else { // If it did not run OK.
			
                // Public message:
                echo '<h1>System Error</h1>
                <p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>'; 
                
                // Debugging message:
                echo '<p>' . mysqli_error($OneVision) . '<br /><br />Query: ' . $q . '</p>';
                            
            } 
            

            mysqli_stmt_close($stmt);
            
        }
    
    // Close connection
    mysqli_close($OneVision);
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="./style.css">
    <script src="javascript.js"></script>
     
    <title>Sign Up</title>

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




    <h1 style="text-align: center;">Sign Up</h1>

    
    <hr style="border: 0; height: 3px; clear:both; display:block; width: 70%; background-color:#000000;">

    <div class="productDiv" style="width: 90%; text-align: left; margin: 20px;">
        <form action="signUp.php" method="post">
            <p>Username: <input type="text" name="username" size="15" maxlength="20"><?php echo $username_err; ?></p>
            <p>Password: <input type="password" name="pass1" size="10" maxlength="40" ><?php echo $pass_error; ?></p>
            <p>Confirm Password: <input type="password" name="pass2" size="10" maxlength="20"><?php echo $pass_error2; ?></p>
            <p><?php echo $pass_match_error; ?></p>
            <p><input type="submit" class="btn btn-primary" name="submit" value="Register" /></p>
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

