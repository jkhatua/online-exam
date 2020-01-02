<?php

	include 'dbh.inc.php';

	if (!isset($_SESSION)) {
	    session_start();
	  }

	  $user = $_SESSION['user'];
	  if (!isset($user)) {
	    header("Location: ../error_login.php?session=absent");
	    exit();
	  }

	if (isset($_POST['edit_student_button'])) {
		$id = $_POST['id'];
		$student_id = $_POST['edit_student_id'];
		$student_name = $_POST['edit_student_name'];
		$student_status = $_POST['edit_student_status'];
		$student_email = $_POST['edit_student_email'];
		$student_pwd = $_POST['edit_student_password'];
		$student_contact = $_POST['edit_student_contact'];
		$student_gender = $_POST['edit_gender'];
		$student_blood_group = $_POST['edit_student_blood_group'];
		$student_dob = $_POST['edit_student_dob'];
		$student_address = $_POST['edit_student_address'];

		// echo $student_status;
		$update = "UPDATE candidate_details SET can_id='$student_id', can_name='$student_name', status='$student_status', can_email='$student_email', can_password='$student_pwd', can_contact='$student_contact', can_gender='$student_gender', can_blood_group='$student_blood_group', can_DOB='$student_dob', can_address='$student_address' WHERE id='$id'";
		$update_query = mysqli_query($conn, $update);

		if ($student_status == "Not Appeared") {
			// echo $student_status;
			$delete = "DELETE FROM results WHERE can_id='$student_id'";
			$delete_query = mysqli_query($conn, $delete);

			$delete_answers = "DELETE FROM answers WHERE can_id='$can_id'";
		 	$delete_answers_query = mysqli_query($conn, $delete_answers);
		}

		if ($update_query) {
			// echo "Success";
			$_SESSION['successmsg'] = "Updated Student details successfully";
			header("Location: ../students_manage.php?edit=success");
			exit();
		} else {
			// echo "Failed";
			$_SESSION['failuremsg'] = "Failed to update student details";
			header("Location: ../students_manage.php?edit=Failed");
			exit();
		}

	}

?>