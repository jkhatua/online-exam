<?php

	// if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 500)) {
	//     // request 30 minates ago
	//     session_destroy();
	//     session_unset();
	// }
	// $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time


	if (isset($_SESSION["LAST_ACTIVITY"])) {
	    if (time() - $_SESSION["LAST_ACTIVITY"] > 1800) {
	        // last request was more than 30 minutes ago
	        session_unset();     // unset $_SESSION variable for the run-time 
	        session_destroy();   // destroy session data in storage
	    } else if (time() - $_SESSION["LAST_ACTIVITY"] > 60) {
	        $_SESSION["LAST_ACTIVITY"] = time(); // update last activity time stamp
	    }
	}

?>