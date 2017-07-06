<?php

/* This file processes a user checkin
*
* Author: Josh McIntyre
*
*/

session_start();

require("db_auth.php");

/* Check if the user is logged in
*
*/
if (isset($_SESSION["loggedin"]))
{
	/* Get the location and checkin time from GET
	*
	*/
	$location = $_GET["location"];
	$time_retrieved = $_GET["time_retrieved"];

	/* If the location string is set, check in
	* Otherwise, return an error
	*
	*/
	if (! ($location == ""))
	{
		$latlon = explode(",", $location);

		/* This block establishes a connection with the MySQL database
		*
		*/
		$database = new mysqli("localhost", $MYSQL_USERNAME, $MYSQL_PASSWORD, "CheckinDB");

		if ($database -> connect_errno > 0)
		{
			die ("Error");
		}

		$checkin_query = "SELECT Email, Name FROM CONTACTS WHERE UserId=".$_SESSION["userid"].";";
		$query_result = $database -> query($checkin_query);

		while ($row = $query_result -> fetch_assoc())
		{
			$email = $row["Email"];
			$subject = "Check In From ".$_SESSION["username"];

			$message = "Hello there ".$row["Name"].",<br><br>";
			$message .= "This is an automated email from the Checkin Outside app.<br><br>";
			$message .= "Your contact ".$_SESSION["username"]." wanted to let you know they arrived at ";
			$message .= $location." at ".$time_retrieved.".<br><br>";
			$message .= "You can view a map of this location at ";
			$message .= "<a href=\"https://www.openstreetmap.org/?mlat=".$latlon[0];
			$message .= "&mlon=".$latlon[1]."&zoom=16";
			$message .= "#map=16/".$latlon[0]."/".$latlon[1];
			$message .= "\">Open Street Map</a><br><br>";
			$message .= "Have a great day!";

			$headers = "From: checkinoutside@jmcintyre.net\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

			if (! (mail($row["Email"],$subject,$message, $headers)))
			{
				echo "Error";
			}
		}

		echo "Success";
	}
	else
	{
		echo "Error";
	}
}
else
{
	/* Redirect to the login page
	*
	*/
	header("Location: login.php");
	die();
}

?>
