<?php

	include 'dbh.inc.php';
	
	if(!isset($_SESSION)){
	    session_start();
	}

	// if (isset($_POST['submit']))
	if (isset($_POST['can_id']) && (isset($_POST['password'])))
	{
		// $can_id = $_POST['can_id'];
		// $can_pwd = $_POST['password'];

		$data = array();

		if (!empty($can_id) || !empty($can_pwd)) {
			$fetch = "SELECT * FROM candidate_details";
			$result = mysqli_query($conn, $fetch);
			$count = mysqli_num_rows($result);
			if ($count > 0) {
				while ($row = mysqli_fetch_assoc($result)) {
					// if ($row['status'] == "Not Appeared") {		//To check if they have already appeared the exam or not
					// 	$data['success']=false;
					// }
					if ($row['can_id'] == $can_id) {
						if ($row['can_password'] == $can_pwd) {
							// echo "Hello";

							$data['success']=true;

							$_SESSION['can_id'] = $can_id;
							$_SESSION['subject'] = $row['subject'];
							$_SESSION['can_name'] = $row['can_name'];
							$_SESSION['can_email'] = $row['can_email'];
							$_SESSION['subject'] = $row['subject'];
							// echo "success";
							header("Location: ../exam_rules.php");
							exit();
						} else {
							// echo "Pass";
							header("Location: ../index.php?login=error");
							exit();					
						}
					}
					// echo "ID";
					header("Location: ../index.php?login=error");
					exit();					
				}
			} else {
				$data['success']=false;
				// echo "hi";
				header("Location: ../index.php?login=error");
				exit();					
			}
		} else {
			header("Location: ../index.php?fields=empty");
			exit();					
		}
	} else {
		header("Location: ../index.php?error");
		exit();
	}

	echo json_encode($data);

	header("Location: ../index.php?login=error");
	exit();
?>