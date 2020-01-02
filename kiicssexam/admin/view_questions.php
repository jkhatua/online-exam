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

  if (isset($_POST['number'])) {
    $sub = $_POST['subject'];

    if (empty($sub)) {
      $_SESSION['failuremsg'] = "Select a Subjects Name";
      header("Location: subjects_manage.php?subjects=empty");
      exit();
    }

    $fetch = "SELECT * FROM subjects WHERE subjects='$sub'";
    $fetch_query = mysqli_query($conn, $fetch);
    while ($row=mysqli_fetch_assoc($fetch_query)) {
      // print_r($row);
      // $arr = array();
      $arr['subjects']= $row['subjects'];
      $arr['subjects_name']= $row['subjects_name'];
      $arr['time']= $row['time_limit'];
      $arr['no']= $row['no_of_questions'];
      // print_r($arr);
      $_SESSION['arr'] = $arr;
      header("Location: set_time_and_ques.php");
      exit();
    }
  }

  if (isset($_POST['view'])) {
      $sub_id = $_POST['subject'];

      if (empty($sub_id)) {
        $_SESSION['failuremsg'] = "Select a Subject code";
        header("Location: subjects_manage.php?subject_id=empty");
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
      /*height: 100%;*/
      /*margin-top: 80px;*/
    }
    table {
        display: block;
        height: 70%;
        font-size: 15px;
        overflow: auto;
    }
    thead, tbody tr {
        display:table;
        width:100%;
        table-layout:fixed;/* even columns width , fix width of table too*/
    }
    .qno_col {
      width: 60px;
    }
    .q_col {
      width: 300px;
    }
    .sub_id {
      width: 150px;
    }
    .sub_name {
      width: 150px;
    }
    .options {
      width: 150px;
    }
    .answer {
      width: 100px;
    }
    .marks {
      width: 80px;
    }
    .edit {
      width: 150px;
    }
    .hide_button {
      background-color: transparent;
      border: transparent;
      cursor: pointer;
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
        <h1 class="text-center">Questions</h1>
        <div class="container" style="padding-top: 40px; padding-bottom: 50px;">
          <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4"></div>
            <div class="col-md-4 text-right" style="padding: 10px;">
              <button class="btn btn-success" data-toggle="modal" data-target="#add_question">Add Question</button>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12" style=" min-height: 300px;">
              

              <?php
                include 'action/dbh.inc.php';
                // echo "<p>".$sub_id."</p>";
                $questions = "SELECT * FROM questions WHERE sub_id='$sub_id'";
                $questions_query = mysqli_query($conn, $questions);
                $num = mysqli_num_rows($questions_query);
                if ($num == 0) {
                  echo "<p class='text-center'>Questions haven't been setup for this subject.</p>";
                } else{       //Else part STARTS
              ?>
                <table class="table table-bordered table-danger table-responsive">

                      <thead class="text-center">
                        <th class="qno_col">Q.No.</th>
                        <th class="q_col">Question</th>
                        <th class="sub_id">Subject ID</th>
                        <th class="sub_name">Subject Name</th>
                        <th class='options'>OptionA</th>
                        <th class='options'>OptionB</th>
                        <th class='options'>OptionC</th>
                        <th class='options'>OptionD</th>
                        <th class='answer'>answer</th>
                        <th class="marks">mark</th>
                        <th class="edit">Edit/Delete</th>
                      </thead>
                        <?php
                        	
                            // print_r($questions);
                            $count = 1;
                            // for ($i=0; $i < 100; $i++) { 
                            	while ($questions = mysqli_fetch_assoc($questions_query)) {
                            		echo "<tr>";
                            		echo "<td class='text-center qno_col'>".$count.".</td>";
                                echo "<td  class='q_col'>".$questions['question']."</td>";
                                $sub_id = $questions['sub_id'];
                                $sub_name = $questions['subject'];
                                echo "<td  class='text-center sub_id'>".$questions['sub_id']."</td>";
                            		echo "<td  class='text-center sub_name'>".$questions['subject']."</td>";
                            		echo "<td class='text-center options'>".$questions['optionA']."</td>";
                            		echo "<td class='text-center options'>".$questions['optionB']."</td>";
                            		echo "<td class='text-center options'>".$questions['optionC']."</td>";
                                echo "<td class='text-center options'>".$questions['optionD']."</td>";
                                echo "<td class='text-center answer'>".$questions['answer']."</td>";
                                echo "<td class='text-center marks'>".$questions['marks']."</td>";
                            		?>
                                  <td class="text-center edit">
                                    <form action="action/questions_edit_options.inc.php" method="POST">
                                      <input type="hidden" name="question" value="<?php echo $questions['id']; ?>">
                                      <button name="edit_question" class="hide_button"><i class="fa">&#xf044;</i></button>
                                      /
                                      <button name="delete_question" class="hide_button" onClick="return confirm('are you sure you want to delete??');"><i class="fa">&#xf014;</i></button>
                                    </form>
                                  </td>
                                <?php
                                $count++;
                            		echo "</tr>";
                            	}
                            // }
                        ?>
                </table>
              <?php
                }       //Else part ENDS
                // session_unset($questions);
              ?>
            </div>
          </div>
        </div>    
      </div>
    </div>
    
  </div>
</section>

</body>
</html>

<?php
  }     //isset for view button ENDS



  if (isset($_POST['view_sub'])) {
      $sub_id = $_POST['subject'];

      if (empty($sub_id)) {
        $_SESSION['failuremsg'] = "Select a Subjects Name";
        header("Location: subjects_manage.php?subjects=empty");
        exit();
      }
      // echo $sub_id;

      // $sub_code_fetch_query = mysqli_query($conn, "SELECT subjects FROM subjects");
      // $fetch_sub_code = mysqli_fetch_assoc($sub_code_fetch_query);
      // $sub_name = $fetch_sub_code['subjects'];
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
      /*height: 100%;*/
      /*margin-top: 80px;*/
    }
    table {
        display: block;
        height: 70%;
        font-size: 15px;
        overflow: auto;
    }
    thead, tbody tr {
        display:table;
        width:100%;
        table-layout:fixed;/* even columns width , fix width of table too*/
    }
    td {
      word-wrap: break-word;
      padding: 10px;
    }
    .qno_col {
      width: 60px;
    }
    .q_col {
      width: 300px;
    }
    .sub_id {
      width: 150px;
    }
    .sub_name {
      width: 150px;
    }
    .options {
      width: 150px;
    }
    .answer {
      width: 100px;
    }
    .marks {
      width: 80px;
    }
    .edit {
      width: 150px;
    }
    .hide_button {
      background-color: transparent;
      border: transparent;
      cursor: pointer;
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
        <h1 class="text-center">Questions</h1>
        <div class="container" style="padding-top: 40px; padding-bottom: 50px;">
          <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4"></div>
            <div class="col-md-4 text-right" style="padding: 10px;">
              <button class="btn btn-success" data-toggle="modal" data-target="#add_question">Add Question</button>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12" style=" min-height: 300px;">
              

              <?php
                include 'action/dbh.inc.php';
                // echo "<p>".$sub_id."</p>";
                $questions = "SELECT * FROM questions WHERE subject='$sub_id'";
                // echo $questions;
                $questions_query = mysqli_query($conn, $questions);
                $num = mysqli_num_rows($questions_query);
                if ($num == 0) {
                  echo "<p class='text-center'>Questions haven't been setup for this subject.</p>";
                } else{       //Else part STARTS
              ?>
                <table class="table table-bordered table-danger table-responsive">

                      <thead class="text-center">
                        <th class="qno_col">Q.No.</th>
                        <th class="q_col">Question</th>
                        <th class="sub_id">Subject ID</th>
                        <th class="sub_name">Subject Name</th>
                        <th class='options'>OptionA</th>
                        <th class='options'>OptionB</th>
                        <th class='options'>OptionC</th>
                        <th class='options'>OptionD</th>
                        <th class='answer'>answer</th>
                        <th class="marks">mark</th>
                        <th class="edit">Edit/Delete</th>
                      </thead>
                        <?php
                          
                            // print_r($questions);
                            $count = 1;
                            // for ($i=0; $i < 100; $i++) { 
                              while ($questions = mysqli_fetch_assoc($questions_query)) {
                                echo "<tr>";
                                echo "<td class='text-center qno_col'>".$count.".</td>";
                                echo "<td  class='q_col'>".$questions['question']."</td>";
                                echo "<td  class='text-center sub_id'>".$questions['sub_id']."</td>";
                                echo "<td  class='text-center sub_name'>".$questions['subject']."</td>";
                                $sub_name = $questions['subject'];
                                $sub_id = $questions['sub_id'];
                                echo "<td class='text-center options'>".$questions['optionA']."</td>";
                                echo "<td class='text-center options'>".$questions['optionB']."</td>";
                                echo "<td class='text-center options'>".$questions['optionC']."</td>";
                                echo "<td class='text-center options'>".$questions['optionD']."</td>";
                                echo "<td class='text-center answer'>".$questions['answer']."</td>";
                                echo "<td class='text-center marks'>".$questions['marks']."</td>";
                                ?>
                                  <td class="text-center edit">
                                    <form action="action/questions_edit_options.inc.php" method="POST">
                                      <input type="hidden" name="question" value="<?php echo $questions['id']; ?>">
                                      <button name="edit_question" class="hide_button"><i class="fa">&#xf044;</i></button>
                                      /
                                      <button name="delete_question" class="hide_button" onClick="return confirm('are you sure you want to delete??');"><i class="fa">&#xf014;</i></button>
                                    </form>
                                  </td>
                                <?php
                                $count++;
                                echo "</tr>";
                              }
                            // }
                        ?>
                </table>
              <?php
                }       //Else part ENDS
                // session_unset($questions);
              ?>
            </div>
          </div>
        </div>    
      </div>
    </div>
    
  </div>
</section>

</body>
</html>

<?php
  }       //isset for 

  // $fetch_subject_details = mysqli_query($conn, "SELECT * FROM subjects");
  // $fetch_user_data = mysqli_fetch_assoc($fetch_user_details);
?>


<!-- The Modal -->
  <div class="modal" id="add_question">
    <div class="modal-dialog modal-lg"  role="document">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <!-- <div class="modal-header">
          <h4 class="modal-title">Modal Heading</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div> -->
        
        <!-- Modal body -->
        <div class="modal-body">
          <h3 class="text-center">Add Questions</h3>
          <!-- <br> -->
          <div class="container">
            <div class="row">
              <div class="col-md-12 text-center">
                <!-- <form method="POST" id="AddQuestion"> -->
                <form action="action/add_question.inc.php" method="POST" id="AddQuestion">
                  <div class="container">
                    
                    <div class="row">
                      <div class="col-md-12 form-inline" style="display: table;">
                        <label class="form-control" for="question" style=" display: table-cell; width: 150px;"><b>Question</b></label>
                        <textarea class="form-control" type="text" name="question" id="question" placeholder="Enter the question" style="display: table-cell; width: 100%;"></textarea>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12 form-inline" style="display: table;">
                        <label class="form-control" for="sub_id" style=" display: table-cell; width: 150px;"><b>SubjectID</b></label>
                        <select class="form-control" name="sub_id" id="sub_id" style="display: table-cell; width: 100%;">
                          <option value="">--Select a SubjectID--</option>
                          <?php
                            $fetch_user_details = mysqli_query($conn, "SELECT * FROM administration");
                            while ($fetch_user_data = mysqli_fetch_assoc($fetch_user_details)) {
                              ?>
                                <option value="<?php echo $fetch_user_data['sub_id'] ?>"><?php echo $fetch_user_data['sub_id']; ?></option>
                              <?php
                            }
                          ?>
                        </select>
                        <!-- <input class="form-control" type="text" name="sub_id" id="sub_id" placeholder="Enter the SubjectID" style="display: table-cell; width: 100%;">       -->
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12 form-inline" style="display: table;">
                        <label class="form-control" for="sub_name" style=" display: table-cell; width: 150px;"><b>Subject Name</b></label>
                        <select class="form-control" name="sub_name" id="sub_name" style="display: table-cell; width: 100%;">
                          <option value="">--Select a Subject--</option>
                          <?php
                            $fetch_user_details = mysqli_query($conn, "SELECT * FROM administration");
                            while ($fetch_user_data = mysqli_fetch_assoc($fetch_user_details)) {
                              ?>
                                <option value="<?php echo $fetch_user_data['admin_type'] ?>"><?php echo $fetch_user_data['admin_type']; ?></option>
                              <?php
                            }
                          ?>
                        </select>
                        <!-- <input class="form-control" type="text" name="sub_name" id="sub_name" placeholder="Enter Subject Name" style="display: table-cell; width: 100%;">       -->
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12 form-inline" style="display: table;">
                        <label class="form-control" for="optionA" style=" display: table-cell; width: 150px;"><b>OptionA</b></label>
                        <input class="form-control" type="text" name="optionA" id="optionA" placeholder="Enter OptionA" style="display: table-cell; width: 100%;">      
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-md-12 form-inline" style="display: table;">
                        <label class="form-control" for="optionB" style=" display: table-cell; width: 150px;"><b>OptionB</b></label>
                        <input class="form-control" type="text" name="optionB" id="optionB" placeholder="Enter OptionB" style="display: table-cell; width: 100%;">      
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-md-12 form-inline" style="display: table;">
                        <label class="form-control" for="optionC" style=" display: table-cell; width: 150px;"><b>OptionC</b></label>
                        <input class="form-control" type="text" name="optionC" id="OptionC" placeholder="Enter OptionC" style="display: table-cell; width: 100%;">      
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-md-12 form-inline" style="display: table;">
                        <label class="form-control" for="optionD" style=" display: table-cell; width: 150px;"><b>OptionD</b></label>
                        <input class="form-control" type="text" name="optionD" id="OptionD" placeholder="Enter OptionD" style="display: table-cell; width: 100%;">      
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-md-12 form-inline" style="display: table;">
                        <label class="form-control" for="answer" style=" display: table-cell; width: 150px;"><b>Answer</b></label>
                        <select class="form-control" name="answer" id="answer" style="display: table-cell; width: 100%;">
                          <option value="A">OptionA</option>
                          <option value="B">OptionB</option>
                          <option value="C">OptionC</option>
                          <option value="D">OptionD</option>
                        </select>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12 form-inline" style="display: table;">
                        <label class="form-control" for="marks" style=" display: table-cell; width: 150px;"><b>Marks</b></label>
                        <input class="form-control" type="number" min="0" max="5" name="marks" id="marks" placeholder="Set marks for the question" style="display: table-cell; width: 100%;">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4 form-inline" style="display: table;">
                      <button class="btn btn-success" name="add_question_button" id="add_question_button" style="display: table-cell; width: 85%;">Add Questions</button>
                    </div>
                  </div>

                </form>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Modal footer -->
        <!-- <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div> -->
        
      </div>
    </div>
  </div>


<script type="text/javascript">
  
  $(document).ready(function () {
      $("#add_question_button").click(function (e) {
        // e.preventDefault();
         // $("#edit_student_id").val(kbcdjskb); 
         var question = $('#question').val();
          var sub_id = $('#sub_id').val();
          var sub_name = $('#sub_name').val();
          var optionA = $('#optionA').val();
          var optionB = $('#optionB').val();
          var optionC = $('#optionC').val();
          var optionD = $('#optionD').val();
          var answer = $('#answer').val();
          var marks = $('#marks').val();
          
          if (question == "" || question == false) {
            swal("Question Empty",'Enter the question to proceed','error');
            return false;
          } else if ( sub_id == "" || sub_id == false) {
            swal("SubjectID Empty",'Enter the SubjectID to proceed','error');
            return false;
          } else if (sub_name == "" || sub_name == false) {
            swal("Subject Name Empty",'Enter the Subject Name to proceed','error');
            return false;
          } else if (optionA == "" || optionA == false) {
            swal("OptionA Empty",'Enter optionA to proceed','error');
            return false;
          } else if (optionB == "" || optionB == false) {
            swal("OptionB Empty",'Enter optionB to proceed','error');
            return false;
          } else if (optionC == "" || optionC == false) {
            swal("OptionC Empty",'Enter optionC to proceed','error');
            return false;
          } else if (optionD == "" || optionD == false) {
            swal("OptionD Empty",'Enter optionD to proceed','error');
            return false;
          } else if (answer == "" || answer == false) {
            swal("Answer Empty",'Enter the Answer name to proceed','error');
            return false;
          } else if (marks == "" || marks == false) {
            swal("Marks Empty",'Enter the marks to proceed','error');
            return false;
          } 
          // else {
            
          //   var formdata = {
          //     'add_user_name' : add_user_name,
          //     'add_user_id' : add_user_id,
          //     'add_user_email' : add_user_email,
          //     'add_user_password' : add_user_password,
          //     'add_user_subject' : add_user_subject,
          //     'add_user_subject_code' : add_user_subject_code,
          //     'add_user_subject_id' : add_user_subject_id
          //   };
          //   $.ajax({
          //        url: "action/add_users.inc.php",
          //        method: 'post',
          //        data: formdata,
          //        success: function (data) {
          //            console.log(data);
          //            if (!data.success == true) {
          //                swal("Failed",'Faild to enter the user data','error');
          //                // document.getElementById("AddUsers").reset();
          //            } else {
          //                swal("Success",'Successfully Entered User data','success');
          //                // document.getElementById("AddUsers").reset();
          //                // setTimeout(function () {
          //                //     window.location = data.page;
          //                // }, 1000);
          //            }
          //        },
          //        error: function (data) {
          //            console.log(data);
          //        }
          //    });

          // }

      });
  });

</script>