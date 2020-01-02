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

	if (isset($_POST['view'])) {
		$sub_id = $_POST['subject'];
		$sub_array = array();
		$questions = "SELECT * FROM questions WHERE sub_id='$sub_id'";
		$questions_query = mysqli_query($conn, $questions);
		while ($row = mysqli_fetch_assoc($questions_query)) {
			$each_question = array("id"=>$row['id'],"question"=>$row['question'], "sub_id"=>$row['sub_id'], "optionA"=>$row['optionA'], "optionB"=>$row['optionB'], "optionC"=>$row['optionC'], "optionD"=>$row['optionD'], "answer"=>$row['answer'], "marks"=>$row['marks']);
			$sub_array[] = $each_question;
		}
		$_SESSION['questions'] = $sub_array;
		header("Location: ../view_questions.php?fetch=success");
		exit();
	}

?>