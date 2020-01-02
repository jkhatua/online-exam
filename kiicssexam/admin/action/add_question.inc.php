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

	if (isset($_POST['add_question_button'])) {
		$sub_id = $_POST['sub_id'];
		$sub_name = $_POST['sub_name'];
		$question = $_POST['question'];
		$optionA = $_POST['optionA'];
		$optionB = $_POST['optionB'];
		$optionC = $_POST['optionC'];
		$optionD = $_POST['optionD'];
		$answer = $_POST['answer'];
		$marks = $_POST['marks'];

		// echo "Hello";
		if ( empty($sub_id) || empty($question) || empty($optionA) || empty($optionB) || empty($optionC) || empty($optionD) || empty($answer) || empty($marks)) {
			echo "Fields Empty";
			// echo $student_id.$student_name.$student_email.$student_password.$student_contact.$gender.$student_blood_group.$student_address;
			$_SESSION['failuremsg'] = "All fields must be filled to add a question";
			header("Location: ../subjects_manage.php?fields=empty");
			exit();
		} else {

	      // $sub_code_fetch_query = mysqli_query($conn, "SELECT admin_type FROM administration WHERE sub_id=''");
	      // $fetch_sub_code = mysqli_fetch_assoc($sub_code_fetch_query);
	      // $sub_name = $fetch_sub_code['subjects'];

			$add_question = "INSERT INTO questions (sub_id, subject, question, optionA, optionB, optionC, optionD, answer, marks) VALUES ('$sub_id','$sub_name','$question','$optionA','$optionB','$optionC','$optionD','$answer','$marks')";
			// echo $add_question;
			// echo "<br>";
			if ($add_question_query = mysqli_query($conn, $add_question)) {
				// echo "Success";
				$_SESSION['successmsg'] = "Successfully added question";
				header("Location: ../subjects_manage.php?add_question=success");
				exit();
			} else {
				// echo "Failed";
				$_SESSION['failuremsg'] = "Failed to add the question";
				header("Location: ../subjects_manage.php?add_question=failed");
				exit();
			}
		}

		// echo "Failed2";
	}

?>