/* This script retireves geolocation data and performs check ins via AJAX
*
* Author: Josh McIntyre
*/

var Location = function(){

	// Define private functions for this module
	
		// This function marks up the location data on the page
		markupLocationData : function markupLocationData(locationData)
		{
			if (locationData.error != "")
			{	
				document.getElementById("error").innerHTML = locationData.error;
				document.getElementById("success").innerHTML = locationData.success;

				// If there was an error, disable the checkin button
				document.getElementById("checkin_btn").disabled = true;
			}
			else
			{
				document.getElementById("location").innerHTML = locationData.latitude + ", " + locationData.longitude;
				document.getElementById("time_retrieved").innerHTML = locationData.timeRetrieved.toString();
				document.getElementById("error").innerHTML = locationData.error;
				document.getElementById("success").innerHTML = locationData.success;
			}	
		}

		// This function retrieves location data from the HTML5 geolocation API
		queryLocationData : function queryLocationData()
		{

			locationData = {
				latitude : 0,
				error : "Geolocation not supported by this browser",
				success : ""
			};

			if (navigator.geolocation)
			{
				navigator.geolocation.getCurrentPosition(function(position) {

					locationData.latitude = position.coords.latitude;
					locationData.longitude = position.coords.longitude;
					locationData.timeRetrieved = new Date();
					locationData.error = "";
					locationData.success = "Retrieved latest location data";

					markupLocationData(locationData);
				},

				function(error) {

					locationData.error = error.message;
					
					markupLocationData(locationData);
				},

				{ enableHighAccuracy : true } );
			}
			else
			{
				markupLocationData(locationData);
			}
		}

		// This function sumbits the checkin to the backend
		submitCheckin : function submitCheckin()
		{
			var ajax = new XMLHttpRequest();

			ajax.onreadystatechange = function()
			{
				if (ajax.readyState == 4 && ajax.status == 200)
				{
					var result = ajax.responseText;

					if (result == "Success")
					{
						document.getElementById("success").innerHTML = "Checked in successfully";

						/* Once there is a successful submission, disable the checkin button
						* to avoid annoying multiple emails
						*/
						document.getElementById("checkin_btn").disabled = true;
					}
					else
					{
						document.getElementById("error").innerHTML = "Error checking in";
					}
				}
			}

			var location = document.getElementById("location").innerHTML;
			var timeRetrieved = document.getElementById("time_retrieved").innerHTML;
			var activity = document.getElementById("activity").value;
			location = encodeURIComponent(location);
			timeRetrieved = encodeURIComponent(timeRetrieved);

			ajax.open("GET", "checkin_handler.php?location=" + location + "&time_retrieved=" + timeRetrieved + "&activity=" + activity, true);
		
			ajax.send();
		}

	// Return a public interface to this module
	return {

		// This function retrieves location data and marks it up on the page
		getLocationData : function getLocationData()
		{
			queryLocationData();
		},

		// This function submits location data to the backend for a checkin
		checkin : function checkin()
		{
			submitCheckin();
		}

	};
	
}();
