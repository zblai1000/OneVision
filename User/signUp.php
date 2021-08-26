    <?php
session_start();
error_reporting(0);
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    $user = $_SESSION["username"]; 
   
}
else{
    $user = "Sign In"; 
}
require ('mysqli_connect.php');
require_once("dbcontroller1.php");
$db_handle = new DBController();

$username = $fname = $lname = $email = $gender = $dob = $mobile = $pass1 =  $pass2 = $pass_match = "";
$username_error = $fname_error = $lname_error = $email_error = $gender_error = $dob_error = $mobile_error = $pass_error =  $pass_error2  = $pass_match_error = $image_error =  "";
$errors = 0; 

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $target_dir = "../ProfilePicture/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    
 
   
    if(empty(trim($_POST["username"]))){
        $username_error = "Please enter a username.";
    } else{
        
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($OneVision, $sql)){
           
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            
            $param_username = trim($_POST["username"]);
            
        
            if(mysqli_stmt_execute($stmt)){
             
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_error = "This username is already taken.";
                    $errors = $errors + 1; 
                } else{
                  
                    $u = mysqli_real_escape_string($OneVision,  trim($_POST["username"]));
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

           
            mysqli_stmt_close($stmt);
        }
    }


    if (empty($_POST['first_name'])) {
      
        $fname_error = 'Please fill in your first name.';
        $errors = $errors + 1; 
	} else {
		$fn = mysqli_real_escape_string($OneVision, trim($_POST['first_name']));
	}


	if (empty($_POST['last_name'])) {
        $lname_error = 'Please fill in your last name.';
        $errors = $errors + 1; 
    } else{
		$ln = mysqli_real_escape_string($OneVision, trim($_POST['last_name'])); 
	}
	

	
    
    $email = trim($_POST['email']);
	if (empty($_POST['email'])) {
        $email_error = 'Please fill in your email address.';
        $errors = $errors + 1; 
    } 
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = "Invalid email format";
        $errors = $errors + 1; 
      }
    else{
        
		$e = mysqli_real_escape_string($OneVision, trim($_POST['email'])); 
    }
    

	if (empty($_POST['gender'])) {
        $gender_error = 'Please select your gender.';
        $errors = $errors + 1; 
	} else{
		$g = mysqli_real_escape_string($OneVision, trim($_POST['gender'])); 
    }
    
 
	if (empty($_POST['dateOfBirth'])) {
        $dob_error = 'Please select your date of birth.';
        $errors = $errors + 1; 
	} else{
		$dob = mysqli_real_escape_string($OneVision, trim($_POST['dateOfBirth'])); 
	}
	
	
        if (empty($_POST['mobile'])) {
            $mobile_error = 'Please select your mobile number.';
            $errors = $errors + 1; 
        } else if (is_numeric(trim($_POST['mobile']))){
            $m = mysqli_real_escape_string($OneVision, trim($_POST['mobile'])); 
        }else{
            
            $mobile_error = 'Invalid mobile number.';
        }
	
	
	
	
        if(empty(trim($_POST["pass1"]))){
            $pass_error = "Please enter a password.";     
        } elseif(strlen(trim($_POST["pass1"])) < 6){
            $pass_error = "Password must have at least 6 characters.";
            $errors = $errors + 1; 
        }else{
            $pass1 = trim($_POST["pass1"]);
        }
        
        
        if(empty(trim($_POST["pass2"]))){
            $pass_error2 = "Please confirm password.";     
        }  elseif(strlen(trim($_POST["pass2"])) < 6){
            $pass_error2 = "Password must have at least 6 characters.";
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

         // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
           // echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            $image_error = "File is not an image.";
            $uploadOk = 0;
        }
        }
    
        // Check if file already exists
        if (file_exists($target_file)) {
            $image_error = "Sorry, file already exists.";
        $uploadOk = 0;
        }
    
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 50000000) {
            $image_error = "Sorry, your file is too large.";
        $uploadOk = 0;
        }
    
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            $image_error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
        }
        
        
        if ($errors == 0){
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                $image_error =  "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
               // echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
                $imageName = htmlspecialchars( basename( $_FILES["fileToUpload"]["name"]));
               
                $path = "../ProfilePicture/". $imageName;
                
                $q = "INSERT INTO users (username, firstName, lastName, email, gender, dateOfBirth, mobile, pass, picture) VALUES ('$u', '$fn', '$ln', '$e', '$g', '$dob', '$m', SHA1('$p'), '$path')";
                $r = @mysqli_query ($OneVision, $q); // Run the query.
        
                if ($r) { // If it ran OK.
                    
                    //echo "Successfully added item.";    
                    header("Location: welcome.php");
                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $id;
                    $_SESSION["username"] = trim($_POST["username"]);          
                            
                }
                else { // If it did not run OK.
        
                
                        // Debugging message:
                       // echo '<p>' . mysqli_error($OneVision) . '<br /><br />Query: ' . $q . '</p>';
                            
                    } 
        
        
                } else {
               // echo "Sorry, there was an error uploading your file.";
                }
            }
            }
            else{
              //  echo "Error exists"; 
            }
        
        
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
                <div class="inDiv"><a href="cart.php"><img src="./Pictures/cartLogo.png" alt="cart" width="40vw" height="auto"></a></div>
                <div class="inDiv"><div class="div" style="align-self: center;">
                    <a href="signIn.php" style="text-decoration: none; color: #000000;"><?php echo $user; ?></a>
                </div></div>
            
            </div>
        </div>


        
  
     

    </header>
    <div id="mySidenav" class="sidenav">
        <br>
        <br>
        <b><a href="home.php">Home</a></b>
        <b><a href="sunglasses.php">Sunglasses</a></b>
        <b><a href="eyeglasses.php">Eyeglasses</a></b>
        <b><a href="contactLens.php">Contact Lens</a></b>
        <b><a href="eyecare.php">Eyecare</a></b>
        <b><a href="contactUs.php">Contact Us</a></b>
        <b><a href="aboutUs.php">About Us</a></b>
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    </div>
    
    <div class="divNav" style="width:100vw; background-color: black;">

        
    
        <div class="visibleSide">
            <span style="font-size:30px;cursor:pointer;" onclick="openNav()">&#9776;</span>
        </div>

        <div class="inDiv" style="width:100vw; background-color: black;">

            <nav class="nav" style="margin: auto;">   
                <b><a href="home.php" class="hyperlinks">Home</a></b>
                <b><a href="sunglasses.php" class="hyperlinks">Sunglasses</a></b>
                <b><a href="eyeglasses.php" class="hyperlinks">Eyeglasses</a></b>
                <b><a href="contactLens.php" class="hyperlinks">Contact Lens</a></b>
                <b><a href="eyecare.php" class="hyperlinks">Eyecare</a></b>
                <b><a href="contactUs.php" class="hyperlinks">Contact Us</a></b>
                <b><a href="aboutUs.php" class="hyperlinks">About Us</a></b>
                
            
            </nav>
        </div>
        <input type="text" placeholder="Search.." style="margin: 8px; margin-right: 20px; margin-left: 0px; width: 10.5em; height: 2.8em;">
        
    </div>
    
  

    <br>
    <br>
    <br>
    <br>




    <h1 style="text-align: center;">Sign Up</h1>

    
    <hr style="border: 0; height: 3px; clear:both; display:block; width: 70%; background-color:#000000;">
    <div class="productDiv" style="width: 50%; text-align: left; margin: 30px;">
   
        <form action="signUp.php" method="post" enctype="multipart/form-data">
            <p>Username: <input type="text" name="username" size="15" maxlength="20" value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>" /><?php echo $username_error; ?></p>
            <p>First Name: <input type="text" name="first_name" size="15" maxlength="20" value="<?php if (isset($_POST['fname'])) echo $_POST['fname']; ?>" /><?php echo $fname_error; ?></p>
            <p>Last Name: <input type="text" name="last_name" size="15" maxlength="20" value="<?php if (isset($_POST['lname'])) echo $_POST['lname']; ?>" /><?php echo $lname_error; ?></p>
            <p>Email Address: <input type="text" name="email" size="20" maxlength="40" value="<?php  if (isset($_POST['email'])) echo $_POST['email']; ?>"  /><?php echo $email_error; ?> </p>
            <label for="gender">Select Gender:</label>
       
            <select name="gender" id="gender">
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="others">Others</option>
            </select>
            <?php echo $gender_error; ?>
      
            <p>
            <label for="birthday">Birthday:</label>
            <input type="date" id="dateOfBirth" name="dateOfBirth">
            <?php echo $dob_error; ?>
            </p>
            <p>Mobile Number: <input type="text" name="mobile" size="10" maxlength="40" value="<?php  if (isset($_POST['mobile'])) echo $_POST['mobile']; ?>"  /><?php echo $mobile_error; ?></p>
            <p>Password: <input type="password" name="pass1" size="10" maxlength="40" value="<?php  if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>"  /><?php echo $pass_error; ?></p>
            <p>Confirm Password: <input type="password" name="pass2" size="10" maxlength="20" value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>"  /><?php echo $pass_error2; echo $pass_match_error;?></p>
            <p><?php echo $pass_match_error; ?></p>
            Select image to upload:
            <input type="file" name="fileToUpload" id="fileToUpload">
            <p><?php echo $image_error; ?></p>
            
            <p><input type="submit" name="submit" value="Register" /></p>
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

