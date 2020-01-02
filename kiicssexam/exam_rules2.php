<?php
  
  if (!isset($_SESSION)) {
    session_start();
  }

  include 'action/dbh.inc.php';

  if (!isset($_SESSION['can_id']) || !isset($_SESSION['can_name']) || !isset($_SESSION['can_email'])) {
    header("Location: error.php?login=required");
    exit();
  }
  $can_id = $_SESSION['can_id'];
  $can_name = $_SESSION['can_name'];
  $can_email = $_SESSION['can_email'];

  $subjects = $_SESSION['subject'];
  // echo $subjects;

  if (isset($_SESSION['exam_start'])) {
    // echo "Exam Started";
    // session_unset('exam_start');   //Do Not Use
    // echo $_SERVER['HTTP_REFERER'];
    header("Location: exam_dashboard.php");
    exit();
  }

  $fetch_subject = "SELECT * FROM subjects WHERE subjects='$subjects'";
  // echo $fetch_subject;
  $fetch_subject_query = mysqli_query($conn, $fetch_subject);
  // echo $fetch_subject;
  $fetch_subject_data = mysqli_fetch_assoc($fetch_subject_query);

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

  <script src="package/dist/sweetalert2.js"></script>
  <link rel="stylesheet" href="package/dist/sweetalert2.min.css">
  <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
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
            <div class="col-md-12" style="padding-left: 50px; padding-right: 50px;">
              <!-- <pre><?php //include('assets/text/rules.txt'); ?></pre> -->
              <h5>Instructions:-</h5>
              <?php
                // print_r($fetch_subject_data);
                $time = $fetch_subject_data['time_limit'];
                
                // echo $time;

                $sec = $time % (60);
                $totalmin = $time / (60);    //Find total number of minutes
                $hour = floor($totalmin / 60);   //Find number of hourse from total number of minutes
                $min = floor($totalmin % 60);   //Find the minutes after an hour   

                if (strlen($hour) == 1) {
                  $hour = "0".(string)$hour;
                }
                if (strlen($min) == 1) {
                  $min = "0".(string)$min;
                }
                if (strlen($sec) == 1) {
                  $sec = "0".(string)$sec;
                }
                $exam_time_limit = $hour." :hr ".$min." :min ".$sec." :sec";
              ?>
              <pre>
                Subject Name: <?php echo $fetch_subject_data['subjects_name']."<br>"; ?>
                Total Questions: <?php echo $fetch_subject_data['no_of_questions']."<br>"; ?>
                Time Limit: <?php echo $exam_time_limit."<br>"; ?>
              </pre>
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
        <form action="action/start_exam.inc.php" method="POST" id="AcceptTerms">
          <b><a class="text-center" href="exam_rules.php" style="text-decoration: none; color: lightblue;">&lt;&lt; Previous Page</a></b><br>
          <div style="display: table;">
            <input type="checkbox" name="agree" id="agree" style="display: table-cell; width: 10px;">
            <label for="agree" style="padding: 10px; display: table-cell; width: 100%;">I agree to abide by the rules and regulations of the examination.</label><br><br>
          </div>
          <button class="btn form-control btn-success" name="accept" id="accept">Accept and Continue</button>
        </form>
      </div>
      <div class="col-md-4"></div>
    </div>
  </div>
</section>

</body>
</html>

<script type="text/javascript">
  $( "#AcceptTerms" ).submit(function( event ) {
    // alert( "Handler for .submit() called." );
    if($('#agree').prop("checked") != true){
        swal('Notice','You need to accept to abide by the rules of examination','warning');
        return false;
    }
    // event.preventDefault();
  });
</script>