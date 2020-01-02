<?php
	
	// include "datetime.inc.php";
	include 'dbh.inc.php';
	
	if(!isset($_SESSION)){
	      session_start();
	  }
	
	if (isset($_POST['submit'])) {


		// unset cookies
		if (isset($_SERVER['HTTP_COOKIE'])) {
		    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
		    foreach($cookies as $cookie) {
		        $parts = explode('=', $cookie);
		        $name = trim($parts[0]);
		        setcookie($name, '', time()-1000);
		        setcookie($name, '', time()-1000, '/');
		    }
		}
		
		session_unset();
		session_destroy();
		header("Location: ../index.php?exam=completed");
		exit();
	}

?>