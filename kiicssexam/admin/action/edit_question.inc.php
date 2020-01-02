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

	if (isset($_POST['submit'])) {

		$q_no = $_SESSION['qno'];
		// echo $q_no;

		// $qno = $_POST['qno'];
		$question = $_POST['question'];
		$answer = $_POST['answer'];
		$option1 = $_POST['optionA'];
		$option2 = $_POST['optionB'];
		$option3 = $_POST['optionC'];
		$option4 = $_POST['optionD'];
		$mark = $_POST['mark'];
		// $option4 = $_POST['optionD'];

		// echo $q_no;

		// $update = "UPDATE questions SET qno='$qno', question='Hello', answer='$answer', optionA='$option1', optionB='$option2', optionC='$option3', optionD='$option4', mark='$mark' WHERE questions.id='47' ";

		$update = "UPDATE `questions` SET `question`='$question',`optionA`='$option1',`optionB`='$option2',`optionC`='$option3',`optionD`='$option4',`answer`='$answer',`marks`='$mark' WHERE questions.id='$q_no'";

		// echo $update;

		if ($update_query = mysqli_query($conn, $update)) {
			// echo "Success";
			$message = "Question successfully updated";
			// echo $message;
			header("Location: ../subjects_manage.php?question_edit=success");
			exit();
		} else {
			// echo "Failed to update";
			$message = "Question couldn't be updated";
			header("Location: ../subjects_manage.php?question_edit=failed");
			exit();
		}
	}

?>