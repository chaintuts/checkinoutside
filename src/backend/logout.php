<?php

/* This file handles loggin users out
*
* Author: Josh McIntyre
*/

session_start();

// This block checks whether or not the login forms should be displayed, or the login form should be processed
if (isset($_SESSION["loggedin"]))
{
	// Destroy the user's session
	unset($_SESSION["loggedin"]);
	session_destroy();

	// Redirect to the login page
	header("Location: login.php");
	die();

}
else
{
	// Redirect to the login page
	header("Location: login.php");
	die();
}

?>
