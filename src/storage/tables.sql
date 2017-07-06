/* This file creates a database and several tables for the CheckinOutside application
*
* Author: Josh McIntyre
*
*/

/* This block creates the database
*
*/
CREATE DATABASE CheckinDB;

/* This block creates related tables to store the user's authentication and contact data
*
*/
USE CheckinDB;

CREATE TABLE USERS
(
	UserId INT NOT NULL AUTO_INCREMENT, 
	Username VARCHAR(50) NOT NULL,
	Password CHAR(64) NOT NULL,

	PRIMARY KEY (UserId)
);

CREATE TABLE CONTACTS
(
	UserId INT NOT NULL,
	FOREIGN KEY FkUserId(UserId)
   	REFERENCES USERS(UserId)
    	ON UPDATE CASCADE
    	ON DELETE RESTRICT,

	Email VARCHAR(50) NOT NULL,
	Name VARCHAR(50),
	
	PRIMARY KEY (UserId, Email)
);
