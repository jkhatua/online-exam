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


	if (isset($_POST['add_user_button'])) {
		$u_name = $_POST['add_user_name'];
		// $u_id = $_POST['add_user_id'];
		$u_email = $_POST['add_user_email'];
		$u_pwd = $_POST['add_user_password'];
		$u_sub = $_POST['add_user_subject'];
		$u_subcode = $_POST['add_user_subject_code'];
		$u_subid = $_POST['add_user_subject_id'];
		// $u_name = $_POST['add_user_name'];

		$data = array();

		$data['success'] = false;

		if (!empty($u_name) || !empty($u_email) || !empty($u_pwd) || !empty($u_sub) || !empty($u_subcode) || !empty($u_subid)) {
			if (preg_match('/^[a-zA-Z]+[\s\w]*$/', $u_name)) {
				$u_name = filter_var($u_name, FILTER_SANITIZE_STRING);
					if (filter_var($u_email, FILTER_VALIDATE_EMAIL)) {
						$u_email = filter_var($u_email, FILTER_SANITIZE_EMAIL);
						if (filter_var($u_pwd, FILTER_SANITIZE_STRING)) {
							if (filter_var($u_sub, FILTER_SANITIZE_STRING)) {
								if (preg_match('/^[a-zA-Z0-9]+$/', $u_subcode)) {
									if (filter_var($u_subid, FILTER_SANITIZE_STRING)) {
										// echo $u_subid;
										$insert_user = "INSERT INTO administration (admin_name, admin_email, admin_type, admin_password, sub_id) VALUES ('$u_name', '$u_email', '$u_subcode', '$u_pwd', '$u_subid')";

										$check_subject = "SELECT * FROM subjects";
										$check_subject_query = mysqli_query($conn, $check_subject);
										$count = 0;
										while ($check = mysqli_fetch_assoc($check_subject_query)) {
											if ($check['subjects'] == $u_subcode) {
												$count++; 
											}
										}
										if ($count == 0) {
											$insert_subject = "INSERT INTO subjects (subjects, subjects_name) VALUES ('$u_subcode', '$u_sub')";
											if ($insert_subject_query = mysqli_query($conn, $insert_subject)) {
												echo "Subject Inserted"; 
											}
										}

										$check_user = "SELECT * FROM administration";
										$check_users_query = mysqli_query($conn, $check_user);
										$count = 0;
										while ($check = mysqli_fetch_assoc($check_users_query)) {
											if ($check['sub_id'] == $u_subid) {
												$count++;
											}
										}
										if ($count == 0) {
											if ($insert_user = mysqli_query($conn, $insert_user)) {
												// echo "Successfully added user";
												$data['success'] = true;
												$_SESSION['successmsg'] = "Successfully added user";
												// echo json_encode($data);
												header("Location: ../users_manage.php?adduser=success");
												exit();
											} 
										}
									}
								}
							}
						}
					}
			}
		} 
		// $var = json_encode($data);
		// echo $var;
		// return json_encode($data);
		$_SESSION['failuremsg'] = "Failed to add user";
		header("Location: ../users_manage.php?add_user=failed");
		exit();
	}

?>