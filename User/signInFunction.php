<?php 
error_reporting(0);
function redirect_user ($page) {

	// Start defining the URL...
	// URL is http:// plus the host name plus the current directory:
	$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
	
	// Remove any trailing slashes:
	$url = rtrim($url, '/\\');
	
	// Add the page:
	$url .= '/' . $page;
	
	// Redirect the user:
	header("Location: $url");
	exit(); // Quit the script.

} // End of redirect_user() function.

function check_login($OneVision, $username = '', $pass = '') {

    require ('mysqli_connect.php');

	$errors = array(); // Initialize error array.

	$username_error = $pass_error = $match_error = ''; 

// Validate the email address:
	if (empty ($username)){
		$errors[] = 'You forgot to enter your username.'; 
		
	} else{
		$u = mysqli_real_escape_string($OneVision, trim($username)); 
	}


	
	// Validate the password:
	
	if (empty($pass)){
		$erorrs[] = 'You forgot to enter your password.'; 
	
	} else{
		$p = mysqli_real_escape_string($OneVision, trim($pass)); 
	}
	

	

	if (empty($errors)) { // If everything's OK.

		// Retrieve the user_id and first_name for 
		//that email/password combination:
		$q = "SELECT id FROM users WHERE username='$u' AND pass=SHA1('$p')";		
		$r = @mysqli_query ($OneVision, $q); // Run the query.
		
		// Check the result:
		if (mysqli_num_rows($r) == 1) {

			// Fetch the record:
            $row = mysqli_fetch_array ($r, MYSQLI_ASSOC);
            
			// Return true and the record:
			return array(true, $row);
			
		} else { // Not a match!
			$errors[] = 'The email address and password entered do not match those on file.';
		
		}
		
	} // End of empty($errors) IF.
	
	// Return false and the errors:
	return array(false, $errors);


} // End of check_login() function.
?>