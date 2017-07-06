<?php

/* This file processes the user login attempt
*
* Author: Josh McIntyre
*
*/

session_start();

require("db_auth.php");

/* This block establishes a connection with the MySQL database
*
*/
$database = new mysqli("localhost", $MYSQL_USERNAME, $MYSQL_PASSWORD, "CheckinDB");

if ($database -> connect_errno > 0)
{
	die ("Unable to connect to database");
}

/* This block retrieves the user password hash from the database based on the username
*
*/
$password_query = "SELECT UserId, Username, Password from USERS WHERE Username = \"".$_POST["username"]."\";";
$password_result = $database -> query($password_query);
$fetched_row = $password_result -> fetch_assoc();

$database -> close();

/* This block checks the password
* If it fails, reload this page
* If it's okay, set cookies and redirect to the check in page
*
*/
if ($fetched_row["Password"] == hash("sha256", $_POST["password"]))
{
	/* Set session variables
	*
	*/
	$_SESSION["loggedin"] = true;
	$_SESSION["username"] = $fetched_row["Username"];
	$_SESSION["userid"] = $fetched_row["UserId"];

	/* Redirect to the main check in page
	*
	*/
	header("Location: checkin.php");
	die();
}
else
{
	/* Reload the login page
	*
	*/
	header("Location: login.php");
	die();
}


?>
