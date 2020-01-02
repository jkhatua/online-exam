<?php

  // if (!isset($_SESSION)) {
  //   session_start();
  // }
  // if (isset($_SESSION['exam_start'])) {
  //   echo "Exam Started";
  //   // session_unset('exam_start');   //Do Not Use
  //   // echo $_SERVER['HTTP_REFERER'];
  //   header("Location: exam_dashboard.php");
  //   exit();
  // }

?>
<noscript>
   <!-- Your browser does not support JavaScript! -->
   <meta http-equiv="refresh" content="0;url=js_required.php">
</noscript>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="icon" href="assets/favicon.ico" type="image/x-icon"/>
  <link rel="shortcut icon" href="assets/favicon.ico" type="image/x-icon"/>
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
  <!-- Optional: include a polyfill for ES6 Promises for IE11 and Android browser -->
  <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>

  <link href="https://fonts.googleapis.com/css?family=Shrikhand" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Baloo+Bhai" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="assets/css/style.css">

</head>
<!-- <body > -->
<body>

<section>
  <div class="container" style="background-color: rgba(20,20,255, 0.1); margin-top: 30px; margin-bottom: 20px; border-radius: 15px 5px 15px 5px; box-shadow: 10px 5px rgba(0,0,0,0.2); border: 2px solid rgba(0,0,0,0.1)">
    <div class="row" style="padding-top: 50px; min-height: 200px;">
      <div class="col-md-4"></div>
      <div class="col-md-4" style="padding: 10px;">
          <img src="images/gellu.jfif" style=" display: block; margin-left: auto; margin-right: auto; width: 50%; background-color: ; border-radius: 15px;">
      </div>
      <div class="col-md-4"></div>
    </div>
    <div class="row" style="min-height: 180px;">
    	<div class="col-md-4"></div>
    	<div class="col-md-4" style="padding-top: 10px; background-color: rgba(150,150,255,0.3); border-radius: 15px;">
    		<h2 class="text-center" style="font-family: 'Shrikhand', cursive; font-size: 48px; color: white; text-shadow: 3px 2px rgba(0,0,0,0.7); -webkit-text-stroke: 2.5px black;">Exam Login</h2>
    		
        <!-- <form class="form-group" action="action/exam_signin_student.inc.php" method="POST" id="SignInForm"> -->
        <!-- <form class="form-group" action="action/login.inc.php" method="POST"> -->
        <form class="form-group" action="#" method="POST" id="SignInForm">
          <div class="form-inline" style="display: table; width: 100%;">
            <label class="form-control text-center icon" for="can_id" style="display: table-cell; width: 1px; background-color: gray;"><span><img src="assets/user.png" style=" height: 100%;"></span></label>
            <input class="form-control" type="text" name="can_id" id="can_id" placeholder="Enter the UserID" style="display: table-cell; width: 100%;">
          </div>
          <div class="form-inline" style="display: table; width: 100%;">
            <label class="form-control text-center icon" for="password" style="display: table-cell; width: 1px; background-color: gray;"><span><img src="assets/pass.png" style="height: 100%;"></span></label>
            <input class="form-control" type="password" name="password" id="password" placeholder="Enter your Password" autocomplete="off" style="display: table-cell; width: 100%;">
          </div>
          <div class="text-right">
            <button class="btn btn-success" type="submit" name="submit" id="submit" style=" width: 100px; margin-top: 5px; box-shadow: -2px -2px 5px black; font-family: 'Baloo Bhai', cursive;">Login</button>   
          </div>
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
  $(document).ready(function() {
    $('#SignInForm').submit(function(e) {
      e.preventDefault();
      var can_id = $('#can_id').val();
      var password = $('#password').val();
      
      if (can_id == "" || can_id == false) 
      {
        swal("UserID Empty",'Enter the Candidate UserID to proceed','error');
        return false;
      }
      // else if (can_id ) {}
      else if (password == "" || password == false) 
      {
        swal("Password Empty",'Enter the Password to proceed','error');
        return false;
      }
      else if (password.length < 8 )
      {
        swal("Password Invalid",'Password must have minimum 8 characters','error');
        return false;
      }
      else 
      {
        // alert(can_id);
        var formdata = {
          'can_id' : can_id,
          'password' : password
        };
        $.ajax({
                 url: "action/login.inc.php",
                 method: 'post',
                 data: formdata,
                 dataType: 'json',
                 success: function (data) {
                     console.log(data);
                     // alert(data);
                     if (!data.success == true) {
                         swal(data.heading, data.msg ,"error");
                         document.getElementById("SignInForm").reset();
                     } else {
                         swal(data.heading, data.msg,"success");
                         document.getElementById("SignInForm").reset();
                         setTimeout(function () {
                             window.location = data.page;
                         }, 1000);
                     }
                 },
                 error: function (data) {
                     console.log(data);
                 }
             });
      }
      // alert("Hello");
      // swal("success",'success','success');
    });
   
  });    
</script>

