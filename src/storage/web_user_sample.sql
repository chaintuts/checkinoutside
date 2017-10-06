/* This file creates a web user for CheckinOutside
* Configure with your own web user information and rename "web_user.sql"
*
* Author: Josh McIntyre
*/

/* This block selects the database */
USE CheckinDB;

/* This block inserts the user into the Users table */
INSERT INTO USERS (Username, Password) VALUES ("josh", SHA2("checkin", 256));
INSERT INTO CONTACTS (UserId, Email, Name) VALUES (1, "geraldomctest@mailinator.com", "Geraldo McTest");  
