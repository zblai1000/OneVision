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

require_once("dbcontroller1.php");



$db_handle = new DBController();

//variables
$name = '';
$code = '';
$price = '';
$errors = 0; 

$itemName_error = $code_error = $price_error = $info_error = $promotion_error = $image_error = '';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $target_dir = "../Eyeglasses/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));



    //check 
    if (empty($_POST['itemName'])) {
        $itemName_error = 'Please fill in the item name.';
        $errors = $errors + 1; 
    } else{
        $i = mysqli_real_escape_string($OneVision, trim($_POST['itemName'])); 
    }

    

    if (empty($_POST['code'])) {
        $code_error = 'Please fill in the item code.';
        $errors = $errors + 1; 
    } else{
        $c = mysqli_real_escape_string($OneVision, trim($_POST['code'])); 
    }

    if (empty($_POST['price'])) {
        $price_error = 'Please fill in the item price.';
        $errors = $errors + 1; 
    } else{
        $p = mysqli_real_escape_string($OneVision, trim($_POST['price'])); 
    }

    if (empty($_POST['info'])) {
        $info_error = 'Please fill in the item description.';
        $errors = $errors + 1; 
    } else{
        $in = mysqli_real_escape_string($OneVision, trim($_POST['info'])); 
    }

    
    if (empty($_POST['promotion'])) {
        $promotion_error = 'Please select if the item is in promotion or not.';
        $errors = $errors + 1; 
    } else{
        $pro = mysqli_real_escape_string($OneVision, trim($_POST['promotion'])); 
    }


    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
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
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
        $imageName = htmlspecialchars( basename( $_FILES["fileToUpload"]["name"]));
        //$_SESSION["imageLocation"] = $imageName; 
       //$picture = "./".$_POST["category"]."/" . $imageName;
        $path = "../eyeglasses/". $imageName;
        //header("Location: insertItemAdmin.php");
        //add to database here
        $q = "INSERT INTO items (itemName, category, code, picture, info, price, promotion) VALUES ('$i', 'eyeglasses', '$c', '$path', '$in', '$p', '$pro')";
        $r = @mysqli_query($OneVision, $q); 

        if ($r) { // If it ran OK.
            
            echo "Successfully added item.";        
            
            echo "<script>
            window.location.href='sunglasses.php';
            alert('Upload successful!');
            
            </script>";
                    
        }
        else { // If it did not run OK.

        
                // Debugging message:
                echo '<p>' . mysqli_error($OneVision) . '<br /><br />Query: ' . $q . '</p>';
                    
            } 


        } else {
        echo "Sorry, there was an error uploading your file.";
        }
    }
    }
    else{
        echo "Error exists"; 
    }


}





?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="./style.css">
    <script src="javascript.js"></script>
     
    <title>Eyeglasses</title>

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
  width: 10em;
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
        width: 90em;
     
        height: auto;
        margin-left: auto; 
     margin-right: auto;
    }

    @media screen and (max-width: 1120px) {
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
                <b><a href="eyeglasses.php" class="active hyperlinks">Eyeglasses</a></b>
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


    <div class="productDiv" style="width: 90%; text-align: left; margin: 20px;">

    <form action="eyeglasses.php" method="post" enctype="multipart/form-data">
    <p>Name of item: <input type="text" name="itemName" size="10" maxlength="40" value="<?php  if (isset($_POST['itemName'])) echo $_POST['itemName']; ?>"  /><?php echo $itemName_error; ?></p>
    <p>Item code: <input type="text" name="code" size="10" maxlength="40" value="<?php  if (isset($_POST['code'])) echo $_POST['code']; ?>"  /><?php echo $code_error; ?></p>
    <p>Item price (in RM): <input type="text" name="price" size="10" maxlength="20" value="<?php if (isset($_POST['price'])) echo $_POST['price']; ?>"  /><?php echo $price_error; ?></p>
    <p>Item description (in RM): <input type="text" name="info" size="10" maxlength="1000" value="<?php if (isset($_POST['info'])) echo $_POST['info']; ?>"  /><?php echo $info_error; ?></p>
   
    <label for="promotion">Is this item on promotion?</label>
    <select id="promotion" name="promotion">
        <option value="yes">Yes</option>
        <option value="no">No</option>
  
    </select>
    <br>
    <br>

  Select image to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <p><?php echo $image_error; ?></p>
  <input type="submit" value="Upload Item" name="submit">
</form>

</div>

    <h1 style="text-align: center;">eyeglasses</h1>

    
    <hr style="border: 0; height: 3px; clear:both; display:block; width: 70%; background-color:#000000;">

    <?php

    // Number of records to show per page:
$display = 10;

// Determine how many pages there are...
if (isset($_GET['p']) && is_numeric($_GET['p'])) { // Already been determined.
	$pages = $_GET['p'];
} else { // Need to determine.
 	// Count the number of records:
	$q = "SELECT COUNT(id) FROM items";
	$r = @mysqli_query ($OneVision, $q);
	$row = @mysqli_fetch_array ($r, MYSQLI_NUM);
	$records = $row[0];
	// Calculate the number of pages...
	if ($records > $display) { // More than 1 page.
		$pages = ceil ($records/$display);
	} else {
		$pages = 1;
	}
} // End of p IF.

// Determine where in the database to start returning results...
if (isset($_GET['s']) && is_numeric($_GET['s'])) {
	$start = $_GET['s'];
} else {
	$start = 0;
}

// Determine the sort...
// Default is by registration date.
$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'rd';

// Determine the sorting order:
switch ($sort) {
	case 'iN':
		$order_by = 'itemName ASC';
		break;
	case 'cod':
		$order_by = 'code ASC';
		break;
	case 'pri':
		$order_by = 'price ASC';
        break;
    case 'cat':
        $order_by = 'category ASC';
        break;
	default:
		$order_by = 'registration_date ASC';
		$sort = 'rd';
	break;
}



	
// Define the query:
$q = "SELECT id, itemName, code, price, category, info, promotion, registration_date FROM items WHERE category='eyeglasses' ORDER BY $order_by LIMIT $start, $display";		
$r = @mysqli_query ($OneVision, $q); // Run the query.

// Table header:
echo '<table align="center" cellspacing="0" cellpadding="5" width="75%">
<tr style="background-color: #00cc00;">
	<td align="left"><b>Edit</b></td>
	<td align="left"><b>Delete</b></td>
	<td align="left"><b><a href="eyeglasses.php?sort=iN">Item Name</a></b></td>
    <td align="left"><b><a href="eyeglasses.php?sort=cod">Code</a></b></td>
    <td align="left"><b><a href="eyeglasses.php?sort=cat">Category</a></b></td>
    <td align="left"><b><a href="eyeglasses.php?sort=pri">Price</a></b></td>
    <td align="left"><b>Description</b></td>
    <td align="left"><b><a href="eyeglasses.php?sort=pro">Promotion</a></b></td>
    <td align="left"><b><a href="eyeglasses.php?sort=rd">Date Registered</a></b></td>
</tr>
';
//<b><a href="eyeglasses.php?sort=ln">Last Name</a>/b>
// Fetch and print all the records....
$bg = '#eeeeee'; 
while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
	$bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
		echo '<tr bgcolor="' . $bg . '">
		<td align="left"><a href="editItem.php?id=' . $row['id'] . '">Edit</a></td>
		<td align="left"><a href="deleteItem.php?id=' . $row['id'] . '">Delete</a></td>
		<td align="left">' . $row['itemName'] . '</td>
        <td align="left">' . $row['code'] . '</td>
        <td align="left">' . $row['category'] . '</td>
        <td align="left">' . $row['price'] . '</td>
        <td align="left">' . $row['info'] . '</td>
        <td align="left">' . $row['promotion'] . '</td>
        <td align="left">' . $row['registration_date'] . '</td>
	</tr>
	';
} // End of WHILE loop.

echo '</table>';
mysqli_free_result ($r);
mysqli_close($OneVision);

// Make the links to other pages, if necessary.
if ($pages > 1) {
	
	echo '<br /><p>';
	$current_page = ($start/$display) + 1;
	
	// If it's not the first page, make a Previous button:
	if ($current_page != 1) {
		echo '<a href="eyeglasses.php?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '">Previous</a> ';
	}
	
	// Make all the numbered pages:
	for ($i = 1; $i <= $pages; $i++) {
		if ($i != $current_page) {
			echo '<a href="eyeglasses.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';
		} else {
			echo $i . ' ';
		}
	} // End of FOR loop.
	
	// If it's not the last page, make a Next button:
	if ($current_page != $pages) {
		echo '<a href="eyeglasses.php?s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '">Next</a>';
	}
	
	echo '</p>'; // Close the paragraph.
	
} // End of links section.
	
?>



<div class="div" style="flex-wrap: wrap; justify-content: center;">

      
        
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