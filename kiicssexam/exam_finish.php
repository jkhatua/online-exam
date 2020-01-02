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

	//Unset all exam sessions and cookies STARTS
	unset($_SESSION['qno']);
	unset($_SESSION['no_of_questions']);
	unset($_SESSION['exam_start']);
	unset($_SESSION['time_limit']);
	// setcookie("timer", "", time()-3600);
	if (isset($_COOKIE['timer'])) {
		setcookie('timer','', time()-3600);
	}
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

	.click {
		animation-name: click;
		animation-duration: 1s;
		animation-iteration-count: infinite;
	}

	@keyframes click {
		from {
			-ms-transform: translate(20px,20px); /* IE 9 */
		    -webkit-transform: translate(20px,20px); /* Safari */
		    transform: translate(20px,20px); /* Standard syntax */
		}
		to {
			-ms-transform: translate(0px,0px); /* IE 9 */
		    -webkit-transform: translate(0px,0px); /* Safari */
		    transform: translate(0px,0px); /* Standard syntax */	
		}
	}

	.spread {
		animation-name: spread;
		animation-duration: 1s;
		animation-iteration-count: infinite;
		/*animation-delay: 0.5s;*/
	}

	@keyframes spread {
		to {
			-ms-transform: scale(1.4,1.4); /* IE 9 */
		    -webkit-transform: scale(1.4,1.4); /* Safari */
		    transform: scale(1.4,1.4); /* Standard syntax */
		    z-index: -99;
		}
		from {
			-ms-transform: scale(1,1); /* IE 9 */
		    -webkit-transform: scale(1,1); /* Safari */
		    transform: scale(1,1); /* Standard syntax */	
		}
	}

  </style>

<?php
	if (isset($_COOKIE['timer'])) {
		setcookie('timer','', time()-3600);
	}
?>


</head>
<body style="padding: 20px; background-color: lightgray">

	<div class="container" style="padding: 50px;">
		<div class="row">
			<div class="col-md-12">
				<h1 class="text-center">Exam Finished</h1>
				<div class="container" style="padding-top: 50px;">
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-8">
							<p class="text-center">You have successfully completed the examination.</p>
							<p class="text-center">Click on the below button in order to get your provisional certificate.</p>
							
							<div class="text-center">
								<a href="provisional_certificate.php" style="color: blue; padding-left: 5px;">
								<img class="click" src="assets/images/click.png" style="height: 50px; position: absolute;">
								<button class="btn spread" style="border-radius: 50%; height: 30px; width: 30px; background-color: rgba(100,100,100,0.4); border: 2px solid rgba(100,100,100,0.4); position: absolute; z-index: -99;">
								<button class="btn" style="border-radius: 50%; height: 30px; width: 30px; background-color: lime; border: 2px solid black;"><a href=""></a></button>
								<a href=""></a></button>
								<a href="provisional_certificate.php" style="color: blue; padding-left: 5px;">
									<b>Click Here</b>
								</a>
								</a>
							</div>
						</div>
						<div class="col-md-2"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>
</html>