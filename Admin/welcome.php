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
     
    <title>Welcome</title>

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

    .input{
        width: 8%;
        background-color: #BBC90D ;
        color: white;
        padding: 14px 20px;
        margin: 8px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
        }

    .input:hover {
        background-color: #A8B607;
        }

        .inputOut{
        width: 8%;
        background-color: #FE1515  ;
        color: white;
        padding: 14px 20px;
        margin: 8px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
        }

        .inputOut:hover {
        background-color: #D20909 ;
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
                <b><a href="viewUsers.php" class="hyperlinks">View Users</a></b>
                
                
            
            </nav>
        </div>
        
        
    </div>
    
   

    <br>
    <br>
    <br>
    <br>




    <h1 style="text-align: center;">Welcome</h1>

    
    <hr style="border: 0; height: 3px; clear:both; display:block; width: 70%; background-color:#000000;">


    <br>
    <div>
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["usernameAdmin"]); ?></b>. Welcome to your profile page.</h1>
    </div>
    <br>
    <p>
        
        
        <a href="logout.php" class="inputOut">Sign Out of Your Account</a>
    </p>

        <br>
        <br>
        <br>


    





    
    <button onclick="topFunction()" id="myBtn" title="Go to top">Back to Top</button>


    <br>
    <br>
    <br>
    <br>
    <br>
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