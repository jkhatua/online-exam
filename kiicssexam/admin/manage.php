 <?php
$con = mysqli_connect('localhost','root','','eexamportal');

session_start();

if(!isset($_SESSION['user_name']) || !isset($_SESSION['user_email']) || !isset($_SESSION['user_type']) || !isset($_SESSION['sub_id']))
    {
        header('Location: index.php?login=required');
        exit();
    }

    $user_type = $_SESSION['user_type'];
    $sub_id = $_SESSION['sub_id'];
?>


<html>
<head>
<title>Manage Records</title>
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
	  <li><a href="view.php">List all records</a></li>
      <li class="active"><a href="manage.php">Update/Delete</a></li>
	  <li><a href="logout.php">Logout</a></li>
    </ul>
  </div>
</nav>


<div class="container-fluid">
<div class="row">

<div class="col-sm-12 ">
<div class="panel panel-primary">
<div class="panel-heading">Question Records</div>
<div class="panel-body">
<?php
$numofrows=0;
$msg="";


/* Update / Delete Code Starts Here */
if(ISSET($_GET["updatebtn"]))
	{
	$id= $_GET["id"];
	$question= $_GET["question"];
	$option1= $_GET["option1"];
	$option2= $_GET["option2"];
	$option3= $_GET["option3"];
	$option4= $_GET["option4"];
	$answer= $_GET["answer"];
	$marks= $_GET["marks"];
	
	$sql="UPDATE questions set question='$question',optionA='$option1',optionB='$option2',optionC='$option3',optionD='$option4',answer='$answer',marks='$marks' where id=$id";
	
	if($conn->query($sql)=== TRUE)
	{
		$msg="<p class='alert alert-success'>Update Success</p>";
	}
	
	else
	{
		$msg="<p class='alert alert-danger'>Failed to update data</p>";
	}
	
	
	}
	
if(ISSET($_GET["deletebtn"]))
	{
	$id= $_GET["id"];
	
	$sql="DELETE from questions where id=$id";
	
	if($conn->query($sql)=== TRUE)
	{
		$msg="<p class='alert alert-success'>Delete Success</p>";
	}
	
	else
	{
		$msg="<p class='alert alert-danger'>Failed to delete data</p>";
	}
	}
/* Update / Delete Code Ends Here */


if($conn->connect_error)
{
	echo "Connection Error";
}
else
{
	//echo "Connection established";

	$sql="SELECT * FROM questions WHERE sub_id='$sub_id'";
	$result = $conn->query($sql);
$numofrows=$result->num_rows;
if ($result->num_rows > 0) {
    // output data of each row
?>
<table class="table table-responsive table-bordered">
<thead>
<tr><th class="text-center">Question</th><th class="text-center">Option1</th><th class="text-center">Option2</th><th class="text-center">Option3</th><th class="text-center">Option4</th><th class="text-center">Answer</th><th class="text-center">Marks</th><th class="text-center">Action</th></tr>
</thead>
<?php
	$a =1;
    while($row = $result->fetch_assoc()) {
		$id=$row['id'];
		$question=$row["question"];
		$option1=$row["optionA"];
		$option2=$row["optionB"];
		$option3=$row["optionC"];
		$option4=$row["optionD"];
		$answer=$row["answer"];
		$marks=$row["marks"];
		
        echo "<form action='' method='GET'>
		<input type='hidden' name='id' value='$id'>
		<tr>
		
		<td class='text-center'><input type='text' class='form-control' name='question' placeholder='Enter Question' value='$question' required></td>
		<td class='text-center'><input type='text' class='form-control' name='option1' placeholder='Enter Option1' value='$option1' required></td>
		<td class='text-center'><input type='text' class='form-control' name='option2' placeholder='Enter Option2' value='$option2' required></td>
		<td class='text-center'><input type='text' class='form-control' name='option3' value='$option3' placeholder='Enter Option3' required></td>
		<td class='text-center'><input type='text' class='form-control' name='option4' value='$option4' placeholder='Enter Option4' required></td>
		<td class='text-center'><input type='text' class='form-control' name='answer' value='$answer' placeholder='Enter Answer' required></td>
		<td class='text-center'><input type='number' class='form-control' name='marks' value='$marks' step='0.01' placeholder='Enter Marks' required></td>
		<td class='text-center'><button type='submit' name='updatebtn' class='btn btn-warning btn-sm' style='margin-right:3px'>Update</button><button type='submit' name='deletebtn' class='btn btn-danger btn-sm '>Delete</button></td></tr></form>";
		$a++;
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


<?php echo $msg; ?>
	


<div class="clearfix"></div>
</div>
</div>
</div>

<div class="clearfix"></div>
</div>
</div>







</body>
</html>
