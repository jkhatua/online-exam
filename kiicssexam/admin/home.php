<?php
$con = mysqli_connect('localhost','root','','eexamportal');

session_start();

if(!isset($_SESSION['user_name']) || !isset($_SESSION['user_email']) || !isset($_SESSION['user_type']) || !isset($_SESSION['sub_id']))
    {
        header('Location: index.php?login=required');
        exit();
    }
?>


<?php

$con = mysqli_connect('localhost','root','','eexamportal');

$user_id=$_SESSION['user_id'];

$result=mysqli_query($con, "SELECT * FROM user WHERE id='$user_id'");

$data=mysqli_fetch_assoc($result);

$name=$data['Name'];
$email=$data['Email'];
$phoneno=$data['Phoneno'];
$address=$data['Address'];

echo 'Welcome'."<br>". "<br>".  $name." "."<br>"."<br>".  $email." ". "<br>"."<br>". $phoneno." ". "<br>"."<br>". $address."!";

?><br>


<p style="text-align: center;margin-top: 30px;"><a href='logout.php'><input type="submit" value="Logout" name="logout"></a></p>	