<?php 
error_reporting(0);
session_start();
 

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    $user = $_SESSION["username"]; 
   
}
else{
    $user = "Sign In"; 
}
 


require ('mysqli_connect.php');
require_once("dbcontroller1.php");

$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {

    //retrieving products from database and display on a responsive gallery view
	case "add":
		if(!empty($_POST["quantity"])) {
            $productByCode = $db_handle->runQuery("SELECT * FROM items WHERE code='" . $_GET["code"] . "'");
            
            //store item details in an array to be display on the cart table
			$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["itemName"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"], 'picture'=>$productByCode[0]["picture"]));
            
            //if cart not empty, add in new products into the itemArray
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
                //if cart is empty, inititate the session as the 1st item added into the cart. 
				$_SESSION["cart_item"] = $itemArray; 
			}
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["code"] == $k) //retrieve the item code of the item selected to be deleted 
						unset($_SESSION["cart_item"][$k]);	//remove the item from the session		
					if(empty($_SESSION["cart_item"])) //if cart is empty
						unset($_SESSION["cart_item"]); //end the session 
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]); //end the session 
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
     
    <title>Cart</title>

    <style>

    button {
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

    button:hover{
        
        background-color: rgb(71, 233, 39);
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
        max-width: 90em;
        width: 60em;
        height: auto;
        margin-left: auto; 
     margin-right: auto;
    }

    @media screen and (max-width: 1120px) {
        table{
     
        width: auto;
        
    }

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




    <h1 style="text-align: center;">Cart</h1>

    
    <hr style="border: 0; height: 3px; clear:both; display:block; width: 70%; background-color:#000000;">


    

    <?php
if(isset($_SESSION["cart_item"])){
    $item_total = 0;
?>	

    <table>
<tbody>
<tr>
<th><strong>Product</strong></th>
<th><strong>Name</strong></th>
<th><strong>Code</strong></th>
<th><strong>Quantity</strong></th>
<th><strong>Unit Price <br>(RM)</strong></th>
<th><strong>Action</strong></th>
</tr>
<?php

    //gather the items information and for each instance of the elements in the array store it in the variable $item 
	foreach ($_SESSION["cart_item"] as $item) {
       
        //display each instance of the array in the table 
		?>
			<tr>
            <td><img src="<?php echo $item["picture"]; ?>" width="120vw" height="120vh" class="smallImg"></td>
			<td><strong><?php echo $item["name"]; ?></strong></td>
			<td><?php echo $item["code"]; ?></td>
			<td><?php echo $item["quantity"]; ?></td>
			<td align=right><?php echo $item["price"]; ?></td>
			<td><a href="cart.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction"><button style="background-color: red;">Remove Item</button></a></td>
			</tr>
			<?php
        $item_total += ($item["price"]*$item["quantity"]);
       
     
       
    }
    
    
	?>

<tr>
<td colspan="5" align="right"><strong>Total:</strong> <?php echo "RM ".$item_total; ?></td>
</tr>
</tbody>
</table>    

    	
<button><a href="checkout.php" style="text-decoration: none; color: white;">Checkout</a></button>

            
                        
<?php   
}?>
    





    
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