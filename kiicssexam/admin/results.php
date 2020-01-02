<?php

  error_reporting(0);

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

  <script src="package/dist/sweetalert2.js"></script>
  <link rel="stylesheet" href="package/dist/sweetalert2.min.css">

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
    table {
        display: block;
        max-height: 70%;
        font-size: 15px;
        overflow: auto;
    }
    thead, tbody tr {
        display:table;
        width:100%;
        table-layout:fixed;/* even columns width , fix width of table too */
    }
    table td {
      word-wrap: break-word;
    }
    .sno {
      width: 80px;
    }
    .can_name {
      width: 250px;
    }
    .can_id {
      width: 200px;
    }
    .can_email {
      width: 300px;
    }
    .can_pwd {
      width: 200px;
    }
    .sub_id {
      width: 220px;
    }
    .can_status {
      width: 180px;
    }
    .can_contact {
      width: 150px;
    }
    .can_gender {
      width: 100px;
    }
    .can_blood_group {
      width: 120px;
    }
    .can_DOB {
      width: 200px;
    }
    .can_address {
      width: 300px;
    }
    .can_result {
      width: 100px;
    }
    .edit {
      width: 140px;
    }

    .modal-lg {
        max-width: 50%;
        /*max-width: 60% !important;*/
    }

  </style>

</head>
<body>

<?php
  include 'layouts/topbar.php';
  include 'layouts/sidebar.php';
?>

<section class="main-page">
  <div class="container">

    <div class="row">
      <div class="col-md-12">
        <h1 class="text-center">Results</h1>
        <div class="container" style="padding-top: 40px; padding-bottom: 50px;">

          <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
              <?php
                if (isset($_SESSION['successmsg'])) {
                  ?>
                  <div class="alert alert-success alert-dismissible text-center">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Success!</strong><br><?php echo $_SESSION['successmsg'];?>. 
                  </div>
                  <?php
                  unset($_SESSION['successmsg']);
                } elseif (isset($_SESSION['failuremsg'])) {
                  ?>
                  <div class="alert alert-danger alert-dismissible text-center">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Failed!</strong><br><?php echo $_SESSION['failuremsg']; ?>. 
                  </div>
                  <?php
                  unset($_SESSION['failuremsg']);
                }
              ?>
            </div>
            <div class="col-md-3">
              <!-- <p><i><b>Note:</b> You must add a password minimum of 8 characters.</i></p> -->
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div style="border: 2px solid gray; border-radius: 15px; padding: 20px;">
                <p class="text-center" style="padding-left: 30px; padding-right: 30px;">To view the answers of any candidate choose their <b><i>"candidate ID"</i></b>.</p>
                
                <div class="container">
                  <div class="row">
                    <!-- <div class="col-md-1"></div> -->
                    <div class="col-md-12">
                      <form class="text-center" action="view_answers.php" method="POST">
                        <div class="form-group">
                          <select class="form-control" name="can_id" id="can_id" style="text-align-last:center;">
                            <option value="">--Select a Candidate ID--</option>
                            <?php
                              $fetch1 = "SELECT can_id FROM candidate_details";
                              $fetch_query1 = mysqli_query($conn, $fetch1);    
                              while ($row1 = mysqli_fetch_assoc($fetch_query1)) {
                                echo "<option value=".$row1['can_id'].">".$row1['can_id']."</option>";
                              }
                            ?>
                          </select>
                        </div>
                        <button class="btn btn-success" name="view_answers" style="color: white;"><i>View Answers</i></button>
                      </form>
                    </div>
                    <!-- <div class="col-md-1"></div> -->
                  </div>
                </div>
              </div>
          </div>

        </div>    
      </div>
    </div>
    
  </div>

</section>

</body>
</html>
