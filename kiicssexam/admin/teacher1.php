 <?php

error_reporting(0);

$con = mysqli_connect('localhost','root','','eexamportal');

session_start();

if(!isset($_SESSION['user_name']) || !isset($_SESSION['user_email']) || !isset($_SESSION['user_type']) || !isset($_SESSION['sub_id']))
    {
        header('Location: index.php?login=required');
        exit();
    }

    $sub_id = $_SESSION['sub_id'];
    $subject = $_SESSION['user_type'];
?>



<html>
<head>
<title>Teacher Records</title>
<link rel="stylesheet" href="bootstrap.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('	<div class="form-group"><label for="question">Question</label><input type="text" class="form-control" id="question" name="question[]" placeholder="Enter Question" required></div><div class="form-group"><label for="optionA">Option A</label><input type="text" class="form-control" id="optionA" name="optionA[]" placeholder="Enter Option A" required></div><div class="form-group"><label for="optionB">Option B</label><input type="text" class="form-control" id="optionA" name="optionB[]" placeholder="Enter Option B" required></div><div class="form-group"><label for="optionC">Option C</label> <input type="text" class="form-control" id="optionC" name="optionC[]" placeholder="Enter Option C" required></div><div class="form-group"><label for="optionD">Option D</label><input type="text" class="form-control" id="optionA" name="optionD[]" placeholder="Enter Option D" required></div><div class="form-group"><label for="answer">Answer</label><select class="form-control" id="answer" name="answer[]" placeholder="Enter Answer" required><option value="A">OptionA</option><option value="B">OptionB</option><option value="C">OptionC</option><option value="D">OptionD</option></select></div><a href="#" class="remove_field">Remove</a></div>'); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script>

</head>
<body>
<?php
$sn="localhost";
$un="root";
$pw="";
$db="eexamportal";

$conn=new mysqli($sn,$un,$pw,$db);
?>
<div class="header" align="center" style="background-color:#0066CC" "container-fluid" ><h1>Teacher Panel</h1> </div>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"></a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="teacher0.php">Insert</a></li>
	  <li><a href="view.php">List all records</a></li>
      <li><a href="manage.php">Update/Delete</a></li>
	   <li align="right"><a href="logout.php">Logout</a></li>

    </ul>

  </div>
</nav>
<div class="container">
<div class="row">

<div class="col-sm-6 col-sm-offset-3">
<div class="panel panel-primary">
<div class="panel-heading">Insert Question</div>
<div class="panel-body">
<form name="form_name" action="" method="POST" id="form_name">
<div class="input_fields_wrap">
    <button class="add_field_button">Add More Questions</button>
	<?php
	if (isset($_POST['numbers'])) {
		$num=$_POST['numbers'];
		for($m=1;$m<=$num;$m++)
		{
			?>

			<div class="row">
		    <div class="form-group">
		    <input type="hidden" class="form-control" id="name" name="name[]" value="abc" placeholder="Enter Number" required>
			</div>
			<div class="form-group">
		    <input type="hidden" class="form-control" id="age" name="age[]" value="1" placeholder="Enter Option 1" required></div>
			<div class="form-group"><label for="question">Question</label>
		    <input type="text" class="form-control" id="question" name="question[]" placeholder="Enter Question" required></div>
			<div class="form-group"><label for="optionA">Option A</label>
		    <input type="text" class="form-control" id="optionA" name="optionA[]" placeholder="Enter Option A" required></div>
			<div class="form-group"><label for="optionB">Option B</label>
		    <input type="text" class="form-control" id="optionA" name="optionB[]" placeholder="Enter Option B" required></div>
			<div class="form-group"><label for="optionC">Option C</label>
		    <input type="text" class="form-control" id="optionC" name="optionC[]" placeholder="Enter Option C" required></div>
			<div class="form-group"><label for="optionD">Option D</label>
		    <input type="text" class="form-control" id="optionA" name="optionD[]" placeholder="Enter Option D" required></div>
			<div class="form-group">
				<label for="answer">Answer</label>
		    	<select class="form-control" id="answer" name="answer[]" placeholder="Enter Answer" required>
		    		<option value="A">OptionA</option>
		    		<option value="B">OptionB</option>
		    		<option value="C">OptionC</option>
		    		<option value="D">OptionD</option>
		    	</select>
		    </div>
			
			
			
			
			</div>

			<?php
		}
	}

	// $num=$_POST['numbers'];
	// for($m=1;$m<=$num;$m++)
	// {
		?>
	<!-- <div class="row">
    <div class="form-group">
    <input type="hidden" class="form-control" id="name" name="name[]" value="abc" placeholder="Enter Number" required>
	</div>
	<div class="form-group">
    <input type="hidden" class="form-control" id="age" name="age[]" value="1" placeholder="Enter Option 1" required></div>
	<div class="form-group"><label for="question">Question</label>
    <input type="text" class="form-control" id="question" name="question[]" placeholder="Enter Question" required></div>
	<div class="form-group"><label for="optionA">Option A</label>
    <input type="text" class="form-control" id="optionA" name="optionA[]" placeholder="Enter Option A" required></div>
	<div class="form-group"><label for="optionB">Option B</label>
    <input type="text" class="form-control" id="optionA" name="optionB[]" placeholder="Enter Option B" required></div>
	<div class="form-group"><label for="optionC">Option C</label>
    <input type="text" class="form-control" id="optionC" name="optionC[]" placeholder="Enter Option C" required></div>
	<div class="form-group"><label for="optionD">Option D</label>
    <input type="text" class="form-control" id="optionA" name="optionD[]" placeholder="Enter Option D" required></div>
	<div class="form-group">
		<label for="answer">Answer</label>
    	<select type="text" class="form-control" id="answer" name="answer[]" placeholder="Enter Answer" required>
    		<option value="A">OptionA</option>
    		<option value="B">OptionB</option>
    		<option value="C">OptionC</option>
    		<option value="D">OptionD</option>
    	</select>
    </div>
	
	
	
	
	</div> -->
    	<?php
	// }
	?>
	
</div>
     <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">Insert</button>
</form>
	
	
</div>
</div>
<li style="margin-left: 500px;"><a href='logout.php'>Logout</li> 
</div>
</div>
<div class="panel-footer">
<?php
if($conn->connect_error)
{
	echo "Connection Error";
}
else
{
	
	$i = count($_POST['name']);
	for($r=0;$r<$i;$r++)
	{
	if(ISSET($_POST["age"]))
	{
	$name=$_POST['name'][$r];
	$age= $_POST['age'][$r];
	$question= $_POST['question'][$r];
	$optionA= $_POST['optionA'][$r];
	$optionB= $_POST['optionB'][$r];
	$optionC= $_POST['optionC'][$r];
	$optionD= $_POST['optionD'][$r];
	$answer=$_POST['answer'][$r];
	
	
	$sql="insert into questions(sub_id,subject,question,optionA,optionB,optionC,optionD,answer) values('$sub_id','$subject','$question','$optionA','$optionB','$optionC','$optionD','$answer')";
	
	if($conn->query($sql)=== TRUE)
	{
		echo "<p class='alert alert-success'>Insert Success</p>";
	}
	
	else
	{
		echo "<p class='alert alert-danger'>Failed to insert data</p>";
	}
	
	}
	//$conn->close();
}}

?>


</div>
</div>


</body>
</html>