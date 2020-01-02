<?php

	if (!isset($_SESSION)) {
    session_start();
  }
  $user = $_SESSION['user'];
  if (!isset($_SESSION['user'])) {
	    header("Location: error_login.php?session=absent");
	    exit();
	  }

	include 'dbh.inc.php';

	if (isset($_POST['edit_student_button'])) {

		$sub_id = $_POST['sub_id'];

		$user_name = $_POST['edit_user_name'];
		// $user_id = $_POST['edit_user_id'];
		$user_email = $_POST['edit_user_email'];
		$user_password = $_POST['edit_user_password'];
		$user_subject_code= $_POST['edit_user_subject_code'];

		$update = "UPDATE administration SET admin_name='$user_name' , admin_email='$user_email' , admin_password='$user_password' , admin_type ='$user_subject_code' WHERE sub_id='$sub_id'";

		if (mysqli_query($conn, $update)) {
			echo "Successfully updated";
			$_SESSION['successmsg'] = "Successfully updated user details";
			header("Location: ../users_manage.php?user_update=success");
			exit();
		} else {
			echo "Failed to update";
			$_SESSION['failuremsg'] = "Failed to delete Student details";
			header("Location: ../users_manage.php?user_update=failed");
			exit();
		}
	}

?>