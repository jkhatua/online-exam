<?php

	include 'dbh.inc.php';

	if (!isset($_SESSION)) {
	    session_start();
	  }

	if (isset($_POST['submit'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];

		if (!empty($username) || !empty($password)) {
			//For Admin
			$fetch = "SELECT * FROM admin WHERE admin_email='$username' AND admin_pwd='$password'";
			$fetch_query = mysqli_query($conn, $fetch);
			while ($row = mysqli_fetch_assoc($fetch_query)) {
				if ($username == $row['admin_email']) {
					// $hash = $row['admin_pwd'];
					// var_dump(password_verify($password, $row['admin_pwd']));
					if ($password == $row['admin_pwd']) {
						// echo "Hello";
						$_SESSION['user'] = $username;

						$_SESSION['successmsg'] = "You have Successfully logged in";
						header("Location: ../login_manage.php?admin=login");
						exit();
					}
				}
			}
			//For Techers
			$fetch = "SELECT * FROM administration WHERE admin_email='$username' AND admin_password='$password'";
			$fetch_query = mysqli_query($conn, $fetch);
			while ($row = mysqli_fetch_assoc($fetch_query)) {
				if ($username == $row['admin_email']) {
					if ($password == $row['admin_password']) {
						// $_SESSION['user'] = $username;
						$_SESSION['user_name'] = $row['admin_name'];
	                	$_SESSION['user_email'] = $row['admin_email'];
		              	$_SESSION['user_type'] = $row['admin_type'];
		              	$_SESSION['sub_id'] = $row['sub_id'];
						// echo "Teachers Login";
						//Teachers Page Section
						header("Location: ../teacher0.php?Teachers=login");
						exit();
					}
				}
			}
			// echo "helo";
		}

		$_SESSION['failuremsg'] = "Invalid Credentails Entered";
		// header("Location: ../login.php?login=error");
		header("Location: ../index.php?login=error");
		exit();
	}

?>