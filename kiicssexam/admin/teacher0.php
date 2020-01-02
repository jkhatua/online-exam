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
<title>Teacher Records</title>
   

<link rel="stylesheet" href="bootstrap.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<div class="header" align="center" style="background-color:#0066CC" "container-fluid" ><h1>Teacher Panel</h1></div>
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"></a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="teacher0.php">Insert</a></li>
	  <li><a href="view.php">List all records</a></li>
      <li><a href="manage.php">Update/Delete</a></li>
     
    </ul>
  </div>
</nav>
<div class="container">
<div class="row">

<div class="col-sm-6 col-sm-offset-3">
<div class="panel panel-primary">
<div class="panel-heading">Insert number of questions</div>
<div class="panel-body">
<form method="post" name="myform" id="myform" action="teacher1.php">
<div class="form-group"><label for="name">Number</label>
<input type="text" class="form-control"  name="numbers" placeholder="Enter Number" required>
</div>
<input type="submit" value="Enter" name="submit"/>
</form>
</div>
</div>
</div>
</div>
</div>
<script type="text/javascript">
        // Wait for the DOM to be ready
        $(function() {
            // Initialize form validation on the registration form.
            // It has the name attribute "registration"
            $("form[name='myform']").validate({
                // Specify validation rules
                rules: {
                    // The key name on the left side is the name attribute
                    // of an input field. Validation rules are defined
                    // on the right side
                    Numbers: "required",
                            
                  
                },
                // Specify validation error messages
                messages: {
                    Numbers: "Please enter your Numbers",
                                    
                   
                },
                // Make sure the form is submitted to the destination defined
                // in the "action" attribute of the form when valid
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>


 <li style="margin-left: 900px;"><a href='logout.php'>Logout</li> 

   
</body>
</html>