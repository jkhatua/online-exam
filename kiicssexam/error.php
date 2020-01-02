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

  <!-- <link rel="stylesheet" type="text/css" href="assets/css/style.css"> -->

</head>
<body>

<div style="padding: 40px;">
  <h1 class="text-center">Error Login</h1>
  <p class="text-center">To proceed, Please login using correct credentials.</p>
  <p class="text-center"><a href="index.php">Click here</a> to proceed to Login Page.</p>
</div>

</body>
</html>

