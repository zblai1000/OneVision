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
     
    <title>View Users</title>

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




    <h1 style="text-align: center;">View Users</h1>

    
    <hr style="border: 0; height: 3px; clear:both; display:block; width: 70%; background-color:#000000;">


    
    <?php

// Number of records to show per page:
$display = 10;

// Determine how many pages there are...
if (isset($_GET['p']) && is_numeric($_GET['p'])) { // Already been determined.
$pages = $_GET['p'];
} else { // Need to determine.
 // Count the number of records:
$q = "SELECT COUNT(id) FROM users";
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


 
default:
    $order_by = 'registration_date ASC';
    $sort = 'rd';
break;
}




// Define the query:
$q = "SELECT id, username, firstName, lastName, email, mobile, registration_date FROM users ORDER BY $order_by LIMIT $start, $display";		
$r = @mysqli_query ($OneVision, $q); // Run the query.

// Table header:
echo '<table align="center" cellspacing="0" cellpadding="5" width="75%">
<tr style="background-color: rgb(67, 167, 48);">
<td align="left"><b>Edit</b></td>
<td align="left"><b>Delete</b></td>
<td align="left"><b>Username</b></td>
<td align="left"><b>First Name</b></td>
<td align="left"><b>Last Name</b></td>
<td align="left"><b><Email</b></td>
<td align="left"><b>Mobile</b></td>
<td align="left"><b><a href="editUsers.php?sort=rd">Date Registered</a></b></td>
</tr>
';

// Fetch and print all the records....
$bg = '#eeeeee'; 
while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
$bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
    echo '<tr bgcolor="' . $bg . '">
    <td align="left"><a href="editUsers.php?id=' . $row['id'] . '">Edit</a></td>
    <td align="left"><a href="deleteUsers.php?id=' . $row['id'] . '">Delete</a></td>
    <td align="left">' . $row['username'] . '</td>
    <td align="left">' . $row['firstName'] . '</td>
    <td align="left">' . $row['lastName'] . '</td>
    <td align="left">' . $row['email'] . '</td>
    <td align="left">' . $row['mobile'] . '</td>
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
    echo '<a href="editUsers.php?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '">Previous</a> ';
}

// Make all the numbered pages:
for ($i = 1; $i <= $pages; $i++) {
    if ($i != $current_page) {
        echo '<a href="editUsers.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';
    } else {
        echo $i . ' ';
    }
} // End of FOR loop.

// If it's not the last page, make a Next button:
if ($current_page != $pages) {
    echo '<a href="editUsers.php?s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '">Next</a>';
}

echo '</p>'; // Close the paragraph.

} // End of links section.

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