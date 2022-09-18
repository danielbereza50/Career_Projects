// if you want to see a cookie, delete 'seen-cookiePopup' from cookies first.
jQuery(document).ready(function($) {

   // Get CookieBox
  var cookieBox = document.getElementById('cookiebarBox');
	// Get the <span> element that closes the cookiebox
  var closeCookieBox = document.getElementById("cookieBoxok");


    closeCookieBox.onclick = function() {
        cookieBox.style.display = "none";
    };

    /**
     * Set cookie
     *
     * @param string name
     * @param string value
     * @param int days
     * @param string path
     * @see http://www.quirksmode.org/js/cookies.html
     */
    function createCookie(name, value, days, path) {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toGMTString();
        }
        else expires = "";
        document.cookie = name + "=" + value + expires + "; path=" + path;
    }

    function readCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }

    // Set/update cookie
    var cookieExpiry = 1;
    var cookiePath = "/";

    document.getElementById("cookieBoxok").addEventListener('click', function () {
        createCookie('seen-cookiePopup', 'yes', cookieExpiry, cookiePath);
    });




    var cookiePopup = readCookie('seen-cookiePopup');
    if (cookiePopup != null && cookiePopup == 'yes') {
        cookiebarBox.style.display = 'none';
    } else {
        cookiebarBox.style.display = 'block';
    }


	
	
	

});
  