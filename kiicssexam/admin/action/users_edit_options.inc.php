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

	if (isset($_POST['delete_user'])) {
		// echo "delete";
		$sub_id = $_POST['sub_id'];

		$select_admin_type = "SELECT admin_type FROM administration WHERE sub_id='$sub_id'";
		$select_admin_type_query = mysqli_query($conn, $select_admin_type);
		if (mysqli_num_rows($select_admin_type_query) > 0) {
			$select_admin_type_data = mysqli_fetch_assoc($select_admin_type_query);
			$subject = $select_admin_type_data['admin_type'];
		}

		$delete = "DELETE FROM administration WHERE sub_id='$sub_id'";

		if (mysqli_query($conn, $delete)) {
			// echo "Successfully deleted";

			$delete_records = "DELETE FROM questions WHERE sub_id='$sub_id'";
			if ($delete_records_query = mysqli_query($conn, $delete_records)) {
				$select_admin_type = "SELECT * FROM administration WHERE admin_type='$subject'";
				$select_admin_type_query = mysqli_query($conn, $select_admin_type);
				$num = mysqli_num_rows($select_admin_type_query);
				// echo $num;
				if ($num == 0) {
					$delete_subjects = "DELETE FROM subjects WHERE subjects='$subject'";
					echo $delete_subjects;
					if ($delete_subjects_query = mysqli_query($conn, $delete_subjects)) {
						// echo "Hello";
						$_SESSION['successmsg'] = "Deleted Student details successfully";
						header("Location: ../users_manage.php?delete=success");
						exit();
					}
						
				} 
				else {
					$_SESSION['successmsg'] = "Deleted Student details successfully";
					header("Location: ../users_manage.php?delete=success");
					exit();
				}
			} else {
				$_SESSION['successmsg'] = "Deleted Student details successfully";
				header("Location: ../users_manage.php?delete=success");
				exit();
			}
		}
		// else {
			echo "Failed to delete";
			$_SESSION['successmsg'] = "Failed to delete Student details";
			header("Location: ../users_manage.php?delete=failed");
			exit();
		// }
	}

	elseif (isset($_POST['edit_user'])) {
		// echo "Edit";
		$sub_id = $_POST['sub_id'];

		$fetch = "SELECT * FROM administration WHERE sub_id='$sub_id'";
		$fetch_user = mysqli_query($conn, $fetch);
		if ($row = mysqli_fetch_assoc($fetch_user)) {
			print_r($row);
			$_SESSION['edit_user'] = $row;
			header("Location: ../edit_user.php");
			exit();
		}
		else {
			// echo "Failed to fetch";
			header("Location: ../users_manage.php?user_fetch=failed");
			exit();	
		}

		header("Location: ../users_manage.php?user_fetch=failed");
		exit();	
	}

?>