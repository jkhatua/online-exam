<?php
	
	if (!isset($_SESSION)) {
	    session_start();
	  }

	  $user = $_SESSION['user'];
	  if (!isset($user)) {
	    header("Location: error_login.php?session=absent");
	    exit();
	  }

	if (isset($_SESSION['edit_user'])) {
?>

<noscript>
   <!-- Your browser does not support JavaScript! -->
   <meta http-equiv="refresh" content="0;url=js_required.php">
</noscript>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>E-Exam</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <style type="text/css">
    body {
      height: 100%;
      background-color: #ffe6cc;
    }
    .main-page {
      margin-top: 50px;
      margin-left: 20%;
      /*background-color: #ffe6cc;*/
      /*height: 100%;*/
      /*margin-top: 80px;*/
    }
    
  </style>

</head>
<body>

<?php
  	
  	include 'layouts/topbar.php';
  	include 'layouts/sidebar.php';

  	include 'action/dbh.inc.php';

  	$user=$_SESSION['edit_user'];
  	// print_r($user);
?>

<section class="main-page">

    <div class="container" style="padding-top: 20px;">
    	<div class="row">
    		<div class="col-md-12">
    			<h1 class="text-center">Edit User Details</h1>
    		</div>
    	</div>
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <form action="action/edit_user.inc.php" method="POST" class="form-group">

	          <!-- <br> -->
	          <div class="container">
	            <div class="row">
	              <div class="col-md-12 text-center">
	                  <div class="container">

	                    <div class="row">
	                      <div class="col-md-12 form-inline" style="display: table;">
	                      	<input type="hidden" name="sub_id" value="<?php echo $user['sub_id']; ?>">
	                        <label class="form-control" for="edit_user_name" style=" display: table-cell; width: 150px;"><b>User Name</b></label>
	                        <input class="form-control" type="text" name="edit_user_name" value="<?php echo $user['admin_name']; ?>" placeholder="Enter User Name" style="display: table-cell; width: 100%;">      
	                      </div>
	                    </div>
	                    
	                    <div class="row">
	                      <div class="col-md-12 form-inline" style="display: table;">
	                        <label class="form-control" for="edit_user_email" style=" display: table-cell; width: 150px;"><b>User Email</b></label>
	                        <input class="form-control" type="text" name="edit_user_email" value="<?php echo $user['admin_email']; ?>" placeholder="Enter User Email" style="display: table-cell; width: 100%;">      
	                      </div>
	                    </div>
	                    
	                    <div class="row">
	                      <div class="col-md-12 form-inline" style="display: table;">
	                        <label class="form-control" for="edit_user_password" style=" display: table-cell; width: 150px;"><b>Password</b></label>
	                        <input class="form-control" type="text" name="edit_user_password" value="<?php echo $user['admin_password']; ?>" placeholder="Set User Password" style="display: table-cell; width: 100%;">      
	                      </div>
	                    </div>
	                    
	                    <div class="row">
	                      <div class="col-md-12 form-inline" style="display: table;">
	                        <label class="form-control" for="edit_user_subject_code" style=" display: table-cell; width: 150px;"><b>Subject Code</b></label>
	                        <input class="form-control" type="text" name="edit_user_subject_code" value="<?php echo $user['admin_type']; ?>" placeholder="Enter Student Contact Number" style="display: table-cell; width: 100%;">      
	                      </div>
	                    </div>
	                  </div>

	                  <div class="row">
	                    <div class="col-md-4"></div>
	                    <div class="col-md-4"></div>
	                    <div class="col-md-4 form-inline" style="display: table;">
	                      <button class="btn btn-success" name="edit_student_button" style="display: table-cell; width: 85%;">Submit Changes</button>
	                    </div>
	                  </div>

	              </div>
	            </div>
	          </div>

          </form>
        </div>
        <div class="col-md-2"></div>
      </div>
    </div>

</section>

</body>
</html>

<?php
	}		//Checking session ends
	else {
		header("Location: users_manage.php");
		exit();
	}
?>