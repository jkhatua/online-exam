<?php
// session_start();

$con = mysqli_connect('localhost','root','','eexamportal');

 if(isset($_POST['Submit']))
  {
      $name = $_POST['Name'];
      $password = $_POST['Password'];

      if (!empty($name) || !empty($password)) {
        $result = mysqli_query($con, "SELECT * FROM administration WHERE admin_email='$name' AND admin_password='$password'");
        // var_dump($result);

        if($row=mysqli_fetch_assoc($result))
            {
              if (!isset($_SESSION)) {
                session_start();
              }
              $_SESSION['user_name'] = $row['admin_name'];
              $_SESSION['user_email'] = $row['admin_email'];
              //$_SESSION['userid'] = $row['admin_userid'];
              $_SESSION['user_type'] = $row['admin_type'];
              $_SESSION['sub_id'] = $row['sub_id'];
              // $_SESSION['user']=$row['Admin'];
              header('Location: teacher0.php');
              exit();
            } else {
              header("Location: index.php?input=invalid");
              exit();      
            }

         // if (!$result)
         //  {
         //      header('location:index.php');
         //      exit();
         //  }  
         //  else 
         //   {
         //    if($row=mysqli_fetch_assoc($result))
         //    {
         //      session_start();
         //      $_SESSION['user']=$row->admin;
         //      header('location:teacher0.php');
         //      exit();
         //    }
         //  } 
      } else {
        header("Location: index.php?fields=empty");
        exit();
      }

  } 
      ?>    
<html>

<head>
    <title>Sign in</title>

    <link rel="stylesheet" href="bootstrap.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
         
<form action="" method="POST"> 
     
    <p style="text-align: center;">User name: <input type="text"  name="Name"> </p>   

     <p style="text-align: center;">Password: <input type="Password"  name="Password"> </p>

    <p style="text-align: center;"><input type="submit" value="Submit" name="Submit">    
        <input type="reset" value="Reset" name="Reset"> </p>

</form>



</body>
</html>