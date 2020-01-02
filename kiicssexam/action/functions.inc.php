<?php

	// include "datetime.inc.php";	

	if (!isset($_SESSION)) {
		session_start();
	}
	
	function skipfunction($qid, $qno, $question) {

		include 'dbh.inc.php';
		
		$can_id = $_SESSION['can_id'];
		$user_name = $_SESSION['can_name'];
		$user_email = $_SESSION['can_email'];
		$subject = $_SESSION['subject'];

		$fetch = "SELECT answer FROM questions WHERE question='$question'";
		$resultfetch = mysqli_query($conn, $fetch);
		$row = mysqli_fetch_assoc($resultfetch);
		$answer = $row['answer'];

		$marks = 0.00;
		$insert = "INSERT INTO answers (can_id, answers_given, subject, correct_ans, user_email, qno, qid, user_name, markgot) VALUES ('$can_id', '', '$subject', '$answer', '$user_email', '$qno', '$qid', '$user_name', '$marks')";
		$insert_query = mysqli_query($conn, $insert);

		$qno = $qno + 1;
		
		$_SESSION['qno'] = $qno;

		// if ($qno > $_SESSION['no_of_questions']) {
	 //        echo $qno;
	 //      }

		// header("Location: ../exam_dashboard.php");
		// exit();
	}

	function exitexam() {

		include 'dbh.inc.php';

		$can_id = $_SESSION['can_id'];
		$user_name = $_SESSION['can_name'];
		$subject = $_SESSION['subject'];
		$user_email = $_SESSION['can_email'];

		$exam_start_time = $_SESSION['exam_start_time'];    //Session variable storing exam start timestamp
  		$exam_start_time = date("Y-m-d H:i:s", $exam_start_time);

		$update_candidate = "UPDATE candidate_details SET status='appeared' WHERE can_id='$can_id' AND subject='$subject'"; //update candidate details as they have appeared the exam
		$update_candidate_query = mysqli_query($conn, $update_candidate);

		unset($_SESSION['qno']);
		unset($_SESSION['no_of_questions']);
		unset($_SESSION['exam_start']);
		unset($_SESSION['time_limit']);
		// setcookie("timer", "", time()-3600);
		if (isset($_COOKIE['timer'])) {
			setcookie('timer','', time()-3600);
		}

		$exam_start_time = $_SESSION['exam_start_time'];    //Session variable storing exam start timestamp
		$exam_start_time = date("Y-m-d H:i:s", $exam_start_time);
		$fetch = "SELECT * FROM answers WHERE user_email='$user_email' AND dates>'$exam_start_time'";
		$fetch_query = mysqli_query($conn, $fetch);

		$num = mysqli_num_rows($fetch_query);
		$marks_achieved = 0;
		if ($num > 0) {
			while ($answers = mysqli_fetch_array($fetch_query)) {
				$marks_achieved = $marks_achieved + $answers['markgot'];
				// $send_results = $answers;
			}
		}
		$results_data = array();

		$fetch_subject_query = mysqli_query($conn, "SELECT * FROM subjects WHERE subjects='$subject'");
		$fetch_subject_data = mysqli_fetch_assoc($fetch_subject_query);
		$subjects_name = $fetch_subject_data['subjects_name'];

		// echo $user_name;
		// echo $subject;
		// echo $subject_name;
		$results_data['subjects_name'] = $subjects_name;
		$results_data['user_name'] = $user_name;
		$results_data['marks_achieved'] = $marks_achieved;
		$results_data['subjects_name'] = $subjects_name;

		$totalmarks = 0.00;
		$row = $_SESSION['row'];
		foreach ($row as $question_data) {
			// echo $question_data[];
			$totalmarks = $totalmarks + $question_data['marks'];
		}
		$totalmarks = (float) $totalmarks;
		$results_data['totalmarks'] = $totalmarks;
		
		$insert_result = "INSERT INTO results (can_id, subject, result, total) VALUES ('$can_id', '$subject', '$marks_achieved', '$totalmarks')";

		mysqli_query($conn, $insert_result);

		// print_r($results_data);
		$_SESSION['results_data'] = $results_data;

		header("Location: ../exam_finish.php");
		exit();
	}

?>