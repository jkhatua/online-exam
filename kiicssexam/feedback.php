<?php
	
	if(!isset($_SESSION)){
      session_start();
  	}

  	if (!isset($_SESSION['can_id']) || !isset($_SESSION['can_name']) || !isset($_SESSION['can_email'])) {
	    header("Location: error.php?login=required");
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

</head>
<body style="padding: 20px;">
	
	<div class="container" style="padding-top: 20px;">
		<div class="row">
			<div class="col-md-12">
				<h1 class="text-center">Exam end page</h1>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">		
				<p class="text-center">Your exam has ended, Proceed and click the button to terminate process.</p>
				<form class="text-center" action="action/logoff.inc.php" method="POST">
					<button class="btn" type="submit" name="submit">End</button>
				</form>
			</div>
		</div>
	</div>

</body>
</html>