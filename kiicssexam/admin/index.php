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

  <script type="text/javascript" src="assets/js/loginValidation.js"></script>

  <script src="package/dist/sweetalert2.js"></script>
  <link rel="stylesheet" href="package/dist/sweetalert2.min.css">

  <style type="text/css">
    html, body {
      background: linear-gradient(rgb(10,100,50), rgb(10,100,100));
      /*background-color: rgba(20,20,255, 0.1);*/
     min-height: 100%;
    }

  </style>

</head>
<body>

<section>
  <div class="container">
    
    <div class="row" style="min-height: 180px;">
      <div class="col-md-4"></div>
      <div class="col-md-4" style="padding-top: 100px;">
        <?php
          if (!isset($_SESSION)) {
            session_start();
          }
          if (isset($_SESSION['failuremsg'])) {
            ?>
              <div class="alert alert-danger alert-dismissible text-center">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Login Failed!</strong><br> <?php echo $_SESSION['failuremsg']; ?>. 
              </div>
            <?php
            unset($_SESSION['failuremsg']);
          }
        ?>
      </div>
      <div class="col-md-4"></div>
    </div>

    <div class="row">
    	<div class="col-md-4"></div>
    	<div class="col-md-4" style="padding-top: 10px; background-color: rgba(150,150,255,0.3); border-radius: 15px; margin-top: 50px;">
    		<h2 class="text-center" style=" font-size: 48px; color: lightgray; text-shadow: 3px 2px rgba(0,0,0,0.7);">Login</h2>
    		
<!--         <form class="form-group" action="common/exam_signin_student.inc.php" method="POST" id="SignInForm"> -->
        <form class="form-group" action="action/manage_login.inc.php" method="POST">
    			<input class="form-control" type="text" name="username" id="username" placeholder="Enter the Login ID">
    			<input class="form-control" type="password" name="password" id="password" placeholder="Enter the Password" autocomplete="off">
    			<button class="btn" type="submit" name="submit" id="submit">Login</button>
    		</form>

    	</div>
    	<div class="col-md-4"></div>
    </div>
    <div class="row" style="min-height: 150px;"></div>
  </div>
</section>

</body>
</html>



<script type="text/javascript">
  
  function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return !re.test(email);
  }

  $(document).ready(function () {
      $("#submit").click(function (e) {
        // e.preventDefault();
         // $("#edit_student_id").val(kbcdjskb); 
         var username = $('#username').val();
         var password = $('#password').val();
         // alert('Hello');
          
          if (username == "" || username == false) {
            swal("Username Empty",'Enter the username to proceed','error');
            return false;
          } else if (validateEmail(username)) {
            swal("Username Invalid",'Enter the correct username','error');
            return false;
          } else if ( password == "" || password == false) {
            swal("Password Empty",'Enter the password to proceed','error');
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