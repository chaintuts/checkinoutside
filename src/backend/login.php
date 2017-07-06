<?php

/* This file marks up the login form
*
* Author: Josh McIntyre
*
*/

session_start();

echo "<!DOCTYPE html><html>";
echo "<head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /><title>Checkin Outside | Login</title>";
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\"><script src=\"results.js\" type=\"text/javascript\"></script></head>";

echo "<body><h1>Checkin Outside</h1><h2>Login</h2><form action=\"login_handler.php\" method=\"POST\">";
echo "Username: <input type=\"text\" name=\"username\"><br>Password: <input type=\"password\" name=\"password\"><br><input type=\"submit\"></form>";
echo "</body></html>";

?>
