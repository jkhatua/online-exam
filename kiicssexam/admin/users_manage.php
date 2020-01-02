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
        <h1 class="text-center">Users</h1>
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
            <div class="col-md-3"></div>
          </div>
          
          <div class="row">
            <div class="col-md-6">
              <p class="text-center"><i><b>Note:</b> Do not forget to set time for any subject after adding a new user for a new subject in the <a href="subjects_manage.php" style="color: blue;"><b>Subject</b></a> tab.</i></p>
            </div>
            <div class="col-md-6">
              <p><i>By Default the time has been set for 1 hour and total of 20 questions have been added when adding an user.</i></p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6"></div>
            <div class="col-md-3 text-right">
              <button class="btn btn-success" data-toggle="modal" data-target="#add_users">Add Users</button>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12" style=" min-height: 300px;">
              <table class="table table-bordered table-danger">
                <thead class="text-center">
                  <th>S.No.</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Subject</th>
                  <th>Subject ID</th>
                  <!-- <th>User ID</th> -->
                  <th>Password</th>
                  <th>Edit/Delete</th>
                </thead>

                  <?php
                    include 'action/dbh.inc.php';

                    $count = 1;
                    $fetch = "SELECT * FROM administration";
                    $fetch_query = mysqli_query($conn, $fetch);
                    while ($row = mysqli_fetch_assoc($fetch_query)) {
                      if ($row['admin_type'] != "admin") {
                        echo "<tr class='text-center'>";
                        echo "<td>".$count.".</td>";
                        echo "<td>".$row['admin_name']."</td>";
                        echo "<td>".$row['admin_email']."</td>";
                        $subb = $row['admin_type'];
                        $sub = "SELECT * FROM subjects WHERE subjects='$subb' ";
                        $fetch_sub = mysqli_query($conn, $sub);
                        while ($data = mysqli_fetch_assoc($fetch_sub)) {
                          echo "<td>".$data['subjects_name']."</td>";
                        }
                        // echo "<td>".$row['admin_type']."</td>";
                        echo "<td>".$row['sub_id']."</td>";
                        // echo "<td>".$row['admin_userid']."</td>";                        
                        echo "<td>".$row['admin_password']."</td>";
                        echo '<td class="text-center edit">
                                    <form action="action/users_edit_options.inc.php" method="POST">
                                      <input type="hidden" name="sub_id" value="'.$row['sub_id'].'">
                                      <button name="edit_user" class="hide_button"><i class="fa">&#xf044;</i></button>
                                      /
                                      <button name="delete_user" class="hide_button" onClick=\'return confirm("Are you sure you want to delete??");\'><i class="fa">&#xf014;</i></button>
                                    </form>
                                  </td>';
                        $count++;
                        echo "</tr>";
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
</section>

<!-- The Modal -->
  <div class="modal" id="add_users">
    <div class="modal-dialog modal-lg"  role="document">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <!-- <div class="modal-header">
          <h4 class="modal-title">Modal Heading</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div> -->
        
        <!-- Modal body -->
        <div class="modal-body">
          <h3 class="text-center">Add User</h3>
          <!-- <br> -->
          <div class="container">
            <div class="row">
              <div class="col-md-12 text-center">
                <form action="action/add_users.inc.php" method="POST" id="AddUsers">
                <!-- <form method="POST" id="AddUsers"> -->
                  <div class="container">
                    
                    <div class="row">
                        <div class="col-md-12 form-inline" style="display: table;">
                          <input type="hidden" name="sub_id" value="<?php echo $user['sub_id']; ?>">
                          <input type="hidden" name="sub_id" value="<?php echo $user['sub_id']; ?>">
                          <label class="form-control" for="add_user_name" style=" display: table-cell; width: 150px;"><b>User Name</b></label>
                          <input class="form-control" type="text" name="add_user_name" id="add_user_name" placeholder="Enter User Name" style="display: table-cell; width: 100%;">      
                        </div>
                      </div>
                      <!-- <div class="row">
                        <div class="col-md-12 form-inline" style="display: table;">
                          <label class="form-control" for="add_user_id" style=" display: table-cell; width: 150px;"><b>UserID</b></label>
                          <input class="form-control" type="text" name="add_user_id" id="add_user_id" placeholder="Enter User ID" style="display: table-cell; width: 100%;">      
                        </div>
                      </div> -->
                      
                      <div class="row">
                        <div class="col-md-12 form-inline" style="display: table;">
                          <label class="form-control" for="add_user_email" style=" display: table-cell; width: 150px;"><b>User Email</b></label>
                          <input class="form-control" type="text" name="add_user_email" id="add_user_email" placeholder="Enter User Email" style="display: table-cell; width: 100%;">      
                        </div>
                      </div>
                      
                      <div class="row">
                        <div class="col-md-12 form-inline" style="display: table;">
                          <label class="form-control" for="add_user_password" style=" display: table-cell; width: 150px;"><b>Password</b></label>
                          <input class="form-control" type="password" name="add_user_password" id="add_user_password" placeholder="Set User Password" style="display: table-cell; width: 100%;">      
                        </div>
                      </div>
                      
                      <div class="row">
                        <div class="col-md-12 form-inline" style="display: table;">
                          <?php
                            $subjects = "SELECT * FROM subjects";
                            $sub_fetch = mysqli_query($conn, $subjects);
                          ?>
                          <label class="form-control" for="add_user_subject" style=" display: table-cell; width: 150px;"><b>Subject Name</b></label>
                          <input class="form-control" type="text" list="sub_name" name="add_user_subject" id="add_user_subject" placeholder="Enter Subject Name" style=" display: table-cell; width: 100%;">
                          <datalist type="text" id="sub_name" style=" display: hidden;">
                                <!-- <option value="">---Select a Subject---</option> -->
                            <?php while ($row1=mysqli_fetch_assoc($sub_fetch)) { ?>
                                <option><?php echo $row1['subjects_name']; ?></option>
                            <?php } ?>
                          </datalist>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12 form-inline" style="display: table;">
                          <?php
                            $subjects = "SELECT * FROM subjects";
                            $sub_fetch = mysqli_query($conn, $subjects);
                          ?>
                          <label class="form-control" for="add_user_subject_code" style=" display: table-cell; width: 150px;"><b>Subject Code</b></label>
                          <input class="form-control" type="text" list="sub_code" name="add_user_subject_code" id="add_user_subject_code" placeholder="Enter Subject code" style=" display: table-cell; width: 100%;">
                          <datalist type="text" id="sub_code" style=" display: hidden;">
                                <!-- <option value="">---Select a Subject---</option> -->
                            <?php while ($row1=mysqli_fetch_assoc($sub_fetch)) { ?>
                                <option><?php echo $row1['subjects']; ?></option>
                            <?php } ?>
                          </datalist>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12 form-inline" style="display: table;">
                          <label class="form-control" for="add_user_subject_id" style=" display: table-cell; width: 150px;"><b>SubjectID</b></label>
                          <input class="form-control" type="text" name="add_user_subject_id" id="add_user_subject_id" placeholder="Enter SubjectID" style="display: table-cell; width: 100%;">      
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-4"></div>
                      <div class="col-md-4"></div>
                      <div class="col-md-4 form-inline" style="display: table;">
                        <button class="btn btn-success" name="add_user_button" id="add_user_button" style="display: table-cell; width: 85%;">Add Users</button>
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

  function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return !re.test(email);
  }
  
  $(document).ready(function () {
      $("#add_user_button").click(function (e) {
        // e.preventDefault();
         // $("#edit_student_id").val(kbcdjskb); 
         var add_user_name = $('#add_user_name').val();
          var add_user_id = $('#add_user_id').val();
          var add_user_email = $('#add_user_email').val();
          var add_user_password = $('#add_user_password').val();
          var add_user_subject = $('#add_user_subject').val();
          var add_user_subject_code = $('#add_user_subject_code').val();
          var add_user_subject_id = $('#add_user_subject_id').val();
          
          if (add_user_name == "" || add_user_name == false) {
            swal("UserName Empty",'Enter the User name to proceed','error');
            return false;
          } else if ( add_user_id == "" || add_user_id == false) {
            swal("UserID Empty",'Enter the UserID to proceed','error');
            return false;
          } else if (add_user_email == "" || add_user_email == false) {
            swal("User Email Empty",'Enter the User Email to proceed','error');
            return false;
          } else if (validateEmail(add_user_email)) {
            swal("Email Invalid",'Enter the valid EmailID to proceed','error');
            return false;
          } else if (add_user_password == "" || add_user_password == false) {
            swal("Password Empty",'Enter the password to proceed','error');
            return false;
          } else if (add_user_password.length < 8) {
            swal("Password Invalid",'Password must be minimum of 8 characters','error');
            return false;
          } else if (add_user_subject == "" || add_user_subject == false) {
            swal("Subject Empty",'Enter the Subject to proceed','error');
            return false;
          } else if (add_user_subject_code == "" || add_user_subject_code == false) {
            swal("Subject Code Empty",'Enter the subject code name to proceed','error');
            return false;
          } else if (add_user_subject_id == "" || add_user_subject_id == false) {
            swal("SubjectID Empty",'Enter the subject ID to proceed','error');
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

</body>
</html>
