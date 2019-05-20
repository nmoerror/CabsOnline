// file xhr.js
function createRequest() {
	var xhr = false;
	if (window.XMLHttpRequest) {
		xhr = new XMLHttpRequest();
	}
	return xhr;
} // end function createRequest()
