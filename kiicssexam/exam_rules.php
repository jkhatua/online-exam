<?php
  
  if (!isset($_SESSION)) {
    session_start();
  }

  if (!isset($_SESSION['can_id']) || !isset($_SESSION['can_name']) || !isset($_SESSION['can_email'])) {
    header("Location: error.php?login=required");
    exit();
  }
  $can_id = $_SESSION['can_id'];
  $can_name = $_SESSION['can_name'];
  $can_email = $_SESSION['can_email'];

  if (isset($_SESSION['exam_start'])) {
    // echo "Exam Started";
    // session_unset('exam_start');   //Do Not Use
    // echo $_SERVER['HTTP_REFERER'];
    header("Location: exam_dashboard.php");
    exit();
  }

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

  <!-- <script type="text/javascript" src="assets/js/loginValidation.js"></script> -->

  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <!-- <script src="sweetalert2/dist/sweetalert2.all.min.js"></script> -->

  <link href="https://fonts.googleapis.com/css?family=Shrikhand" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Baloo+Bhai" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>

<section>
  <div class="container" style="background-color: rgba(20,20,255, 0.1); margin-top: 20px; margin-bottom: 20px; border-radius: 15px 5px 15px 5px; box-shadow: 10px 5px rgba(0,0,0,0.2); border: 2px solid rgba(0,0,0,0.1); padding: 10px;">
    <div class="row" style="padding-top: 10px;">
      <div class="col-md-12">
        <h2 class="text-center" style="font-family: 'Shrikhand', cursive; font-size: 48px; color: white; text-shadow: 3px 2px rgba(0,0,0,0.7); -webkit-text-stroke: 2.5px black;">Exam Rules</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <p class="text-center" style="color: lightgray; font-size: 18px; font-weight: bold;">Read the instructions below carefully before proceeding to the exam:-</p>
        <hr>
      </div>
    </div>
    <div class="row">
    	<div class="col-md-12">
        <div class="container" style="height: 350px; background-color: rgb(250,250,250); border: 2px solid gray; border-radius: 15px; overflow-x: auto; color: black;">
          <div class="row">
            <div class="col-md-12" style="padding-left: 50px; padding-right: 50px; padding-top: 20; padding-bottom: 20px;">
              <!-- <h5 style="font-size: 18px;">Below are some symbols for </h5> -->
              <div style="padding: 2px;">
                <button class="text-center btn" style="height: 40px; width: 40px; border-radius: 50%; border: 1px solid white; background-color: rgb(200,200,200);">1</button> This indicates that you haven't visited this question.
              </div>
              <div style="padding: 2px;">
                <button class="text-center btn" style="height: 40px; width: 40px; border-radius: 50%; background-color: yellow; border: 1px solid white;">1</button> This indicates that you have visited this question but not attempted it.
              </div>
              <div style="padding: 2px;">
                <button class="text-center btn" style="height: 40px; width: 40px; border-radius: 50%; background-color: orange; border: 1px solid white;">1</button> This indicates that you have visited this question and skipped it.
              </div>
              <div style="padding: 2px;">
                <button class="text-center btn" style="height: 40px; width: 40px; border-radius: 50%; background-color: lime; border: 1px solid white;">1</button> This indicates that you have visited this question and attempted it.
              </div>
              <div style="padding: 2px;">
                <button class="text-center btn" style="height: 40px; width: 40px; border-radius: 50%; background-color: skyblue; border: 1px solid white;">1</button> This indicates that you have visited this question and have not attempted it and kept it to be verified.
              </div>
              <div style="padding: 2px;">
                <button class="text-center btn" name="num" style="height: 40px; width: 40px; border-radius: 50%; background-color: skyblue; border: 1px solid white;"><span style="color: lightgreen; text-shadow: 1px 1px black; -webkit-text-stroke: 1px black; text-stroke: 1px black; font-size: 20px; position: absolute; z-index: 1; line-height: 2px; padding-left: 10px;"><b>&#10004;</b></span>1</button> This indicates that you have visited this question and have attempted it and kept it to be verified.
              </div>
            </div>
          </div>
        </div> 
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <hr>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-4 text-center">
        <!-- <form action="action/start_exam.inc.php" method="POST">
          <button class="btn form-control btn-success" name="accept" id="accept">Accept and Continue</button>
        </form> -->
        <b><a class="text-center" href="exam_rules2.php" style="text-decoration: none; color: lightblue;">Next Page &gt;&gt;</a></b>
      </div>
      <div class="col-md-4"></div>
    </div>
  </div>
</section>

</body>
</html>