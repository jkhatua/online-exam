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
?>

<section class="main-page">
  <div class="container">

    <div class="row">
      <div class="col-md-12">
        <h1 class="text-center">Subjects</h1>
        <div class="container" style=" padding-bottom: 50px;">
          
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
            <div class="col-md-3"></div>
          </div>

          <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6 text-right">
              <p><b>Note:</b><i> You could check the subject code for any user in the users part.</i></p>
            </div>
            <!-- <div class="col-md-3"></div> -->
          </div>

          <!-- <div class="row">
            <div class="col-md-12" style=" min-height: 100px;">
              <table class="table table-bordered table-danger text-center">
                <thead>
                  <th>S.No.</th>
                  <th>Name</th>
                  <th>Subject</th>
                  <th>Subject ID</th>
                  <th>Edit</th>
                </thead> -->
              <?php
                include 'action/dbh.inc.php';

                $count = 1;
                $fetch = "SELECT * FROM administration";
                $fetch_query = mysqli_query($conn, $fetch);
                while ($row = mysqli_fetch_assoc($fetch_query)) {
                  // if ($row['admin_type'] != "admin") {
                  //   echo "<tr>";
                  //   echo "<td>".$count.".</td>";
                  //   echo "<td>".$row['admin_name']."</td>";
                  //   //echo "<td>".$row['admin_email']."</td>";
                  //   echo "<td>".$row['admin_type']."</td>";
                  //   echo "<td>".$row['sub_id']."</td>";
                  //   echo '<td class="text-center edit">
                  //                   <form action="action/subjects_edit_options.inc.php" method="POST">
                  //                     <input type="hidden" name="sub_id" value="'.$row['sub_id'].'">
                  //                     <button name="edit_subjects" class="hide_button"><i class="fa">&#xf044;</i></button>
                  //                   </form>
                  //                 </td>';
                  //   $count++;
                  //   echo "</tr>";
                  // }
                }
              ?>
              <!-- </table>
            </div>
          </div> -->

          <div class="row">

            <div class="col-md-6">
              <div style="border: 2px solid gray; border-radius: 15px; padding: 20px;">
                <p class="text-center" style="padding-left: 30px; padding-right: 30px;">To view questions according to <b>Subjects</b>,<br>Select the subject name and click on "View Questions".</p>
                
                <div class="container">
                  <div class="row">
                    <!-- <div class="col-md-1"></div> -->
                    <div class="col-md-12">
                      <form class="text-center" action="view_questions.php" method="POST">
                        <div class="form-group">
                          <select class="form-control" name="subject" id="subject" style="text-align-last:center;">
                            <option value="">--Select a Subject Name--</option>
                            <?php
                              $fetch1 = "SELECT * FROM subjects";
                              $fetch_query1 = mysqli_query($conn, $fetch1);    
                              while ($row1 = mysqli_fetch_assoc($fetch_query1)) {
                                echo "<option value=".$row1['subjects'].">".$row1['subjects_name']."</option>";
                              }
                            ?>
                          </select>
                        </div>
                        <button class="btn btn-success" name="view_sub" style="color: white;"><i>View Questions</i></button>
                      </form>
                    </div>
                    <!-- <div class="col-md-1"></div> -->
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div style="border: 2px solid gray; border-radius: 15px; padding: 20px;">
                <p class="text-center" style="padding-left: 30px; padding-right: 30px;">To view questions according to <b>subject id</b>,<br>Select the subject id and click on "View Questions".</p>
                <?php
                  
                ?>
                <div class="container">
                  <div class="row">
                    <!-- <div class="col-md-4"></div> -->
                    <div class="col-md-12">
                      <form class="text-center" action="view_questions.php" method="POST">
                        <div class="form-group" style="display: table; width: 100%;">
                          <label class="form-control" for="subject" style="display: table-cell; width: 50%;">Subject Code</label>
                          <select class="form-control" name="subject" id="subject" style="display: table-cell;">
                            <option value="">--Select Subject Code--</option>
                            <?php
                              $fetch1 = "SELECT * FROM administration";
                              $fetch_query1 = mysqli_query($conn, $fetch1);    
                              while ($row2 = mysqli_fetch_assoc($fetch_query1)) {
                                if ($row2['admin_type'] != 'admin') {
                                  echo "<option value=".$row2['sub_id'].">".$row2['sub_id']."</option>";
                                }
                              }
                            ?>
                          </select>
                        </div>
                        <button class="btn btn-success" name="view" style="color: white;"><i>View Questions</i></button>
                      </form>
                    </div>
                    <!-- <div class="col-md-4"></div> -->
                  </div>
                </div>
              </div>
            </div>

          </div>

          <div class="row" style="padding-top: 5px;">
            <div class="col-md-6">
              <div style="border: 2px solid gray; border-radius: 15px; padding: 20px;">
                <p class="text-center" style="padding-left: 30px; padding-right: 30px;">Set number of questions and time to be given to any student for exam on any subject.</p>
                
                <div class="container">
                  <div class="row">
                    <!-- <div class="col-md-1"></div> -->
                    <div class="col-md-12">
                      <form class="text-center" action="view_questions.php" method="POST">
                        <div class="form-group">
                          <select class="form-control" name="subject" id="subject" style="text-align-last:center;">
                            <option value="">--Select Subject Name--</option>
                            <?php
                              $fetch1 = "SELECT * FROM subjects";
                              $fetch_query1 = mysqli_query($conn, $fetch1);    
                              while ($row1 = mysqli_fetch_assoc($fetch_query1)) {
                                echo "<option value=".$row1['subjects'].">".$row1['subjects_name']."</option>";
                              }
                            ?>
                          </select>
                        </div>
                        <button class="btn btn-success" name="number" style="color: white;"><i>Set Time and no. of Questions</i></button>
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
    
  </div>
</section>

</body>
</html>