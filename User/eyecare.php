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

?>

<?php 

require_once("dbcontroller1.php");



$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM items WHERE code='" . $_GET["code"] . "'");
			$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["itemName"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"], 'picture'=>$productByCode[0]["picture"]));
			
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

?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="./style.css">
    <script src="javascript.js"></script>
     
    <title>Eyecare</title>

    
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
  width: 6em;
  background-color: #4CAF50;
  color: white;
  padding: 8px;
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
        <b><a href="eyecare.php" class="active">Eyecare</a></b>
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
                <b><a href="eyecare.php" class="active hyperlinks">Eyecare</a></b>
                <b><a href="contactUs.php" class="hyperlinks">Contact Us</a></b>
                <b><a href="aboutUs.php" class="hyperlinks">About Us</a></b>
                
            
            </nav>
        </div>
        <input type="text" placeholder="Search.." style="margin: 8px; margin-right: 20px; margin-left: 0px; width: 10.5em; height: 2.8em;">
        
    </div>
    
    <img src="./Pictures/eyeCareMain.jpg" alt="home" style="width: 100vw; height: auto;">

    <br>
    <br>
    <br>
    <br>




    <h1 style="text-align: center;">Eyecare</h1>

    
    <hr style="border: 0; height: 3px; clear:both; display:block; width: 70%; background-color:#000000;">

    <div class="div" style="flex-wrap: wrap; justify-content: center;">

        <?php
        $product_array = $db_handle->runQuery("SELECT * FROM items WHERE category = 'eyeCare' ORDER BY id ASC");
        if (!empty($product_array)) { 
            foreach($product_array as $key=>$value){
        ?>

        <div class="productDiv">
            <form method="post" action="eyecare.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
      

            <div class="inDiv" style="margin: 20px; flex-direction: column; width: auto; align-items: center;">
                <img src="<?php echo $product_array[$key]["picture"]; ?>" width="420vw" height="420vh" class="smallImg">
            </div>

            <div class="productDiv">
            <p style="font-weight: bold;"><a href="eyecareView.php?id=<?php echo $product_array[$key]["id"];  ?>"style="text-decoration: none; color: black;"><?php echo $product_array[$key]["itemName"]; ?></a></p>
                <p><?php echo "RM ".$product_array[$key]["price"]; ?></p>
                <p><input type="text" name="quantity" value="1" size="2"   style="width: 4em; margin: 3px;" /><input type="submit" value="Add to cart" class="btnAddAction"  style="height: 2.75em" /></p>
            </div>
            </form>
        </div>
        <?php
                }
        }
        ?>

        
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