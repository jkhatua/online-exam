<?php

	include 'dbh.inc.php';
	
	if(!isset($_SESSION)){
	    session_start();
	}

	if (isset($_POST['can_id']) && (isset($_POST['password'])))
	{
		$can_id = $_POST['can_id'];
		$can_password = $_POST['password'];
		$data = array();
		// $fetch = "SELECT * FROM candidate_details WHERE status='Not Appeared' AND can_id='$can_id' AND can_password='$can_password'";
		$fetch = "SELECT * FROM candidate_details WHERE can_id='$can_id' AND can_password='$can_password'";
		$result = mysqli_query($conn, $fetch);
		$count = mysqli_num_rows($result);
		if ($count > 0) {
			$row = mysqli_fetch_assoc($result);
			if ($row['status'] == "appeared") {
				$data['success']= false;
				$data['heading']="Authenticated Failed";
				$data['msg']="You have already Appeared the examination";
			} else {
				$page = "exam_rules.php";

				$data['success']= true;
				$data['heading']="Successfully Authenticated";
				$data['msg']="You have been successfully Authenticated";

				$data['page'] = $page;

				$_SESSION['can_id'] = $can_id;
				$_SESSION['subject'] = $row['subject'];
				$_SESSION['can_name'] = $row['can_name'];
				$_SESSION['can_email'] = $row['can_email'];
				$_SESSION['subject'] = $row['subject'];
				// echo $row['subject'];
				// echo "success";
			}
		} else {
			$data['success']= false;
			$data['heading']="Invalid Credentials";
			$data['msg']="Please input the correct Credentials";
		}

	echo json_encode($data);
	exit();
	}
?>