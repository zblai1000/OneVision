<?php 

session_start();
error_reporting(0);

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    $user = $_SESSION["username"]; 
   
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
     
    <title>My Profile</title>

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

        
    th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: black;
        color: white;
    }

    td, th {
       
        padding: 20px;
        font-family: "Comic Sans MS", cursive, sans-serif;
        
    }

   

    tr:hover {background-color: #ddd;}

    table{
        max-width: 95em;
        width: 90em;
        height: auto;
        
    }

    @media screen and (max-width: 1500px) {
        table{
     
        width: 70em;
        
    }
}

    @media screen and (max-width: 1120px) {
        table{
     
        width: 50em;
        
    }
}

    
    @media screen and (max-width: 600px) {
        table{
     
        width: auto;
        
    }

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




    <h1 style="text-align: center;">Welcome</h1>

    
    <hr style="border: 0; height: 3px; clear:both; display:block; width: 70%; background-color:#000000;">


    <br>
    <div>
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to your profile page.</h1>
    </div>
    <br>
    <br>

        
    <?php
    require_once("dbcontroller1.php");
    $db_handle = new DBController();

        //store current log in user info in an array 
        $product_array = $db_handle->runQuery("SELECT * FROM users WHERE username = '$user'");
        if (!empty($product_array)) { 
            foreach($product_array as $key=>$value){
            
            //display user info
            
        ?>

        <div class="productDiv">
            <form method="post" action="sunglasses.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
      

            <div class="inDiv" style="margin: 20px; flex-direction: column; width: auto; align-items: center;">
                <img src="<?php echo $product_array[$key]["picture"]; ?>" width="420vw" height="420vh" class="smallImg">
            </div>

            <div class="productDiv">
                
            <?php
                
            ?>
            
                
                
                <p><a href="editUser.php?id=<?php echo $product_array[$key]["id"];  ?>"style="text-decoration: none; color: black;">Edit</a></p>
                <p></p>

                <p>Username: <?php echo $product_array[$key]["username"]; ?></p>
                <p>Full Name: <?php echo $product_array[$key]["firstName"]. ' '.$product_array[$key]["lastName"]; ?></p>
                <p>Email: <?php echo $product_array[$key]["email"]; ?></p>
                <p>Gender: <?php echo $product_array[$key]["gender"]; ?></p>
                <p>Date Of Birth: <?php echo $product_array[$key]["dateOfBirth"]; ?></p>
                <p>Mobile Number: <?php echo $product_array[$key]["mobile"]; ?></p>
         
                
            </div>
            </form>
        </div>
        <?php
                }
        }
        ?>

    <br>    

    <h2>Purchase history: </h2>

    <table>
<tbody>
<tr>
<th><strong>Product</strong></th>
<th><strong>Name</strong></th>
<th><strong>Total</strong></th>
<th><strong>Purchase timestamp</strong></th>
</tr>

        <?php
        //store user's past purchase in an array 
        $product_array = $db_handle->runQuery("SELECT * FROM orders WHERE username = '$user' ORDER BY id ASC");
        if (!empty($product_array)) { 
            foreach($product_array as $key=>$value){
            
            //display the past purchases 

            $itemsName = array(); ?>
	
			<tr>
          
			<td><strong><?php echo $value["itemsName"]; ?></strong></td>
			<td><?php echo $value["quantity"]; ?></td>
			<td align=right><?php echo $value["total"]; ?></td>
            <td align=right><?php echo $value["order_date"]; ?></td>
		
			</tr>


            <?php
            }}
            ?>


        <tr>
      
        </tbody>
        </table>    
  

    <br>
    <p>
        <br>
        <br>
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
    <hr>
    <small><i>Copyright &copy; 2020 OneVision</i></small>
    <br>
    <br>
  

     







  </body>
</html>