## General
____________

### Author
* Josh McIntyre

### Website
* jmcintyre.net

### Overview
* Checkin Outside helps outdoor enthusiasts share their whereabouts with family and friends

## Development
________________

### Git Workflow
* master for releases (merge development)
* development for bugfixes and new features

### Building
* make build
Build the application
* make load
Load the database
* make clean
Clean the build and data directories

### Features
* Gather the user's GPS location and checkin time via a web browser
* Send automated emails to pre-configured contacts with the user's location information and checkin time
* Include a link to OpenStreetMap in the email so contacts can easily see where the user is

### Requirements
* Requires Javascript and AJAX support

### Platforms
* Firefox
* Chrome

## Usage
____________

### Configuration
* Configure web users and their respective contacts when building the application

### Web Browser Usage
* Log in using the pre-configured username and password
* Allow the browser to share your location
* Click the "Check in" button to send emails to your contacts
