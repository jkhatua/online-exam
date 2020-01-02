<?php 

	if(!isset($_SESSION)){
	    session_start();
	}

	include 'action/dbh.inc.php';

	include_once 'action/recent_activity.inc.php';

	if (!isset($_SESSION['can_id']) || !isset($_SESSION['can_name']) || !isset($_SESSION['can_email'])) {
	    header("Location: error.php?login=required");
	    exit();
	  }

	$can_id = $_SESSION['can_id'];
	$user_name = $_SESSION['can_name'];
	$user_email = $_SESSION['can_email'];
	//Unset all exam sessions and cookies ENDS

	// $exam_start_time = $_SESSION['exam_start_time'];    //Session variable storing exam start timestamp
	// $exam_start_time = date("Y-m-d H:i:s", $exam_start_time);
	// $fetch = "SELECT * FROM answers WHERE user_email='$user_email' AND dates>='$exam_start_time'";
	// $fetch_query = mysqli_query($conn, $fetch);

	// $num = mysqli_num_rows($fetch_query);
	// $totalmark = 0;
	// if ($num) {
	// 	while ($answers = mysqli_fetch_array($fetch_query)) {
	// 		$totalmark = $totalmark + $answers['markgot'];
	// 	}
	// }

	$results_data = $_SESSION['results_data'];

	// print_r($results_data);
	$total = 0.00;
	$row = $_SESSION['row'];
	foreach ($row as $question_data) {
		// echo $question_data[];
		$total = $total + $question_data['marks'];
	}

	$achieved = $results_data['marks_achieved'];

	$percentage = ($achieved / $total) * 100;

	if ($percentage >= 90 && $percentage <=100) {
		$grade = "O";
	} elseif ($percentage >= 80 && $percentage < 90) {
		$grade = "E";
	} elseif ($percentage >= 70 && $percentage < 80) {
		$grade = "A";
	} elseif ($percentage >= 60 && $percentage < 70) {
		$grade = "B";
	} elseif ($percentage >= 50 && $percentage < 60) {
		$grade = "C";
	} else {
		$grade = "Failed";
	}

	// echo $percentage;

	// echo $total;
	// print_r($results_data);


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

  <style type="text/css">
    .center {
	    display: block;
	    margin-left: auto;
	    margin-right: auto;
	    width: 50%;
	}
    @media print {
    	.do_not_print {
	    	display: none;
	    }
	    .footer {
	    	position: fixed;
	    	bottom: 0;
	    	width: 100%;
	    	text-align: left;
	    }
	    .mark1 {
	    	margin-top: 60px;
	    }
    }


	#watermark {
	  top: 30%;
	  font-size: 200px;
	  color: rgb(150,150,150);
	  opacity:0.1;
	  z-index:-99;
  	  position: absolute;
  	  text-align: center;
  	  width: 80%;
  	  transform: rotate(-45deg); /* Equal to rotateZ(-45deg) */
  	  -webkit-transform:rotate(-45deg);
	}

  </style>

</head>
<body style="padding: 20px;">

	<div class="container" style="padding-top: 50px;">

		<div id="watermark">
			<p>C.U.O.E.Exam</p>
			<!-- <p>Appin Bhubaneswar</p> -->
		</div>

		<div class="row">
			<div class="col-md-12">
				<p class="text-center do_not_print"><i>To print the result <button onclick="window.print();" style="background-color: transparent; border: transparent; color: blue;">Click Here</button>.</i></p>
				<p class="text-center do_not_print" style="font-size: 14px;">To go to next page, <a href="feedback.php">click here</a>.</p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h1 class="text-center display-4" style="padding-bottom: 80px;"><b><i><?php echo $results_data['subjects_name']; ?></i></b></h1>
				<h1 class="text-center">Provisional Certificate</h1>
			</div>
		</div>
		<div class="row" style="height: 400px; padding-top: 100px;">
			<div class="col-md-12">
				
				<p class="text-center" style="padding-top: 50px;"><i><strong>Presented To:</strong></i> <br><font style="font-size: 25px; font-weight: bold;"> <?php echo $user_name; ?> </font></p>
				<?php
					echo "<p class='text-center mark1' style='padding-top: 30px; font-size: 20px;'>This is to certificy that ".$user_name." has successfully completed <br>the ".$results_data['subjects_name']." exam.</p>";
				?>
			</div>
		</div>
		<!-- <div class="row" style="padding-top: 100px; bottom: 40px;">
			<div class="col-md-12">
				<p class="text-center" style="font-size: 20px;"><b>Score:</b> <?php //echo $results_data['marks_achieved']; ?> out of <?php //echo $total; ?></p>
				<hr> -->
				<!-- <?php //$time = $_SESSION['exam_start_time']; ?>
				<p class="text-right"><?php //echo date("d M, Y h:i:s a", $time); ?></p> -->
				<!-- <img src="assets/images/check.png" class="center" style="height: 200px; width: auto; padding-top: 30px;"> -->
				<!-- <img src="assets/images/check.png" style="height: 200px; width: auto; padding-top: 30px;">
			</div>
		</div> -->
	</div>

	<div style="padding-top: 250px;">
		<!-- <p class="text-center" style="font-size: 20px;"><b>Score:</b> <?php// echo $results_data['marks_achieved']; ?> out of <?php //echo $total; ?></p> -->
		<!-- <p class="text-center" style="font-size: 20px;"><b>Score:</b> <?php //echo $percentage; ?> %</p> -->
		<p class="text-center" style="font-size: 20px;"><b>Grade Scored: <?php echo $grade; ?></b></p>
		<p style="padding-top: 30px;">Centurion institute of Information and Cyber Security Solutions</p>
		<hr>
		<?php $time = $_SESSION['exam_start_time']; ?>
		<p class="text-right"><?php echo date("d M, Y h:i:s a", $time); ?></p>
		<!-- <img src="assets/images/check.png" class="center" style="height: 200px; width: auto; padding-top: 30px;"> -->
		<img src="images/gellu.jfif" style="height: 300px; width: auto; padding-top: 30px;">
	</div>
<?php
	// print_r($results_data);
?>

	<footer class="footer" style=" bottom: 0;">
		<p class="text-center">Conducted by CUOEExam &copy; 2019</p>
		<p>O=Outstanding, E=Excellent A=Very Good, B=Good, C=Average</p>
		<p class="do_not_print"><i><b>Note:</b> This a provisional certificate. Do not forget to keep a copy of it for further future requirements.</i></p>
	</footer>
	

</body>
</html>