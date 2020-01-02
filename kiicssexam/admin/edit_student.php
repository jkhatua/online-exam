<?php

?>
<?php
  
  if (!isset($_SESSION)) {
    session_start();
  }

  $user = $_SESSION['user'];
  if (!isset($user)) {
    header("Location: error_login.php?session=absent");
    exit();
  }

  include 'action/dbh.inc.php';

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

  if (isset($_POST['delete_student'])) {
	$can_id = $_POST['can_id'];
	$delete = "DELETE FROM candidate_details WHERE can_id='$can_id'";

	if ($delete_query = mysqli_query($conn, $delete)) {
		$fetch_results = "SELECT * FROM results WHERE can_id='$can_id'";
		$fetch_results_query = mysqli_query($conn, $fetch_results);
		$num = mysqli_num_rows($fetch_results_query);
		if ($num > 0) {
		 	// DELETE all the results records along with user details
		 	$delete_candidate = "DELETE FROM results WHERE can_id='$can_id'";
		 	$delete_candidate_query = mysqli_query($conn, $delete_candidate);
		 } 
		 $fetch_answers = "SELECT * FROM answers WHERE can_id='$can_id'";
		 $fetch_answers_query = mysqli_query($conn, $fetch_answers);
		 $num1 = mysqli_num_rows($fetch_answers_query);
		 if ($num1 > 0) {
		 	// DELETE all the results records along with user details
		 	$delete_answers = "DELETE FROM answers WHERE can_id='$can_id'";
		 	$delete_answers_query = mysqli_query($conn, $delete_answers);
		 } 
		$_SESSION['successmsg'] = "Deleted Student details successfully";
		header("Location: students_manage.php?delete=success");
		exit();
	} else {
		$_SESSION['failuremsg'] = "Failed to delete Student details";
		header("Location: students_manage.php?delete=failed");
		exit();
	}
  }
  else if (isset($_POST['edit_students'])) {		//isset starts
  	
  	include 'layouts/topbar.php';
  	include 'layouts/sidebar.php';

  	$can_id = $_POST['can_id'];
  	$fetch = "SELECT * FROM candidate_details WHERE can_id='$can_id'";
  	$fetch_data = mysqli_query($conn, $fetch);

  	while ($row = mysqli_fetch_assoc($fetch_data)) {
?>

<section class="main-page">

    <div class="container" style="padding-top: 20px;">
    	<div class="row">
    		<div class="col-md-12">
    			<h1 class="text-center">Edit Student Details</h1>
    		</div>
    	</div>
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <form action="action/edit_student.inc.php" method="POST" class="form-group">
            
	          <!-- <br> -->
	          <div class="container">
	            <div class="row">
	              <div class="col-md-12 text-center">
	                <form action="action/add_student.inc.php" method="POST">
	                  <div class="container">
	                    
	                    <div class="row">
	                      <div class="col-md-12 form-inline" style="display: table;">
	                      	<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
	                        <label class="form-control" for="edit_student_id" style=" display: table-cell; width: 150px;"><b>Student ID</b></label>
	                        <input class="form-control" type="text" name="edit_student_id" value="<?php echo $row['can_id'] ?>" placeholder="Enter Student ID" style="display: table-cell; width: 100%;">      
	                      </div>
	                    </div>
	                    <div class="row">
	                      <div class="col-md-12 form-inline" style="display: table;">
	                        <label class="form-control" for="edit_student_name" style=" display: table-cell; width: 150px;"><b>Student Name</b></label>
	                        <input class="form-control" type="text" name="edit_student_name" value="<?php echo $row['can_name'] ?>" placeholder="Enter Student Name" style="display: table-cell; width: 100%;">      
	                      </div>
	                    </div>

	                    <div class="row">
	                      <div class="col-md-12 form-inline" style="display: table;">
	                        <label class="form-control" for="edit_student_status" style=" display: table-cell; width: 150px;"><b>Student Status</b></label>
	                        <select class="form-control" name="edit_student_status" style="display: table-cell; width: 100%;">
	                        	<!-- <option></option> -->
	                        	<option <?php if ($row['status'] == "Not Appeared") { echo "selected"; } ?> value="Not Appeared">Not Appeared</option>
	                        	<option <?php if ($row['status'] == "appeared") { echo "selected"; } ?> value="appeared">Appeared</option>
	                        </select>
	                        <!-- <input class="form-control" type="text" name="edit_student_status" value="<?php //echo $row['status'] ?>" placeholder="Enter Student Name" style="display: table-cell; width: 100%;">       -->
	                      </div>
	                    </div>
	                    
	                    <div class="row">
	                      <div class="col-md-12 form-inline" style="display: table;">
	                        <label class="form-control" for="edit_student_email" style=" display: table-cell; width: 150px;"><b>Email</b></label>
	                        <input class="form-control" type="text" name="edit_student_email" value="<?php echo $row['can_email'] ?>" placeholder="Enter Student Email" style="display: table-cell; width: 100%;">      
	                      </div>
	                    </div>
	                    
	                    <div class="row">
	                      <div class="col-md-12 form-inline" style="display: table;">
	                        <label class="form-control" for="edit_student_password" style=" display: table-cell; width: 150px;"><b>Password</b></label>
	                        <input class="form-control" type="text" name="edit_student_password" value="<?php echo $row['can_password'] ?>" placeholder="Set Student Password" style="display: table-cell; width: 100%;">      
	                      </div>
	                    </div>
	                    
	                    <div class="row">
	                      <div class="col-md-12 form-inline" style="display: table;">
	                        <label class="form-control" for="edit_student_contact" style=" display: table-cell; width: 150px;"><b>Contact No.</b></label>
	                        <input class="form-control" type="text" name="edit_student_contact" value="<?php echo $row['can_contact'] ?>" placeholder="Enter Student Contact Number" style="display: table-cell; width: 100%;">      
	                      </div>
	                    </div>
	                    
	                    <div class="row">
	                      <div class="col-md-12 form-inline" style="display: table;">
	                      	<?php
	                      		$array = array("Male","Female");
	                      	?>
	                        <label class="form-control" for="edit_gender" style=" display: table-cell; width: 150px;"><b>Gender</b></label>
	                        <select class="form-control" name="edit_gender" style="display: table-cell; width: 100%;">
	                          <option value="Male" <?php if ($array[0] == $row["can_gender"]) { echo "selected"; } ?> >Male</option>
	                          <option value="Female" <?php if ($array[1] == $row["can_gender"]) { echo "selected"; } ?> >Female</option>
	                        </select>
	                      </div>
	                    </div>
	                    
	                    <div class="row">
	                      <div class="col-md-12 form-inline" style="display: table;">
	                      	<?php
	                      		$array = array('A+','A-','B+','B-','AB+','AB-','O+','O-');
	                      		// print_r($array);
	                      	?>
	                        <label class="form-control" for="edit_student_blood_group" style=" display: table-cell; width: 150px;"><b>Blood Group</b></label>
	                        <select class="form-control" name="edit_student_blood_group" id="edit_student_blood_group" style="display: table-cell;width: 100%;">
	                          <option value="A+" <?php if ($array[0] == $row["can_blood_group"]) { echo "selected"; } ?> >A+ve</option>
	                          <option value="A-" <?php if ($array[1] == $row["can_blood_group"]) { echo "selected"; } ?> >A-ve</option>
	                          <option value="B+" <?php if ($array[2] == $row["can_blood_group"]) { echo "selected"; } ?> >B+ve</option>
	                          <option value="B-" <?php if ($array[3] == $row["can_blood_group"]) { echo "selected"; } ?> >B-ve</option>
	                          <option value="AB+" <?php if ($array[4] == $row["can_blood_group"]) { echo "selected"; } ?> >AB+ve</option>
	                          <option value="AB-" <?php if ($array[5] == $row["can_blood_group"]) { echo "selected"; } ?> >AB-ve</option>
	                          <option value="O+" <?php if ($array[6] == $row["can_blood_group"]) { echo "selected"; } ?> >O+ve</option>
	                          <option value="O-" <?php if ($array[7] == $row["can_blood_group"]) { echo "selected"; } ?> >O-ve</option>
	                        </select>
	                      </div>
	                    </div>

	                    <div class="row">
	                      <div class="col-md-12 form-inline" style="display: table;">
	                        <label class="form-control" for="edit_student_dob" style=" display: table-cell; width: 150px;"><b>Contact No.</b></label>
	                        <input class="form-control" type="date" name="edit_student_dob" value="<?php echo $row['can_DOB'] ?>"  placeholder="Enter Student Contact Number" style="display: table-cell; width: 100%;">      
	                      </div>
	                    </div>

	                    <div class="row">
	                      <div class="col-md-12 form-inline" style="display: table;">
	                        <label class="form-control" for="edit_student_address" style=" display: table-cell; width: 150px;"><b>Address</b></label>
	                        <textarea class="form-control" type="text" name="edit_student_address" value="<?php echo $row['can_address']; ?>" placeholder="Enter Student Address" style="display: table-cell; width: 100%;"><?php echo $row['can_address']; ?></textarea>
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

	                </form>
	              </div>
	            </div>
	          </div>

          </form>
        </div>
        <div class="col-md-2"></div>
      </div>
    </div>

</section>
<?php
		}	//while ends
	} //isset ends
?>

</body>
</html>