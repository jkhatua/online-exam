<?php

	if (!isset($_SESSION)) {
	    session_start();
	  }

	  $user = $_SESSION['user'];
	  if (!isset($user)) {
	    header("Location: ../error_login.php?session=absent");
	    exit();
	  }

	if (isset($_POST['logout'])) {
		// echo "Hello";
		session_destroy();
		header("Location: ../index.php?logout=success");
		exit();
	}

?>