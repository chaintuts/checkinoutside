<?php

/* This file marks up the check in page
*
* Author: Josh McIntyre
*/

session_start();

// Check if the user is logged in
if (isset($_SESSION["loggedin"]))
{
	// Mark up the main check in page
	echo "<!DOCTYPE html><html>";
	echo "<head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /><title>Checkin Outside | Checkin</title>";
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\"><script src=\"location.js\" type=\"text/javascript\"></script></head>";

	echo "<body onload=\"Location.getLocationData()\"><h1>Checkin Outside</h1>";
	echo "<p>Time retrieved: <span id=\"time_retrieved\"></span></p><p>Current location: <span id=\"location\"></span></p>";
	
	echo "<p>Today's activity: <select id=\"activity\">";
	echo "<option value=\"\"></option>";
	echo "<option value=\"Mountain Biking\">Mountain Biking</option>";
	echo "<option value=\"Skiing\">Skiing</option>";
	echo "<option value=\"Camping/Backpacking\">Camping/Backpacking</option>";
	echo "<option value=\"Hiking\">Hiking</option>";
	echo "</select></p>";
	
	echo "<button id=\"checkin_btn\" onClick=\"Location.checkin()\">Check in</button><br><br><div id=\"error\"><br></div><div id=\"success\"></div><br><br>";

	echo "<a href=\"logout.php\">Logout</a>";

	echo "</body></html>";
}
else
{
	// Redirect to the login page
	header("Location: login.php");
	die();
}

?>
