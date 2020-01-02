<?php

  if (!isset($_SESSION)) {
    session_start();
  }

  $user = $_SESSION['user'];
  if (!isset($user)) {
    header("Location: error_login.php?session=absent");
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
      height: 100%;
      /*margin-top: 80px;*/
    }
    .hide_button {
      background-color: transparent;
      border: transparent;
      cursor: pointer;
    }
  </style>

</head>
<body>

<?php
  include 'layouts/topbar.php';
  include 'layouts/sidebar.php';
  $arr = $_SESSION['arr'];
?>

<section class="main-page">
  <div class="container" style="padding: 10px;">

    <div class="row">
      <div class="col-md-12">
        <h1 class="text-center">Edit Subjects</h1>
      </div>
    </div>

    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <?php
          if (isset($_SESSION['successmsg'])) {
            ?>
            <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Success!</strong> <?php echo $_SESSION['successmsg']; ?>. 
            </div>
            <?php
            unset($_SESSION['successmsg']);
          } elseif (isset($_SESSION['failuremsg'])) {
            ?>
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Failed!</strong> <?php echo $_SESSION['failuremsg']; ?>. 
            </div>
            <?php
            unset($_SESSION['failuremsg']);
          }
        ?>
      </div>
      <div class="col-md-3"></div>
    </div>

    <div class="row" style="padding-top:40px;">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <form action="action/settime.inc.php" method="POST">
          <?php 
            // echo $arr['time'];
            $time = $arr['time'];
            // echo $time;
            // $hours = floor($time / 3600);
            // $mins = floor($time / 60 % 60);
            // $secs = floor($time % 60);
            // $time = gmdate("H:i:s", $time);
            $hours = gmdate("H", $time);
            $mins = gmdate("i", $time);
            $secs = gmdate("s", $time);
            // echo $hours;
            // echo $mins;
            // echo $secs;
          ?>
          <div class="form-inline" style="display: table; width: 100%;">
            <label class="form-control" style="display: table-cell; width: 150px;"><b>Subject Name</b></label>
            <input class="form-control" type="text" name="subjects" value="<?php echo $arr['subjects_name']; ?>" style="display: table-cell; width: 100%;" readonly>
            <input type="hidden" name="sub" value="<?php echo $arr['subjects']; ?>">
          </div>
          <div class="form-inline" style="display: table; width: 100%;">
            <label for="no" class="form-control" style="display: table-cell; width: 150px;"><b>No of Questions</b></label>
            <input class="form-control" type="number" name="no" value="<?php echo $arr['no']; ?>" style="display: table-cell; width: 100%;">
          </div>
          <?php //print_r($arr); ?>
          <div class="form-inline" style="display: table;">
            <div class="input-group">
              <label class="form-control" style="width: 120px;"><b>Time</b></label>
              <input class="form-control" type="number" name="hours" min="00" max="03" step="1" value="<?php echo $hours; ?>">
              <div class="input-group-append">
                <span class="input-group-text">hours</span>
              </div>
              <input class="form-control" type="number" name="mins" min="00" max="59" step="1" value="<?php echo $mins; ?>">
              <div class="input-group-append">
                <span class="input-group-text">mins</span>
              </div>
              <input class="form-control" type="number" name="secs" min="00" max="59" step="1" value="<?php echo $secs; ?>">
              <div class="input-group-append">
                <span class="input-group-text">secs</span>
              </div>
              <!-- <input class="form-control" type="number" name="subjects" value="<?php //echo $secs; ?>" style="display: table-cell; width: 33.33%;"> -->
            </div>
          </div>
          
          <!-- <div class="form-inline text-right"> -->
            <button class="btn btn-success" name="set">Submit</button>
          <!-- </div> -->
        </form>
      </div>
      <div class="col-md-3"></div>
    </div>

    <div class="row">
      <div class="col-md-12 text-center">
        <!-- <p><b>Note:</b> Set the time limit as </p> -->
      </div>
    </div>
    
  </div>
</section>

</body>
</html>