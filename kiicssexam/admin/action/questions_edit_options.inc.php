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

	if (isset($_POST['edit_question'])) {
		$qno = $_POST['question'];
		
		$fetchquestion = "SELECT * FROM questions WHERE id='$qno'";
		$fetchquestion_query = mysqli_query($conn, $fetchquestion);
		while ($row = mysqli_fetch_assoc($fetchquestion_query)) {
			$edit_array = array("id"=>$row['id'], "question"=>$row['question'], "optionA"=>$row['optionA'], "optionB"=>$row['optionB'], "optionC"=>$row['optionC'], "optionD"=>$row['optionD'], "answer"=>$row['answer'], "marks"=>$row['marks']);
			
			// print_r($edit_array);
			$_SESSION['edit'] = $edit_array;
			// print_r($_SESSION['edit_question']);
			$_SESSION['successmsg'] = "Successfully updated the question";
			header("Location: ../edit_question.php");
			exit();
		}
	}
	elseif (isset($_POST['delete_question'])) {
		$qno = $_POST['question'];
		// echo "Delete question id ".$qno;
		$del = "DELETE FROM questions WHERE id='$qno'";
		if ($delquery = mysqli_query($conn, $del)) {
			$_SESSION['successmsg'] = "Successfully deleted question";
			header("Location: ../subjects_manage.php?delete=success");
			exit();
		} else {
			$_SESSION['failuremsg'] = "Failed to delete the question";
			header("Location: ../subjects_manage.php?delete=failed");
			exit();
		}
	}

?>