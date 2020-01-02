<?php
	
	if(!isset($_SESSION)){
	    session_start();
	}
 	$can_id = $_SESSION['can_id'];
	$user_name = $_SESSION['can_name'];
	$user_email = $_SESSION['can_email'];
	$subject = $_SESSION['subject'];

	$exam_start_time = $_SESSION['exam_start_time'];    //Session variable storing exam start timestamp
  	$exam_start_time = date("Y-m-d H:i:s", $exam_start_time);

	include 'dbh.inc.php';
	include 'functions.inc.php';
	
	if (isset($_SESSION['marked_questions'])) {
		$marked_questions = $_SESSION['marked_questions'];
	}

	$no_of_questions = $_SESSION['no_of_questions'];
	if (isset($_POST['marked'])) {
		$qno = $_POST['qno'];
		$qid = $_POST['qid'];
		
		$a = explode(".", $qno);
		$qno = $a[0];

		// Checking if any value is being given STARTS here
		if (isset($_POST['option'])) {
			$option = $_POST['option'];
			$question = $_POST['question'];
			
			$fetch = "SELECT answer, marks FROM questions WHERE question='$question'";			//Fetch marks and answers from questions table STARTS
			// echo $fetch;
			$resultfetch = mysqli_query($conn, $fetch);
			$row = mysqli_fetch_assoc($resultfetch);
			$answer = $row['answer'];
			$marks = $row['marks'];			//Fetch marks and answers from questions table ENDS to be used

			$check_attempt = "SELECT * FROM answers WHERE qno='$qno' AND can_id='$can_id' AND subject='$subject' AND dates>='$exam_start_time'";
			// echo $check_attempt;
			$check_attempt_query = mysqli_query($conn, $check_attempt);
			$check_attempt_data = mysqli_num_rows($check_attempt_query);

			if ($check_attempt_data > 0) {
				if ($option == $answer) {
					// echo "Right Answer";
					$insert = "UPDATE  answers SET can_id='$can_id', subject='$subject', answers_given='$option', correct_ans='$answer', user_email='$user_email', qno='$qno', qid='$qid', user_name='$user_name', markgot='$marks' WHERE qno='$qno' AND can_id='$can_id' AND subject='$subject'";
					$insert_query = mysqli_query($conn, $insert);
				} else {
					// echo "Wrong Answer";
					// $marks = -($marks/2);
					$marks = 0.00;
					$insert = "UPDATE  answers SET can_id='$can_id', subject='$subject', answers_given='$option', correct_ans='$answer', user_email='$user_email', qno='$qno', qid='$qid', user_name='$user_name', markgot='$marks' WHERE qno='$qno' AND can_id='$can_id' AND subject='$subject'";
					$insert_query = mysqli_query($conn, $insert);
				}
			} else {
				//Insert data
				if (empty($option)) {
					$marks = 0.00;
					$insert = "INSERT INTO answers (can_id, answers_given, subject, correct_ans, user_email, qno, qid, user_name, markgot) VALUES ('$can_id', '', '$subject', '$answer', '$user_email', '$qno', '$qid', '$user_name', '$marks')";
					$insert_query = mysqli_query($conn, $insert);
				} elseif ($option == $answer) {
					// echo "Right Answer";
					$insert = "INSERT INTO answers (can_id, subject, answers_given, correct_ans, user_email, qno, qid, user_name, markgot) VALUES ('$can_id', '$subject', '$option', '$answer', '$user_email', '$qno', '$qid', '$user_name', '$marks')";
					$insert_query = mysqli_query($conn, $insert);
				} else {
					// echo "Wrong Answer";
					// $marks = -($marks/2);
					$marks = 0.00;
					$insert = "INSERT INTO answers (can_id, subject, answers_given, correct_ans, user_email, qno, qid, user_name, markgot) VALUES ('$can_id', '$subject', '$option', '$answer', '$user_email', '$qno', '$qid', '$user_name', '$marks')";
					$insert_query = mysqli_query($conn, $insert);
				}
			}
			// exit();
		}
		// Checking if any value is being given ENDS here

		$marked_questions[$qno] = "marked";
		print_r($marked_questions);
		$_SESSION['marked_questions'] = $marked_questions;

		if ($qno == $no_of_questions) {
			header("Location: ".$_SERVER['HTTP_REFERER']);
			exit();
		} else {
			$qno = $qno + 1;
			$_SESSION['qno'] = $qno;
			header('Location: ../exam_dashboard.php?saved=marked');
			exit();
		}
		
	} elseif (isset($_POST['skip'])) {
		// echo "Skip the Question";
		$qno = $_POST['qno'];
		$qid = $_POST['qid'];

		$question = $_POST['question'];
		// skipfunction($qno, $question);
		echo skipfunction($qid, $qno, $question);

		if ($_SESSION['qno'] > $_SESSION['no_of_questions']) {
			echo exitexam();
			exit();
		} else {
			header("Location: ../exam_dashboard.php");
			exit();
		}

	}
	elseif (isset($_POST['num'])) {
		// echo "hello";
		$qno = $_POST['q_num'];
		$check_attempt = "SELECT * FROM answers WHERE qno='$qno'";
		$check_attempt_query = mysqli_query($conn, $check_attempt);
		while ($check_ans = mysqli_fetch_assoc($check_attempt_query)) {
			$abc = $check_ans['answers_given'];
			$_SESSION['ans'] = $abc;
		}
		// echo $qno;
		$fetch = "SELECT qno FROM answers WHERE can_id='$can_id' AND user_email='$user_email'";

		$_SESSION['qno'] = $qno;
		// $ans = $_SESSION['ans'];
		// echo $ans;
		header("Location: ../exam_dashboard.php");
		exit();
	}
	elseif (isset($_POST['submit'])) {
		// echo "Submit form";
		$qno = $_POST['qno'];
		$qid = $_POST['qid'];
		$question = $_POST['question'];
		$option = $_POST['option'];

		$a = explode(".", $qno);
		$qno = $a[0];
		// echo $qno;

		if (isset($marked_questions[$qno])) {
			unset($marked_questions[$qno]);
			print_r($marked_questions);
			$_SESSION['marked_questions'] = $marked_questions;
		}

		$fetch = "SELECT answer, marks FROM questions WHERE question='$question'";			//Fetch marks and answers from questions table STARTS
		$resultfetch = mysqli_query($conn, $fetch);
		$row = mysqli_fetch_assoc($resultfetch);
		$answer = $row['answer'];
		$marks = $row['marks'];			//Fetch marks and answers from questions table ENDS to be used

		$check_attempt = "SELECT * FROM answers WHERE qno='$qno' AND can_id='$can_id' AND subject='$subject' AND dates>='$exam_start_time'";
		// echo $check_attempt;
		$check_attempt_query = mysqli_query($conn, $check_attempt);
		while ($check_ans = mysqli_fetch_assoc($check_attempt_query)) {
			$abc = $check_ans['answers_given'];
			// echo $abc;
			// $_SESSION['ans'] = $abc;

			if ($option == $answer) {
				// echo "Right Answer";
				$insert = "UPDATE  answers SET can_id='$can_id', subject='$subject', answers_given='$option', correct_ans='$answer', user_email='$user_email', qno='$qno', qid='$qid', user_name='$user_name', markgot='$marks' WHERE qno='$qno' AND can_id='$can_id' AND subject='$subject'";
				$insert_query = mysqli_query($conn, $insert);
			} else {
				// echo "Wrong Answer";
				// $marks = -($marks/2);
				$marks = 0.00;
				$insert = "UPDATE  answers SET can_id='$can_id', subject='$subject', answers_given='$option', correct_ans='$answer', user_email='$user_email', qno='$qno', qid='$qid', user_name='$user_name', markgot='$marks' WHERE qno='$qno' AND can_id='$can_id' AND subject='$subject'";
				$insert_query = mysqli_query($conn, $insert);
			}
			$check_last_question = "SELECT no_of_questions FROM subjects where subjects='infosec'";
			// echo $check_last_question;
			$check_last_question_query = mysqli_query($conn, $check_last_question);
			$check_last = mysqli_fetch_assoc($check_last_question_query);
			if ($qno == $check_last['no_of_questions']) {
				// exitexam();
				echo exitexam();
			}

			$qno = $qno + 1;
			// echo $qno;
			
			$_SESSION['qno'] = $qno;

			if ($_SESSION['qno'] > $_SESSION['no_of_questions']) {
				echo exitexam();
				exit();
			} else {
				$row = $_SESSION['row'];
				// print_r($row);
				// echo "Edited";
				header("Location: ../exam_dashboard.php");
				exit();
			}
		}
		
		if (empty($option)) {
			$marks = 0.00;
			$insert = "INSERT INTO answers (can_id, answers_given, subject, correct_ans, user_email, qno, qid, user_name, markgot) VALUES ('$can_id', '', '$subject', '$answer', '$user_email', '$qno', '$qid', '$user_name', '$marks')";
			$insert_query = mysqli_query($conn, $insert);
		}

		if ($option == $answer) {
			// echo "Right Answer";
			$insert = "INSERT INTO answers (can_id, subject, answers_given, correct_ans, user_email, qno, qid, user_name, markgot) VALUES ('$can_id', '$subject', '$option', '$answer', '$user_email', '$qno', '$qid', '$user_name', '$marks')";
			$insert_query = mysqli_query($conn, $insert);
		} else {
			// echo "Wrong Answer";
			// $marks = -($marks/2);
			$marks = 0.00;
			$insert = "INSERT INTO answers (can_id, subject, answers_given, correct_ans, user_email, qno, qid, user_name, markgot) VALUES ('$can_id', '$subject', '$option', '$answer', '$user_email', '$qno', '$qid', '$user_name', '$marks')";
			$insert_query = mysqli_query($conn, $insert);
		}
		
		$check_last_question = "SELECT no_of_questions FROM subjects where subjects='infosec'";
		// echo $check_last_question;
		$check_last_question_query = mysqli_query($conn, $check_last_question);
		$check_last = mysqli_fetch_assoc($check_last_question_query);
		if ($qno == $check_last['no_of_questions']) {
			// exitexam();
			echo exitexam();
		}

		$qno = $qno + 1;
		// echo $qno;
		
		$_SESSION['qno'] = $qno;

		if ($_SESSION['qno'] > $_SESSION['no_of_questions']) {
			echo exitexam();
			exit();
		} else {
			header("Location: ../exam_dashboard.php");
			exit();
		}
	}
	elseif (isset($_POST['exit'])) {
		// exitexam();
		echo exitexam();	
	}


?>