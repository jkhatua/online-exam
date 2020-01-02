<?php

  // include_once 'common/recent_activity.inc.php';

  if(!isset($_SESSION)){
      session_start();
  } 

  $sub_id = $_SESSION['sub_id'];
  
  if (!isset($sub_id)){
    echo "Session expired <a href='index.php' style='text-decoration: none;'>Click here</a> to Login.";
  } else {
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

  <script type="text/javascript" src="assets/js/RegistrationValidation.js"></script>

  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <!-- <script src="sweetalert2/dist/sweetalert2.all.min.js"></script> -->

</head>

<style type="text/css">

  form {
    font-size: 12px;
  }

  input:invalid + span:after {
      content: '✖';
      color: #f00;
      padding-left: 5px;
  }

  input:valid + span:after {
      content: '✓';
      color: #26b72b;
      padding-left: 5px;
  }

</style>

<body>
<?php
  // echo time();
?>
<section>
  <div class="container" style="background-color: rgba(20,20,255, 0.1); margin-top: 50px; border-radius: 15px 5px 15px 5px; box-shadow: 10px 5px rgba(0,0,0,0.2); border: 2px solid rgba(0,0,0,0.1)">
    
    <!-- <form action="common/exam_register.inc.php" method="POST"> -->
    <form action="#" method="POST" id="RegistrationForm">
      
      <h2 class="text-center" style="padding: 10px;">Registration</h2>
      <hr>
      
      <div class="row" style="padding: 10px;">
        <div class="col-md-4 form-inline" style="display: table;">
          <label for="name" style="display:table-cell; width: 1px">Name:</label>
          <input class="form-control" type="text" name="name" id="name" pattern="[A-Za-z\s]+" placeholder="Enter your Name" style="display:table-cell; width: 100%">
          <span style="display:table-cell; width: 1px"></span>
        </div>
        <div class="col-md-4 form-inline" style="display: table;">
          <label for="email" style="display: table-cell; width: 1px">Email:</label>
          <input class="form-control" type="email" name="email" id="email" placeholder="Enter your Email ID" style="display:table-cell; width:100%">
          <span style="display: table-cell; width: 1px;"></span>
        </div>
        <div class="col-md-4 form-inline" style="display: table;">
          <label for="contact" style="display: table-cell; width: 1px;">Contact:</label>
          <input class="form-control" type="number" name="contact" id="contact" maxlength="10" placeholder="Enter your Contact Number" style="display: table-cell; width: 100%;">
          <span style="display: table-cell; width: 1px;"></span>
        </div>
      </div>
      
      <div class="row" style="padding: 10px;">
        <div class="col-md-4 form-inline" style="display: table;">
          <label for="gender" style="display: table-cell; width: 1px;">Gender:</label>
          <select class="form-control" name="gender" id="gender" style="display: table-cell; width: 100%;">
            <option value="">--Select your Gender--</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
          </select>
        </div>
        <div class="col-md-4 form-inline" style="display: table;">
          <label for="blood_group" style="display: table-cell; width: 1px;">Blood Group:</label>
          <select class="form-control" name="blood_group" id="blood_group" style="display: table-cell; width: 100%;">
            <option value="">--Select your Blood group--</option>
            <option value="A+">A+ve</option>
            <option value="A-">A-ve</option>
            <option value="B+">B+ve</option>
            <option value="B-">B-ve</option>
            <option value="AB+">AB+ve</option>
            <option value="AB-">AB-ve</option>
            <option value="O+">O+ve</option>
            <option value="O-">O-ve</option>
          </select>
        </div>
        <div class="col-md-4 form-inline" style="display: table;">
          <label for="dob" style="display: table-cell; width: 1px;">DOB:</label>
          <?php
            $present_year = date("Y");
            $date_check = date("Y-m-d", strtotime("-18 year"));   //Date exactly 18 years ago
          ?>
          <input class="form-control" type="date" name="dob" id="dob" min="1985-01-01" max="<?php echo $date_check; ?>" placeholder="DOB" style="display: table-cell; width: 100%;">
          <span style="display: table-cell; width: 1px;"></span>
        </div>
      </div>

      <div class="row" style="padding: 10px;">
        <div class="col-md-12 form-inline" style="display: table;">
          <label for="address" style="display: table-cell; width: 1px;">Address:</label>
          <textarea class="form-control" name="address" id="address" placeholder="Address" rows="4" style="display: table-cell; width: 100%;"></textarea>
        </div>
      </div>

      <div class="row" style="padding: 10px;">
        <div class="col-md-3 form-inline" style="display: table;">
          <label for="university" style="display: table-cell; width: 1px;">University:</label>
          <input class="form-control" type="text" name="university" id="university" placeholder="University" style="display: table-cell; width: 100%;">
        </div>
        <div class="col-md-3 form-inline" style="display: table;">
          <label for="college" style="display: table-cell; width: 1px;">College:</label>
          <input class="form-control" type="text" name="college" id="college" placeholder="College" style="display: table-cell; width: 100%;">
        </div>
        <div class="col-md-3 form-inline" style="display: table;">
          <label for="cgpa" style="display: table-cell; width: 1px;">CGPA:</label>
          <input class="form-control" type="number" name="cgpa" id="cgpa" placeholder="CGPA" step="0.01" min="0" max="10" style="display: table-cell; width: 100%;">
          <span style="display: table-cell; width: 1px;"></span>
        </div>
        <div class="col-md-3 form-inline" style="display: table;">
          <label for="passout" style="display: table-cell; width: 1px;">Passout Year:</label>
          <input class="form-control" type="number" name="passout" placeholder="Passout Year" min="2000" max="<?php echo $present_year; ?>" style="display: table-cell; width: 100%">
          <span style="display: table-cell; width: 1px;"></span>
        </div>
      </div>

      <div class="row" style="padding: 10px;">
        <div class="col-md-3"></div>
        <div class="col-md-6">
          <button class="btn form-control btn-success" type="submit" name="submit" id="submit">Register</button>
        </div>
        <div class="col-md-3"></div>
      </div>

    </form>

  </div>
</section>


</body>
</html>


<?php } ?>