<?php
	
	include "dbh.inc.php";

	if (!isset($_SESSION)) {
		session_start();
	}

	$data = array();

	if (isset($_POST['accept']) && isset($_POST['agree'])) {

		$ques_arr = array();
		$qno = 1;
		$subject = $_SESSION['subject'];
		$fetch_sub = "SELECT * FROM subjects WHERE subjects='$subject'";
		$fetch_sub_query = mysqli_query($conn, $fetch_sub);
		$data = mysqli_fetch_assoc($fetch_sub_query);
		$time_limit = $data['time_limit'];
		$no_of_questions = $data['no_of_questions'];

		$fetch_ques = "SELECT * FROM questions WHERE subject='$subject' ORDER BY RAND() LIMIT $no_of_questions";
		// $fetch_ques = "SELECT * FROM questions WHERE subject='infosec'";
		// echo $fetch_ques;
		$ques = mysqli_query($conn, $fetch_ques);
		$count = 1;
		while ($data = mysqli_fetch_assoc($ques)) {
			// var_dump($data);
			// $arr = array();
			// echo '<pre>'; print_r($data); echo '</pre>';
			// $arr[] = $data;
			// echo '<pre>'; print_r($arr); echo '</pre>';
			// array_push($a,"blue","yellow");
			$ques_arr[$count] = $data;
			$count++;
		}
		// echo '<pre>'; print_r($ques_arr); echo '</pre>';
		$_SESSION['qno'] = $qno;
		$_SESSION['time_limit'] = $time_limit;
		$_SESSION['no_of_questions'] = $no_of_questions;
		$_SESSION['exam_start'] = "exam_started";
		$_SESSION['row'] = $ques_arr;


		//Update details of candistate as appeared for exam STARTS
		$can_id = $_SESSION['can_id'];
		$user_name = $_SESSION['can_name'];
		$subject = $_SESSION['subject'];

		$update_candidate = "UPDATE candidate_details SET status='appeared' WHERE can_id='$can_id' AND subject='$subject'"; //update candidate details as they have appeared the exam
		$update_candidate_query = mysqli_query($conn, $update_candidate);
		//Update details of candistate as appeared for exam ENDS


		// print_r($ques_arr[4]);
		// echo "Hello";
		$exam_start_time = time();
		$_SESSION['exam_start_time'] = $exam_start_time;

		$data['success'] = true;
		$data['head'] = "success";
		$data['msg'] = "Exam has successfully started";
		$data['page'] = "exam_dashboard.php";

		header("Location: ../exam_dashboard.php?exam=start");
		exit();
		
		// echo $row['can_name'];
		// $_SESSION['qno'] = $qno;
		// $_SESSION['can_name'] = $row['can_name'];
		// header("Location: ../exam_dashboard.php?exam=start");
		// exit();	

		// header("Location: ../exam_rules.php?error");
		// exit();
	} else {
		
		$data['success'] = false;
		$data['head'] = "success";
		$data['msg'] = "Exam has successfully started";

		header("Location: ../exam_rules2.php?error");
		exit();
	}
?>