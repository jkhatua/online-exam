<?php

	include 'dbh.inc.php';

	session_start();

	if (!isset($_SESSION['user'])) {
	    header("Location: error_login.php?session=absent");
	    exit();
	  }

	if (isset($_POST['set'])) {
		$sub = $_POST['sub'];
		$no = $_POST['no'];
		$hours = $_POST['hours'];
		$mins = $_POST['mins'];
		$secs = $_POST['secs'];

		$time = ($hours * 60*60)+($mins*60)+$secs;
		// echo $time;

		$update = "UPDATE subjects SET time_limit='$time', no_of_questions='$no' WHERE subjects='$sub'";
		if (mysqli_query($conn, $update)) {
			$_SESSION['successmsg'] = "Successfully updated the time";
			header("Location: ../subjects_manage.php?save=success");
			exit();
		} else {
			$_SESSION['failuremsg'] = "Failed to set the time";
			header("Location: ../subjects_manage.php?save=failed");
			exit();
		}
	}

?>