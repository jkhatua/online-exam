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
  </style>

  <?php
    if (isset($_SESSION['successmsg'])) {
      echo "<script>";
      echo "function hello() {";
      echo "swal('Login Success','".$_SESSION['successmsg']."','success');";
      echo "return false;";
      echo "}";
      echo "</script>";
      unset($_SESSION['successmsg']);
    }
  ?>

</head>
<body onload="hello()">

<?php
  include 'layouts/topbar.php';
  include 'layouts/sidebar.php';

  include 'action/dbh.inc.php';
?>

<section class="main-page">
  <div class="container">

    <div class="row">
      <div class="col-md-12">
        <h1 class="text-center" style="padding: 30px; padding-bottom: 80px;">Hello Admin</h1>
      </div>
    </div>

    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <?php
          // if (!isset($_SESSION)) {
          //   session_start();
          // }
          // if (isset($_SESSION['successmsg'])) {
            ?>
              <!-- <div class="alert alert-success alert-dismissible text-center">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Login Success!</strong><br> <?php //echo $_SESSION['successmsg']; ?>. 
              </div> -->
            <?php
          //   unset($_SESSION['successmsg']);
          // }
        ?>
      </div>
      <div class="col-md-3"></div>
    </div>

    <?php //echo "<td> <a href='padamfail.php?FailID' onClick=\"return confirm('are you sure you want to delete??');\"><center>Delete</center></a>"; ?>
    <div class="row">
      <div class="col-md-12">
        <div class="container">
          <div class="row">
            <div class="col-md-8">
              <div style="border: 2px solid gray; border-radius: 15px; padding: 15px; min-height: 200px;">
                <h4 class="text-center">Users/Subjects:</h4>
                <table class="table text-center table-bordered table-danger">
                  <thead>
                    <th>S.No.</th>
                    <th>Teacher Name</th>
                    <th>Subject</th>
                  </thead>
                  <?php
                    $fetch = "SELECT admin_name,admin_type FROM administration";
                    $fetch_users = mysqli_query($conn, $fetch);
                    $count = 1;
                    $number = mysqli_num_rows($fetch_users);
                    if ($number == 0) {
                      echo "<tr><td colspan='3'></td></tr>";
                    }
                    while ($row = mysqli_fetch_assoc($fetch_users)) {
                      echo "<tr>";
                      if (!($row['admin_name'] == 'Admin')) {
                  ?>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $row['admin_name']; ?></td>
                        <td><?php echo $row['admin_type']; ?></td>
                  <?php
                        $count++;
                      }
                      echo "</tr>";
                    }
                  ?>
                </table>
              </div>
            </div>
            
            <div class="col-md-4" style="border: 2px solid gray; padding: 15px; border-radius: 15px;">
              <p style="font-size: 18px; font-weight: bold;">Basic Guide:-</p>
              <ul>
                <li>To view/add/modify users, choose Users</li>
                <li>To view/add/modify subjects, choose Subjects</li>
                <li>To view/add/modify student details, choose Students</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    
  </div>
</section>

</body>
</html>