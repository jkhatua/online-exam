 <?php
$con = mysqli_connect('localhost','root','','eexamportal');

session_start();

if(!isset($_SESSION['user_name']) || !isset($_SESSION['user_email']) || !isset($_SESSION['user_type']) || !isset($_SESSION['sub_id']))
    {
        header('Location: index.php?login=required');
        exit();
    }
?>



<html>
<head>
<title>View Question Records</title>
<link rel="stylesheet" href="bootstrap.css" />
</head>
<body>
<?php
include "include/database.php";
?>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"></a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="teacher0.php">Insert</a></li>
	  <li class="active"><a href="view.php">List all Records</a></li>
      <li><a href="manage.php">Update/Delete</a></li>
	  <li><a href="logout.php">Logout</a></li>
    </ul>
  </div>
</nav>


<div class="container-fluid">
<div class="row">

<div class="col-sm-12">
<div class="panel panel-primary">
<div class="panel-heading">All Question Records</div>
<div class="panel-body">
<?php
$numofrows=0;
if($conn->connect_error)
{
	echo "Connection Error";
}
else
{
	//echo "Connection established";
  $sub_id = $_SESSION['sub_id'];
	$sql="SELECT * FROM questions WHERE sub_id='$sub_id'";
	$result = $conn->query($sql);
$numofrows=$result->num_rows;
if ($result->num_rows > 0) {
    // output data of each row
?>
<table class="table table-responsive table-bordered">
<thead>
<tr><th class="text-center">Question</th><th class="text-center">Option1</th><th class="text-center">Option2</th><th class="text-center">Option3</th><th class="text-center">Option4</th><th class="text-center">Answer</th><th class="text-center">Marks</th></tr>
</thead>
<?php

    while($row = $result->fetch_assoc()) {
      // print_r($row);
        echo "<tr><td class='text-center'>".$row["question"]."</td><td class='text-center'>".$row["optionA"]."</td><td class='text-center'>".$row["optionB"]."</td><td class='text-center'>".$row["optionC"]."</td><td class='text-center'>".$row["optionD"]."</td><td class='text-center'>".$row["answer"]."</td><td class='text-center'>".$row["marks"]."</td></tr>";
    }
?>

</table>





<?php	
	
} 
else
	{
		echo "<p class='alert alert-danger'>No Records Found</p>";
	}

	//$conn->close();
}

?>
</div>

<div class="panel-footer">
<a href="#" class="pull-right">Total Records Available:<?php echo $numofrows; ?></a>
<div class="clearfix"></div>
</div>
</div>
</div>

<div class="clearfix"></div>
</div>
</div>







</body>
</html>
