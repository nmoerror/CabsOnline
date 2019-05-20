//**  Author: Alejandro González Auckland University of Technology **/
// generate a request through xhr.js
var xhr = createRequest();
//this function takes in 3 parameters including reference number to search in DB
function submitRequest(url, target, reference) {
	var numbers = /^[0-9]+$/;
	if (reference != "") {
		//check that reference is an integer
		if (numbers.test(reference)) {
			if (xhr) {
				var viewx = document.getElementById(target);
				var data = "reference=" + reference + "&action=Search";
				xhr.open("POST", url, true);
				xhr.setRequestHeader(
					"Content-type",
					"application/x-www-form-urlencoded"
				);
				//.onload is better
				xhr.onload = function() {
					if (xhr.status == 200) {
						viewx.innerHTML = xhr.responseText;
					}
				};
				xhr.send(data);
			}
		} else {
			alert("References only contain numbers");
			return false;
		}
	} else {
		alert("Please fill in all fields.");
		return false;
	}
	viewx.innerHTML =
		'<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div>';
}
// Take in the second target div to display table of bookings in last 2 hours
function requireUpdate(url, target2) {
	if (xhr) {
		var viewx = document.getElementById(target2);
		var data = "action=Update";
		xhr.open("POST", url, true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhr.onload = function() {
			if (xhr.status == 200) {
				viewx.innerHTML = xhr.responseText;
			}
		};
		xhr.send(data);
	}
}
// Sends the reference value to server to assign a driver
function assignTaxi(url, value) {
	if (xhr) {
		var data = "value=" + value + "&action=assign";
		xhr.open("POST", url, true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhr.onload = function() {
			if (xhr.status == 200) {
				console.log(xhr.responseText);
			}
		};
		xhr.send(data);
	}
}
