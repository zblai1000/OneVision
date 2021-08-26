<?php
session_start(); 
error_reporting(0);

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    $user = $_SESSION["usernameAdmin"]; 
   
}
else{
    $user = "Sign In"; 
}
 
require ('mysqli_connect.php');



?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="./style.css">
    <script src="javascript.js"></script>
     
    <title>Delete Users</title>

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
      
        <b><a href="sunglasses.php">Sunglasses</a></b>
        <b><a href="eyeglasses.php">Eyeglasses</a></b>
        <b><a href="contactLens.php">Contact Lens</a></b>
        <b><a href="eyecare.php">Eyecare</a></b>
        <b><a href="viewUsers.php">View Users</a></b>
        
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    </div>
    
    <div class="divNav" style="width:100vw; background-color: black;">

        
    
        <div class="visibleSide">
            <span style="font-size:30px;cursor:pointer;" onclick="openNav()">&#9776;</span>
        </div>

        <div class="inDiv" style="width:100vw; background-color: black;">

            <nav class="nav" style="margin: auto;">   
                
                <b><a href="sunglasses.php" class="hyperlinks">Sunglasses</a></b>
                <b><a href="eyeglasses.php" class="hyperlinks">Eyeglasses</a></b>
                <b><a href="contactLens.php" class="hyperlinks">Contact Lens</a></b>
                <b><a href="eyecare.php" class="hyperlinks">Eyecare</a></b>
                <b><a href="viewUsers.php" class="active hyperlinks">View Users</a></b>
               
                
            
            </nav>
        </div>
      
    </div>
    
   

    <br>
    <br>
    <br>
    <br>




    <h1 style="text-align: center;">Delete User</h1>

    
    <hr style="border: 0; height: 3px; clear:both; display:block; width: 70%; background-color:#000000;">


    <?php 
    // This page is for deleting a user record.


    // Check for a valid user ID, through GET or POST:
    if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From view_items.php
        $id = $_GET['id'];
    } elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
        $id = $_POST['id'];
    } else { // No valid ID, kill the script.
        echo '<p class="error">This page has been accessed in error.</p>';
        exit();
    }

   

    // Check if the form has been submitted:
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                if ($_POST['sure'] == 'Yes') {

                    $q = "DELETE FROM users WHERE id = $id LIMIT 1"; 
                    $r = @mysqli_query ($OneVision, $q); 
                    if (mysqli_affected_rows($OneVision) == 1) {

                        echo '<p>The user has been deleted.</p>';
                    }
                } else {
                    echo "<script>
                    window.location.href='viewUsers.php';
                    alert('The user information has not been deleted.');
                    
                    </script>";
                    
                }

            } else {
                echo '<p>The user has NOT been deleted.</p>'; 
            }				
        

    } else { // Show the form.

        // Retrieve the user's information:
        $q = "SELECT username FROM users WHERE id=$id";
        $r = @mysqli_query ($OneVision, $q);

        if (mysqli_num_rows($r) == 1) { // Valid user ID, show the form.

            // Get the user's information:
            $row = mysqli_fetch_array ($r, MYSQLI_NUM);
            
            // Display the record being deleted:
            echo "<h3>Name: $row[0]</h3>
            Are you sure you want to delete this user?";
            
            // Create the form:
                echo '
            <div class="productDiv" style="width: 50%; text-align: left; margin: 20px;">';
            echo '<form action="deleteUsers.php" method="post">
        <input type="radio" name="sure" value="Yes" /> Yes 
        <input type="radio" name="sure" value="No" checked="checked" /> No
        <br>
        <input type="submit" name="submit" value="Submit" />
        <input type="hidden" name="id" value="' . $id . '" />
        </form>
        </div>';
        
        } else { // Not a valid user ID.
            echo '<p class="error">This page has been accessed in error.</p>';
        }

    } // End of the main submission conditional.

    mysqli_close($OneVision);
		
?>


    





    
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