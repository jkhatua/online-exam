<?php

	session_start();

	  if (!isset($_SESSION['user'])) {
	    header("Location: error_login.php?session=absent");
	    exit();
	  }

	include 'dbh.inc.php';

	if (isset($_POST['result'])) {
		$can_id = $_POST['can_id'];

		$results_array = array();

		$result = "SELECT * FROM results WHERE can_id='$can_id'";
        $result_query = mysqli_query($conn, $result);
        $result_data = mysqli_fetch_assoc($result_query);

        $results_array['dates'] = $result_data['dates'];
        $results_array['can_id'] = $result_data['can_id'];
        $results_array['subject'] = $result_data['subject'];

        $subject = $result_data['subject'];
        $percent = ($result_data['result']/$result_data['total'])*100;

        $results_array['percent'] = $percent;
        
        $fetch_subject = mysqli_query($conn, "SELECT subjects_name FROM subjects WHERE subjects='$subject'");
        $fetch_subject_data = mysqli_fetch_assoc($fetch_subject);

        $results_array['subjects_name'] = $fetch_subject_data['subjects_name'];

        $fetch_candidate = mysqli_query($conn, "SELECT can_name FROM candidate_details");
        $fetch_candidate_details = mysqli_fetch_assoc($fetch_candidate);

        $results_array['can_name'] = $fetch_candidate_details['can_name'];

        // print_r($results_array);
        $_SESSION['results_array'] = $results_array;
        header("Location: ../get_results.php");
        exit();
	}

?>