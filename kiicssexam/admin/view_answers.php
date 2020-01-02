<?php
	
	include 'action/dbh.inc.php';

	if (!isset($_SESSION)) {
		session_start();
	}

  	if (!isset($_SESSION['user'])) {
    	header("Location: error_login.php?session=absent");
    	exit();
  	}

  	if (isset($_POST['view_answers'])) {
  		$can_id = $_POST['can_id'];
  		if (empty($can_id)) {
  			$_SESSION['failuremsg'] = "Please Select CandidateID";
  			header("Location: results.php?can_id=empty");
  			exit();
  		}
  		$fetch_candidate = mysqli_query($conn, "SELECT * FROM candidate_details WHERE can_id='$can_id'");
  		$fetch_candidate_data = mysqli_fetch_assoc($fetch_candidate);
  		if ($fetch_candidate_data['status'] == "Not Appeared") {
  			$_SESSION['failuremsg'] = "This candidate has not Appeared the exam";
  			header("Location: results.php?can_id=notAppeared");
  			exit();
  		}

  		// $fetch_answers = mysqli_query($conn, "SELECT * FROM answers WHERE can_id='$can_id'");
  		// $fetch_answers_rows = mysqli_num_rows($fetch_answers);
  		// $fetch_answers_data = mysqli_fetch_assoc($fetch_answers);

  		$fetch_results = mysqli_query($conn, "SELECT * FROM results WHERE can_id='$can_id'");
//  		$fetch_results_rows = mysqli_num_rows($fetch_results);
  		$fetch_results_data = mysqli_fetch_assoc($fetch_results);
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
        <h1 class="text-center">Answer of <?php echo $fetch_candidate_data['can_name'] ?></h1>
        <div class="container" style="padding-top: 40px; padding-bottom: 50px;">
        	<div class="row">
        		<div class="col-md-12">
        			<table class="table table-bordered table-danger table-responsiv text-center">

                      <thead class="text-center">
                        <th class="qno_col">Q.No.</th>
                        <th class="q_col">Question</th>
                        <!-- <th class="sub_id">Subject ID</th>
                        <th class="sub_name">Subject Name</th> -->
                        <th class='options'>Answers</th>
                        <th class='answer'>Answer given</th>
                        <th class='answer'>Right Answer</th>
                        <th class="marks">Marks Got</th>
                      </thead>

                      <?php
                      	$fetch_answers = mysqli_query($conn, "SELECT * FROM answers WHERE can_id='$can_id'");
						$fetch_answers_rows = mysqli_num_rows($fetch_answers);
                      	if ($fetch_answers_rows > 0) {
                      		while ($fetch_answers_data = mysqli_fetch_assoc($fetch_answers)) {
                      			echo "<tr>";
                      			echo "<td class='qno_col'>".$fetch_answers_data['qno'].".</td>";
                            $qid = $fetch_answers_data['qid'];
                            $fetch_question = mysqli_query($conn, "SELECT * FROM questions WHERE id='$qid'");
                            $fetch_question_data = mysqli_fetch_assoc($fetch_question);
                            echo "<td class='q_col'>".$fetch_question_data['question']."</td>";
                      			echo "<td class='options text-left'>A.".$fetch_question_data['optionA']."<br>B.".$fetch_question_data['optionB']."<br>C.".$fetch_question_data['optionC']."<br>D.".$fetch_question_data['optionD']."</td>";
                      			// echo "<td class='sub_id'>".$fetch_answers_data['qno']."</td>";
                      			// echo "<td class='sub_name'>".$fetch_answers_data['qno']."</td>";
                      			// echo "<td class='options'>".$fetch_answers_data['qno']."</td>";
                      			echo "<td class='answer'>".$fetch_answers_data['answers_given']."</td>";
                      			echo "<td class='answer'>".$fetch_answers_data['correct_ans']."</td>";
                      			echo "<td class='marks'>".$fetch_answers_data['markgot']."</td>";
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

</body>
</html>
