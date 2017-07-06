/* This file creates a database user for CheckinOutside
* Configure with your own user information and rename "db_user.sql"
*
* Author: Josh McIntyre
*
*/

/* This block creates the user
*
*/
DROP USER "MyUser"@"localhost";
FLUSH PRIVILEGES;
CREATE USER "MyUser"@"localhost" IDENTIFIED BY "MyPassword";

/* This block grants all privileges on the database to the new user
*
*/
GRANT SELECT ON CheckinDB.* TO "MyUser"@"localhost";
FLUSH PRIVILEGES;

