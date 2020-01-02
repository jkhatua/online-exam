<?php
  
  if (!isset($_SESSION)) {
    session_start();
  }

  $user = $_SESSION['user'];
  if (!isset($user)) {
    header("Location: error_login.php?session=absent");
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

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <style type="text/css">
    body {
      height: 100%;
      background-color: #ffe6cc;
    }
    .main-page {
      margin-top: 50px;
      margin-left: 20%;
      /*background-color: #ffe6cc;*/
      /*height: 100%;*/
      /*margin-top: 80px;*/
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
        <h1 class="text-center">Edit Question:</h1>
      </div>
    </div>
        <?php

          $edit = $_SESSION['edit'];
          $qno = $edit['id'];
          $_SESSION['qno'] = $qno; 
          // print_r($edit);
        ?>
  </div>

    <div class="container-fluid" style="padding-top: 20px;">
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <form action="action/edit_question.inc.php" method="POST" class="form-group">
            <div class="container">

              <!-- <div class="row">
                <div class="col-md-2">
                  <label for="qno">Q.No:&nbsp;</label>
                </div>
                <div class="col-md-10">
                  <input class="form-control text-center" type="text" name="qno" value="<?php //echo $edit['qno']; ?>"> 
                </div>
              </div> -->

              <div class="row">
                <div class="col-md-2">
                  <label for="question">Question:&nbsp;</label>
                </div>
                <div class="col-md-10">
                  <textarea class="form-control text-center" type="text" name="question" value="<?php echo $edit['question']; ?>"><?php echo $edit['question']; ?></textarea>
                </div>
              </div>

              <div class="row">
                <div class="col-md-2">
                  <label for="answer">Answer:&nbsp;</label>
                </div>
                <div class="col-md-10">
                  <input class="form-control text-center" type="text" name="answer" value="<?php echo $edit['answer']; ?>">
                </div>
              </div>

              <div class="row">
                <div class="col-md-2">
                  <label for="optionA">OptionA:&nbsp;</label>
                </div>
                <div class="col-md-10">
                  <textarea class="form-control text-center" type="text" name="optionA" value="<?php echo $edit['optionA']; ?>"><?php echo $edit['optionA']; ?></textarea>
                </div>
              </div>

              <div class="row">
                <div class="col-md-2">
                  <label for="optionB">OptionB:&nbsp;</label>
                </div>
                <div class="col-md-10">
                  <textarea class="form-control text-center" type="text" name="optionB" value="<?php echo $edit['optionB']; ?>"><?php echo $edit['optionB']; ?></textarea>
                </div>
              </div>

              <div class="row">
                <div class="col-md-2">
                  <label for="optionC">OptionC:&nbsp;</label>
                </div>
                <div class="col-md-10">
                  <textarea class="form-control text-center" type="text" name="optionC" value="<?php echo $edit['optionC']; ?>"><?php echo $edit['optionC']; ?></textarea>
                </div>
              </div>

              <div class="row">
                <div class="col-md-2">
                  <label for="optionD">OptionD:&nbsp;</label>
                </div>
                <div class="col-md-10">
                  <textarea class="form-control text-center" type="text" name="optionD" value="<?php echo $edit['optionD']; ?>"><?php echo $edit['optionD']; ?></textarea>
                </div>
              </div>

              <div class="row">
                <div class="col-md-2">
                  <label for="mark" style="display: table-cell; width: 1px">Mark:&nbsp;</label>  
                </div>
                <div class="col-md-10">
                  <input class="form-control text-center" type="text" name="mark" value="<?php echo $edit['marks']; ?>" style="display: table-cell; width: 100%;">  
                </div>
              </div>

              <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4"></div>
                <div class="col-md-4">
                  
                  <button class="btn btn-success form-control" name="submit">Submit</button>
                </div>
              </div>

            </div>

          </form>
        </div>
        <div class="col-md-2"></div>
      </div>
    </div>

</section>

</body>
</html>