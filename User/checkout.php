<?php 
error_reporting(0);
session_start();
 

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    $user = $_SESSION["username"]; 
    $alert = NULL;
    
   
}
else{
    $user = "Sign In"; 

    //prevent access to the checkout page if user has not login 
 
    echo "<script>
    window.location.href='cart.php';
    alert('You have to login in order to access this page!');
    
    </script>";
}
 


require ('mysqli_connect.php');

$itemsName = $_SESSION["itemsName"];


?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="./style.css">
    <script src="javascript.js"></script>
     
    <title>Checkout</title>

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

    .button:hover{
        
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




    <h1 style="text-align: center;">Checkout</h1>

    
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
        
            </tr>
            <?php

            //refer to cart.php for explanation 
                $itemsName = $_SESSION["itemsName"];
                foreach ($_SESSION["cart_item"] as $item) {
                    $itemsName = array(); 
                    ?>
                        <tr>
                        <td><img src="<?php echo $item["picture"]; ?>" width="80vw" height="80vh" class="smallImg"></td>
                        <td><strong><?php echo $item["name"]; ?></strong></td>
                        <td><?php echo $item["code"]; ?></td>
                        <td><?php echo $item["quantity"]; ?></td>
                        <td align=right><?php echo $item["price"]; ?></td>
                      
                        </tr>
                        <?php
                    $item_total += ($item["price"]*$item["quantity"]);
                    $_SESSION["itemsTotal"] = $item_total;
                    $productName = $item["name"];
                    $productQuantity = $item["quantity"];
                    array_push($itemsName, $productName, $productQuantity);
                    $_SESSION["itemsName"] = $itemsName; 
                    
                }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
                $address1_error = $address2_error = $postcode_error = $city_error = $states_error = '';
                $errors = 0;
            
                if (empty($_POST['address1'])) {
                    $address1_error = 'You forgot to enter your 1st line of address.';
                    $errors = $errors + 1;
                } else {
                    $add1 = mysqli_real_escape_string($OneVision, trim($_POST['address1']));
                }
                
                if (empty($_POST['address2'])) {
                    $address2_error = 'You forgot to enter your 2nd line of address.';
                    $errors = $errors + 1;
                } else {
                    $add2 = mysqli_real_escape_string($OneVision, trim($_POST['address2']));
                }
                
                if (empty($_POST['postcode'])) {
                    $postcode_error = 'You forgot to enter your postcode.';
                    $errors = $errors + 1;
                } else if (is_numeric(trim($_POST['postcode']))){
                    $pos = mysqli_real_escape_string($OneVision, trim($_POST['postcode']));
                }else {
                    $postcode_error = 'Please enter a valid postcode.';
                    $errors = $errors + 1;
                }
                
                if (empty($_POST['city'])) {
                    $city_error = 'You forgot to enter your city.';
                    $errors = $errors + 1;
                } else {
                    $c = mysqli_real_escape_string($OneVision, trim($_POST['city']));
                }
                
                if (empty($_POST['states'])) {
                    $states_error = 'You forgot to enter your state.';
                    $errors = $errors + 1;
                } else {
                    $s = mysqli_real_escape_string($OneVision, trim($_POST['states']));
                }

            
                
                if($errors == 0){

                    
                    //refer to cart.php for explanation 
                    foreach ($_SESSION["cart_item"] as $item) {
                        $item_total1 = 0;
                        $itemsName = array(); 
                        ?>
                           
                            <?php
                        $item_total1 += ($item["price"]*$item["quantity"]);
                        $productName = $item["name"];
                        $productQuantity = $item["quantity"];
                        array_push($itemsName, $productName, $productQuantity);
                        $_SESSION["itemsName"] = $itemsName; 
                       

                        $q = "INSERT INTO orders (username, itemsName, quantity, total, address1, address2, postcode, city, states, order_date) VALUES ('$user', '$itemsName[0]', '$itemsName[1]', '$item_total1', '$add1', '$add2', '$pos', '$c', '$s', NOW())"; 
                        $r = @mysqli_query ($OneVision, $q); // Run the query.  
                        unset($_SESSION["cart_item"]);
                        echo "<script>
                        alert('Your order has been confirmed!');
                        window.location.href='home.php';</script>";
                        mysqli_stmt_close($stmt);
                    }
        
                
                }
                
            

               
            }

            

            

        ?>
            <tr>
            <td colspan="5" align="right"><strong>Total:</strong> <?php echo "RM ".$item_total; ?></td>
            </tr>
            </tbody>
            </table>  

          

              


                    
    <div class="div" style="flex-wrap: wrap; justify-content: center;">
    <div class="productDiv" style="width: 50%; text-align: left; margin: 20px;">

<form action="checkout.php" method="post">
    <p>Address line 1: <br><input  style="width: 50em;"type="text" name="address1" size="100" maxlength="200" value="<?php if (isset($_POST['address1'])) echo $_POST['address1']; ?>" /><?php echo '<br>'.$address1_error; ?></p>
    <p>Address line 2: <br><input  style="width: 50em;"type="text" name="address2" size="100" maxlength="200" value="<?php if (isset($_POST['address2'])) echo $_POST['address2']; ?>" /><?php echo'<br>'. $address2_error; ?></p>
    <p>Postcode: <input style="width: 8em;" type="text" name="postcode" size="100" maxlength="200" value="<?php  if (isset($_POST['postcode'])) echo $_POST['postcode']; ?>"  /><?php echo '<br>'.$postcode_error; ?> </p>
    <p>City:<br> <input style="width: 25em;" type="text" name="city" size="25" maxlength="50" value="<?php  if (isset($_POST['city'])) echo $_POST['city']; ?>"  /><?php echo '<br>'.$city_error; ?></p>
    <p>State:<br> <input style="width: 25em;" type="text" name="states" size="25" maxlength="50" value="<?php if (isset($_POST['states'])) echo $_POST['states']; ?>"  /><?php echo '<br>'.$states_error; ?></p>
    <p><input type="submit" name="submit" value="Checkout" /></p>
</form>

</div>
</div>

    
  



            
                        
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