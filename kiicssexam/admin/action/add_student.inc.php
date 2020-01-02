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

	if (isset($_POST['add_student_button'])) {
		$student_id = $_POST['student_id'];
		$subject = $_POST['subject'];
		$student_name = $_POST['student_name'];
		$student_email = $_POST['student_email'];
		$student_password = $_POST['student_password'];
		$student_contact = $_POST['student_contact'];
		$gender = $_POST['gender'];
		$student_blood_group = $_POST['student_blood_group'];
		$dob = $_POST['dob'];
		$student_address = $_POST['student_address'];
		// echo "Hello";
		if ( (empty($student_id)) || (empty($subject)) || (empty($student_name)) || (empty($student_email)) || (empty($student_password)) || (empty($student_contact)) || (empty($gender)) || (empty($student_blood_group)) || (empty($dob)) || (empty($student_address)) ) {
			echo "Fields Empty";
			// echo $student_id.$student_name.$student_email.$student_password.$student_contact.$gender.$student_blood_group.$student_address;
			$_SESSION['failuremsg'] = "All fields are required to be filled";
			header("Location: ../students_manage.php?fields=empty");
			exit();
		} else {
			if ((preg_match("/^[a-zA-Z0-9]*$/", $student_id)) /*|| strlen($student_id) > 6*/) {
				if (preg_match("/^[a-zA-Z]+[\sa-zA-Z]+$/", $student_name)) {
					if (filter_var($student_email, FILTER_VALIDATE_EMAIL)) {
						if (strlen($student_password) > 3) {
							if (preg_match("/^[0-9]+$/", $student_contact) || strlen($student_contact) == 10) {
								if (($gender == "Male") || ($gender == "Female")) {
									if (($student_blood_group == "A+") || ($student_blood_group == "A-") || ($student_blood_group == "B+") || ($student_blood_group == "B-") || ($student_blood_group == "AB+") || ($student_blood_group == "AB-") || ($student_blood_group == "O+") || ($student_blood_group == "O-")) {
										if (preg_match("/^[a-zA-Z]+[a-zA-Z0-9]*$/", $student_address)) {
											
											$insert = "INSERT INTO candidate_details (can_id, subject, can_name, can_email, can_password, can_contact, can_gender, can_blood_group, can_DOB, can_address) VALUES ('$student_id','$subject','$student_name','$student_email','$student_password','$student_contact','$gender','$student_blood_group','$dob','$student_address')";
											// echo "Hello";
											// echo $insert;
											if ( $insert_query = mysqli_query($conn, $insert) ) {
												$success_message = "Data Inserted Successfully";
												$_SESSION['session'] = $success_message;
												$_SESSION['successmsg'] = $success_message;
												header("Location: ../students_manage.php?insert=success");
												exit();
											} else {
												$failed_message = "Failed to Insert Data";
												$_SESSION['failuremsg'] = $failed_message;
												header("Location: ../students_manage.php?insert=failed");
												exit();
											}

										}
									}
								}
							}
						}
					}
				}echo "Hello";
			}
		}

		// echo "Failed2";
		$failed_message = "Failed to Insert Data";
		$_SESSION['failuremsg'] = $failed_message;
		header("Location: ../students_manage.php?insert=failed");
		exit();
	}

?>