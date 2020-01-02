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
        <h1 class="text-center">Students</h1>
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
            <div class="col-md-12 text-center">
              <p><i><b>Note:</b> You must add a password minimum of 8 characters.</i></p>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
              <!-- <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Success!</strong> This alert box could indicate a successful or positive action.
              </div> -->
            </div>
            <div class="col-md-3 text-right" style="padding: 10px;">
              <button class="btn btn-success" data-toggle="modal" data-target="#add_student">Add Student</button>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12" style=" min-height: 300px;">
              <?php
                include 'action/dbh.inc.php';

                $count = 1;
                $fetch = "SELECT * FROM candidate_details";
                $fetch_query = mysqli_query($conn, $fetch);
                
                    ?>
                    <table class="table table-bordered table-danger text-center table-responsive">
                      <thead>
                        <th class="sno">S.No.</th>
                        <th class="can_name">Student Name</th>
                        <th class="can_id">Student ID</th>
                        <th class="can_email">Student Email</th>
                        <th class="can_pwd">Student Password</th>
                        <th class="sub_id">Subject</th>
                        <th class="can_status">Status</th>
                        <th class="can_contact">Contact No</th>
                        <th class="can_gender">Gender</th>
                        <th class="can_blood_group">Blood Group</th>
                        <th class="can_DOB">DOB</th>
                        <th class="can_address">Address</th>
                        <th class="can_result">Result</th>
                        <th class="edit">Edit/Delete</th>
                      </thead>
                      <?php
                        while ($row = mysqli_fetch_assoc($fetch_query)) {
                          if (!empty($row)) {
                              echo "<tr>";
                              echo "<td class='sno'>".$count.".</td>";
                              echo "<td class='can_name'>".$row['can_name']."</td>";
                              echo "<td class='can_id'>".$row['can_id']."</td>";
                              echo "<td class='can_email'>".$row['can_email']."</td>";
                              echo "<td class='can_pwd'>".$row['can_password']."</td>";
                              $sub = $row['subject'];
                              $fetch_sub = "SELECT * FROM subjects WHERE subjects='$sub'";
                              $fetch_sub_query = mysqli_query($conn, $fetch_sub);
                              while ($aaa = mysqli_fetch_assoc($fetch_sub_query)) {
                                echo "<td class='sub_id'>".$aaa['subjects_name']."</td>";
                              }
                              echo "<td class='can_status'>".$row['status']."</td>";
                              echo "<td class='can_contact'>".$row['can_contact']."</td>";
                              echo "<td class='can_gender'>".$row['can_gender']."</td>";
                              echo "<td class='can_blood_group'>".$row['can_blood_group']."</td>";
                              // $date = date('d-m-Y');
                              // $date = date('d-m-Y',strtotime($row['can_DOB']));
                              $date = date('jS M, Y',strtotime($row['can_DOB']));
                              // echo $date;
                              // echo "<td class='can_DOB'>".$row['can_DOB']."</td>";
                              echo "<td class='can_DOB'>".$date."</td>";
                              echo "<td class='can_address'><div style='min-height:50px;'>".$row['can_address']."</div></td>";
                              if ($row['status'] == "Not Appeared") {
                                echo "<td class='can_result'><div style='min-height:50px;'>N/A</div></td>";
                              } else {
                                $can_id = $row['can_id'];
                                $result = "SELECT * FROM results WHERE can_id='$can_id'";
                                $result_query = mysqli_query($conn, $result);
                                $result_data = mysqli_fetch_assoc($result_query);
                                $percent = ($result_data['result']/$result_data['total'])*100;
                                echo "<td class='can_result'><div style='min-height:50px;'>
                                        <form action='action/get_results.inc.php' method='POST'>
                                          <input type='hidden' name='can_id' value='".$can_id."'>
                                          <button class='btn' name='result'>".$percent."%</button>
                                        </form>
                                      </div></td>";
                              }
                              echo '<td class="text-center edit">
                                              <form action="edit_student.php" method="POST">
                                                <input type="hidden" name="can_id" value="'.$row['can_id'].'">
                                                <button name="edit_students" id="edit_students" class="hide_button"><i class="fa">&#xf044;</i></button>
                                                /
                                                <button name="delete_student" class="hide_button" onClick=\'return confirm("are you sure you want to delete??");\'><i class="fa">&#xf014;</i></button>
                                              </form>
                                            </td>';
                              $count++;
                              echo "</tr>";
                            } else {
                              echo "<p class='text-center'>No Records of the Student</p>";
                          }
                        }
                      ?>
                    </table>
            </div>
          </div>
        </div>    
      </div>
    </div>
    
  </div>

  <!-- <div class="container">
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8 text-center">
        <form action="" method="POST">
          <div class="container">
            
            <div class="row">
              <div class="col-md-12 form-inline" style="display: table;">
                <label class="form-control" for="student_id" style="background: rgb(150,150,150); color: white; display: table-cell; width: 150px;"><b>Student ID</b></label>
                <input class="form-control" type="text" name="student_id" placeholder="Enter Student ID" style="display: table-cell; width: 100%;">      
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-12 form-inline" style="display: table;">
                <label class="form-control" for="student_name" style="background: rgb(150,150,150); color: white; display: table-cell; width: 150px;"><b>Student Name</b></label>
                <input class="form-control" type="text" name="student_name" placeholder="Enter Student Name" style="display: table-cell; width: 100%;">      
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-12 form-inline" style="display: table;">
                <label class="form-control" for="student_email" style="background: rgb(150,150,150); color: white; display: table-cell; width: 150px;"><b>Email</b></label>
                <input class="form-control" type="text" name="student_email" placeholder="Enter Student Email" style="display: table-cell; width: 100%;">      
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-12 form-inline" style="display: table;">
                <label class="form-control" for="student_password" style="background: rgb(150,150,150); color: white; display: table-cell; width: 150px;"><b>Password</b></label>
                <input class="form-control" type="text" name="student_password" placeholder="Set Student Password" style="display: table-cell; width: 100%;">      
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-12 form-inline" style="display: table;">
                <label class="form-control" for="student_contact" style="background: rgb(150,150,150); color: white; display: table-cell; width: 150px;"><b>Contact No.</b></label>
                <input class="form-control" type="text" name="student_contact" placeholder="Enter Student Contact Number" style="display: table-cell; width: 100%;">      
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-12 form-inline" style="display: table;">
                <label class="form-control" for="gender" style="background: rgb(150,150,150); color: white; display: table-cell; width: 150px;"><b>Gender</b></label>
                <select class="form-control" name="gender" style="display: table-cell; width: 100%;">
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-12 form-inline" style="display: table;">
                <label class="form-control" for="student_blood_group" style="background: rgb(150,150,150); color: white; display: table-cell; width: 150px;"><b>Blood Group</b></label>
                <select class="form-control" name="student_blood_group" style="display: table-cell;width: 100%;">
                  <option value="A+">A+ve</option>
                  <option value="A-">A-ve</option>
                  <option value="B+">B+ve</option>
                  <option value="B-">B+ve</option>
                  <option value="AB+">AB+ve</option>
                  <option value="AB-">AB-ve</option>
                  <option value="O+">O+ve</option>
                  <option value="O+">O+ve</option>
                </select>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12 form-inline" style="display: table;">
                <label class="form-control" for="student_address" style="background: rgb(150,150,150); color: white; display: table-cell; width: 150px;"><b>Contact No.</b></label>
                <input class="form-control" type="text" name="student_address" placeholder="Enter Student Address" style="display: table-cell; width: 100%;">      
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4"></div>
            <div class="col-md-4 form-inline" style="display: table;">
              <button class="btn btn-success" name="add_student_button" style="display: table-cell; width: 85%;">Add Student</button>
            </div>
          </div>

        </form>
      </div>
      <div class="col-md-2"></div>
    </div>
  </div> -->


    <!-- <input type="text" name="abc" id="abc" placeholder="Enter data">
    <button id="bb">Button</button>
    <script type="text/javascript">
      $(document).ready(function() {
        $("#bb").click(function() {
          $('#abc').val("Hello");
        });
      });
    </script> -->


</section>

<!-- The Modal -->
  <div class="modal" id="add_student">
    <div class="modal-dialog modal-lg"  role="document">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <!-- <div class="modal-header">
          <h4 class="modal-title">Modal Heading</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div> -->
        
        <!-- Modal body -->
        <div class="modal-body">
          <h3 class="text-center">Add Student Details</h3>
          <!-- <br> -->
          <div class="container">
            <div class="row">
              <div class="col-md-12 text-center">
                <form action="action/add_student.inc.php" method="POST">
                <!-- <form action="action/add_student.inc.php" method="POST" id="AddStudent"> -->
                  <div class="container">
                    
                    <div class="row">
                      <div class="col-md-12 form-inline" style="display: table;">
                        <label class="form-control" for="student_id" style=" display: table-cell; width: 150px;"><b>Student ID</b></label>
                        <input class="form-control" type="text" name="student_id" id="student_id" placeholder="Set the Student ID" style="display: table-cell; width: 100%;">      
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12 form-inline" style="display: table;">
                        <label class="form-control" for="subject" style=" display: table-cell; width: 150px;"><b>Subject Name</b></label>
                        <select class="form-control" type="text" name="subject" id="subject" placeholder="Enter Subject Name" style="display: table-cell; width: 100%;">
                          <option value="">--Select a Subject--</option>
                        <?php
                            $fetch_subject =  "SELECT * FROM subjects";
                            $view_subjects = mysqli_query($conn, $fetch_subject);
                            while ($data = mysqli_fetch_assoc($view_subjects)) {
                              ?>
                                <option value="<?php echo $data['subjects']; ?>"><?php echo $data['subjects_name']; ?></option>      
                              <?php
                            }
                        ?>
                        </select>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-md-12 form-inline" style="display: table;">
                        <label class="form-control" for="student_name" style=" display: table-cell; width: 150px;"><b>Student Name</b></label>
                        <input class="form-control" type="text" name="student_name" id="student_name" placeholder="Enter Student Name" style="display: table-cell; width: 100%;">      
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-md-12 form-inline" style="display: table;">
                        <label class="form-control" for="student_email" style=" display: table-cell; width: 150px;"><b>Email</b></label>
                        <input class="form-control" type="email" name="student_email" id="student_email" placeholder="Enter Student Email" style="display: table-cell; width: 100%;">      
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-md-12 form-inline" style="display: table;">
                        <label class="form-control" for="student_password" style=" display: table-cell; width: 150px;"><b>Password</b></label>
                        <input class="form-control" type="password" name="student_password" id="student_password" placeholder="Set Student Password" style="display: table-cell; width: 100%;">      
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-md-12 form-inline" style="display: table;">
                        <label class="form-control" for="student_contact" style=" display: table-cell; width: 150px;"><b>Contact No.</b></label>
                        <input class="form-control" type="number" name="student_contact" id="student_contact" placeholder="Enter Student Contact Number" style="display: table-cell; width: 100%;">      
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-md-12 form-inline" style="display: table;">
                        <label class="form-control" for="gender" style=" display: table-cell; width: 150px;"><b>Gender</b></label>
                        <select class="form-control" name="gender" id="gender" style="display: table-cell; width: 100%;">
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                        </select>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12 form-inline" style="display: table;">
                        <?php
                          $date = time();
                          $date = date("d-m-Y", strtotime("-18 years", $date));
                          // echo $date;
                        ?>
                        <label class="form-control" for="dob" style=" display: table-cell; width: 150px;"><b>DOB</b></label>
                        <input class="form-control" type="date" name="dob" id="dob" max="<?php echo $date; ?>" style="display: table-cell; width: 100%;">
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-md-12 form-inline" style="display: table;">
                        <label class="form-control" for="student_blood_group" style=" display: table-cell; width: 150px;"><b>Blood Group</b></label>
                        <select class="form-control" name="student_blood_group" id="student_blood_group" style="display: table-cell;width: 100%;">
                          <option value="A+">A+ve</option>
                          <option value="A-">A-ve</option>
                          <option value="B+">B+ve</option>
                          <option value="B-">B-ve</option>
                          <option value="AB+">AB+ve</option>
                          <option value="AB-">AB-ve</option>
                          <option value="O+">O+ve</option>
                          <option value="O+">O-ve</option>
                        </select>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12 form-inline" style="display: table;">
                        <label class="form-control" for="student_address" style=" display: table-cell; width: 150px;"><b>Address</b></label>
                        <textarea class="form-control" type="text" name="student_address" id="student_address" placeholder="Enter Student Address" style="display: table-cell; width: 100%;"></textarea>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4 form-inline" style="display: table;">
                      <button class="btn btn-success" name="add_student_button" id="add_student_button" style="display: table-cell; width: 85%;">Add Student</button>
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

</body>
</html>

<script type="text/javascript">
  
  $(document).ready(function () {
      $("#add_student_button").click(function (e) {
        // e.preventDefault();
         // $("#edit_student_id").val(kbcdjskb); 
         var student_id = $('#student_id').val();
          var subject = $('#subject').val();
          var student_name = $('#student_name').val();
          var student_email = $('#student_email').val();
          var student_password = $('#student_password').val();
          var student_contact = $('#student_contact').val();
          var gender = $('#gender').val();
          var dob = $('#dob').val();
          var student_blood_group = $('#student_blood_group').val();
          var student_address = $('#student_address').val();

          var letters = /^[a-zA-Z]+$/;
          var numbers = /^[0-9]+$/;
          var alphanum = /^[a-zA-Z0-9]+$/;

          if (student_id == "" || student_id == false) {
            swal("StudentID Empty",'Enter the StudentID to proceed','error');
            return false;
          } else if ( subject == "" || subject == false) {
            swal("Subject Empty",'Enter the Subject to proceed','error');
            return false;
          } else if (student_name == "" || student_name == false) {
            swal("Students Name Empty",'Enter the Students Name to proceed','error');
            return false;
          } else if (student_email == "" || student_email == false) {
            swal("Email Empty",'Enter students email to proceed','error');
            return false;
          } else if (student_password == "" || student_password == false) {
            swal("Password Empty",'Enter the candidate password to proceed','error');
            return false;
          } else if (student_contact == "" || student_contact == false) {
            swal("Contact Empty",'Enter students contact to proceed','error');
            return false;
          } else if (gender == "" || gender == false) {
            swal("Gender Empty",'Enter students gender to proceed','error');
            return false;
          } else if (dob == "" || dob == false) {
            swal("DOB Empty",'Enter the Date of Birth to proceed','error');
            return false;
          } else if (student_blood_group == "" || student_blood_group == false) {
            swal("Blood Group Empty",'Enter the students bllod group to proceed','error');
            return false;
          } else if (student_address == "" || student_address == false) {
            swal("Student Address Empty",'Enter students address to proceed','error');
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