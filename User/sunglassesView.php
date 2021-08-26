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
     
    <title>Sunglasses</title>

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
                <b><a href="sunglasses.php" class="active hyperlinks">Sunglasses</a></b>
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





    
    <?php
    require_once("dbcontroller1.php");
    $db_handle = new DBController();
    if(!empty($_GET["action"])) {
        switch($_GET["action"]) {
            case "add":
                if(!empty($_POST["quantity"])) {
                    $productByCode = $db_handle->runQuery("SELECT * FROM items WHERE code='" . $_GET["code"] . "'");
                    $itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["itemName"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"], 'info'=>$productByCode[0]["info"], 'picture'=>$productByCode[0]["picture"]));
                    
                    if(!empty($_SESSION["cart_item"])) {
                        if(in_array($productByCode[0]["code"],$_SESSION["cart_item"])) {
                            foreach($_SESSION["cart_item"] as $k => $v) {
                                    if($productByCode[0]["code"] == $k)
                                        $_SESSION["cart_item"][$k]["quantity"] = $_POST["quantity"];
                            }
                        } else {
                            $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
                        }
                    } else {
                        $_SESSION["cart_item"] = $itemArray;
                    }
                }
                echo "<script>
                alert('Item has been successfully added to cart!');
               </script>";
            break;
            case "remove":
                if(!empty($_SESSION["cart_item"])) {
                    foreach($_SESSION["cart_item"] as $k => $v) {
                            if($_GET["code"] == $k)
                                unset($_SESSION["cart_item"][$k]);				
                            if(empty($_SESSION["cart_item"]))
                                unset($_SESSION["cart_item"]);
                    }
                }
            break;
            case "empty":
                unset($_SESSION["cart_item"]);
            break;	
        }
        }

     // Check for a valid item ID, through GET or POST:
        if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { 
            $id = $_GET['id'];
        } elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
            $id = $_POST['id'];
        } else { // No valid ID, kill the script.
            echo '<p class="error">This page has been accessed in error.</p>';
            exit();
        }
        $product_array = $db_handle->runQuery("SELECT * FROM items WHERE id = '$id'");
        if (!empty($product_array)) { 
            foreach($product_array as $key=>$value){
        ?>

        <div class="productDiv">
  
    
       
        <form method="post" action="contactLens.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
            <div class="inDiv" style="flex-direction: column; width: 100%;  align-items: center;">

                <div class="inDiv" style="margin: 20px; flex-direction: row; width: auto; max-width: 48%; align-items: center;">
                    <img src="<?php echo $product_array[$key]["picture"]; ?>" width="420vw" height="420vh" class="smallImg">
                </div>

                

                <div class="productDiv" style="text-align: center; margin: 20px; width: 50em;">
                    
                <?php

                
                    
                ?>
                
                    
                    
            
                    <p>Item Name: <?php echo $product_array[$key]["itemName"]; ?></p>
                    
                    <p>Category: <?php echo $product_array[$key]["category"]; ?></p>
                    <p>Price: <?php echo 'RM '.$product_array[$key]["price"]; ?></p>
                    <p><input type="text" name="quantity" value="1" size="2" style="width: 4em; margin: 3px;"/><input type="submit" value="Add to cart" class="btnAddAction"  style="height: 3.1em" /></p>
                
            
                    
                </div>
                </div>
                <div class="productDiv" style="text-align: left; margin: 10px;">
                <h3>Product description</h3>
                <hr style="border: 0; height: 2px; margin: 0.1px; clear:both; display:block; width: 100%; background-color:#000000;">
                <p><?php echo $product_array[$key]["info"]; ?></p>
                </div>
            </form>
        <?php
                }
        }
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