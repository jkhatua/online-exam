<?php

if(!isset($_SESSION)){
      session_start();
  }

$time = $_SESSION['time'];

$date = date("Y-m-d g:m:s A");

$date2 = date('Y-m-d g:m:s A',strtotime($time));

$a = date_create($date);
$b = date_create($date2);

if (($a == $b) || ($a > $b)) {
	header("Location: exam_finish.php?exam=timeout");
	exit();
}

?>