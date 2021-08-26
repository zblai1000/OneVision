<?php
// This code uses MySQLi in a procedural manner to create a table in your
//database.
$servername = "127.0.0.1";
$username = "root"; // Default: "root"
$password = ""; // Leave blank or set to NULL
$dbname = "OneVision"; // The name of the database you want to
//connect to

// Create connection TO A SPECIFIC DATABASE (notice the additional
//$dbname at the end)
$handler = mysqli_connect($servername, $username, $password, $dbname);


if (!$handler) 
    {
    die("Connection failed: " . mysqli_connect_error());
    } 
    else 
    {
 echo "Connected successfully";
    }

// SQL query to create table

$usersTable = "CREATE TABLE users(
            id INT not null primary key auto_increment,
            username VARCHAR(30) NOT NULL,
            firstName VARCHAR(30) NOT NULL,
            lastName VARCHAR(30) NOT NULL,
            email VARCHAR(30) NOT NULL,
            gender VARCHAR(6) NOT NULL,
            dateOfBirth VARCHAR(30) NOT NULL,
            mobile VARCHAR(30) NOT NULL,
            pass CHAR(40) NOT NULL,
            registration_date DATETIME DEFAULT CURRENT_TIMESTAMP,
            picture TEXT NOT NULL)";

$itemsTable = "CREATE TABLE items(
            id INT not null primary key auto_increment,
            itemName VARCHAR(100) NOT NULL, 
            category VARCHAR(230) NOT NULL, 
            code VARCHAR(100) NOT NULL,
            info VARCHAR(1000) NOT NULL,
            picture TEXT,
            price double(10,2) NOT NULL,
            promotion VARCHAR(3) NOT NULL, 
            registration_date DATETIME DEFAULT CURRENT_TIMESTAMP)";

$adminTable = "CREATE TABLE admins(
            id INT not null primary key auto_increment,
            username VARCHAR(30) NOT NULL,
            pass CHAR(40) NOT NULL,
            registration_date DATETIME DEFAULT CURRENT_TIMESTAMP)";

$orderTable = "CREATE TABLE orders(
    id INT not null primary key auto_increment,
    username VARCHAR(30) NOT NULL,
    itemsName VARCHAR(100) NOT NULL,
    quantity VARCHAR(100) NOT NULL,
    total double(10,2) NOT NULL,
    address1 VARCHAR(200) NOT NULL,
    address2 VARCHAR(200) NOT NULL,
    postcode INT NOT NULL,
    city VARCHAR(50) NOT NULL,
    states VARCHAR(50) NOT NULL,
    order_date DATETIME DEFAULT CURRENT_TIMESTAMP)";

$contactTable = "CREATE TABLE user_contact_form(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    fullName VARCHAR(30) NOT NULL,
    email VARCHAR(30) NOT NULL,
    mobile VARCHAR(30) NOT NULL,
    reason VARCHAR(300) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP)";




// Executing the SQL query using the connection handler
mysqli_query($handler, $usersTable);
mysqli_query($handler, $itemsTable);
mysqli_query($handler, $adminTable);
mysqli_query($handler, $orderTable);
mysqli_query($handler, $contactTable);



?>