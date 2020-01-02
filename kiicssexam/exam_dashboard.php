<?php
  
  if(!isset($_SESSION)){
      session_start();
  }
  include 'action/dbh.inc.php';
  // include_once 'action/exam_submit.inc.php';

  include_once 'action/recent_activity.inc.php';
  
  if (!isset($_SESSION['qno']) || !isset($_SESSION['no_of_questions']) || !isset($_SESSION['exam_start']) || !isset($_SESSION['time_limit'])) {
    echo "<h1 style='text-align: center;'>Exam has ended. User need not return here</h1>";
    header("Location: exam_finish.php");
    exit();
  }

  $can_id = $_SESSION['can_id'];
  // $can_id = 1;
  $can_name = $_SESSION['can_id'];
  $can_email = $_SESSION['can_email'];
  $qno = $_SESSION['qno'];
  $row = $_SESSION['row'];

  $exam_start_time = $_SESSION['exam_start_time'];    //Session variable storing exam start timestamp
  $exam_start_time = date("Y-m-d H:i:s", $exam_start_time);

  if (isset($_SESSION['ans'])) {
    $ans = $_SESSION['ans'];
  } else {
    $ans = "";
  }


  if (!isset($can_id)){
    // $message="Session Expired. Please <a href=\"index.php\">Login</a> Again";
    header("Location: error.php?login=required");
    exit();
  } elseif (!isset($can_name)) {
    // $message="Session Expired. Please <a href=\"index.php\">Login</a> Again";
    header("Location: error.php?login=required");
    exit();
  } elseif (!isset($can_email)) {
    // $message="Session Expired. Please <a href=\"index.php\">Login</a> Again";
    header("Location: error.php?login=required");
    exit();
  } else {

    // $num = mysqli_query($conn, "SELECT question_nos FROM login WHERE can_id='$can_id'");
    // $number = mysqli_fetch_assoc($num);
    
    // $fetch = "SELECT * FROM questions WHERE status_given=1 AND qno='$qno'";

    // $fetchanswer = "SELECT * FROM answers";

    // $fetch_query = mysqli_query($conn, $fetch);

    // if ($row = mysqli_fetch_assoc($fetch_query)) {

    //   $date = date("M d, Y h:m:s");
      
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

      <script src="package/dist/sweetalert2.js"></script>
      <link rel="stylesheet" href="package/dist/sweetalert2.min.css">

      <link href="https://fonts.googleapis.com/css?family=Uncial+Antiqua" rel="stylesheet">

      <link href="https://fonts.googleapis.com/css?family=PT+Serif" rel="stylesheet">

      <?php
        if (isset($_COOKIE['timer'])) {
          $count = $_COOKIE['timer'];
        } else {
          $count = $_SESSION['time_limit'];
          // $count = 60;
        }
      ?>

      <script type="text/javascript">
        var count = <?php echo $count; ?>;
        var counter = setInterval(timer, 1000); //1000 will  run it every 1 second

        function timer() {
            count = count - 1;

            document.cookie = "timer = " + count;
            if (count == -1) {
                clearInterval(counter);
                return;
            }
            if (count == 0) 
            {
              swal("Exam Completed",'You have successfully completed your exam','success');
              setTimeout(function () {
                             window.location = 'exam_finish.php';
                         }, 3000);
            }

            var seconds = count % 60;
            var minutes = Math.floor(count / 60);
            var hours = Math.floor(minutes / 60);
            minutes %= 60;
            hours %= 60;
            var sec_length = seconds.toString().length;
            var min_length = minutes.toString().length;
            var hrs_length = hours.toString().length;
            // alert(ss);

            if (sec_length == 1) {        //Append zero to one digit seconds value
              seconds = "0"+seconds.toString();
            }
            if (min_length == 1) {        //Append zero to one digit minutes value
              minutes = "0"+minutes.toString();
            }
            if (hrs_length == 1) {        //Append zero to one digit hours value
              hours = "0"+hours.toString();
            }

            document.getElementById("hour").innerHTML = hours;
            document.getElementById("min").innerHTML = minutes;
            document.getElementById("sec").innerHTML = seconds;
        }
      </script>

      <style type="text/css">
        body {
          /*background: linear-gradient(rgba(10,10,10,0.8), rgba(10,10,10,0.7)),  url('assets/images/back.jpg');*/
          background: linear-gradient(rgba(10,10,200,0.4), rgba(10,100,200,0.7));
          background-image: url('assets/images/back.jpg');
        }
        .opt li{
          list-style-type: none;
          display: inline;
        }
      </style>

    </head>
    <body style="padding: 20px;">

      <section>
          <?php //echo $_SERVER['HTTP_REFERER']; ?>
          <div class="container" style=" margin-top: 20px; margin-bottom: 50px; border-radius: 15px 5px 15px 5px; box-shadow: 10px 5px rgba(0,0,0,0.2); border: 2px solid rgba(0,0,0,0.1); background-color: white;">
            
            <div class="container">
              <div class="row">
                <div class="col-md-12">
                  <div class="container">
                    <div class="row">
                      <!-- <div class="col-md-12" style="border: 2px solid grey; border-radius: 20px;"> -->
                      <div class="col-md-12">
                        <h1 class="text-center">Questions</h1>
                        <?php

                        ?>
                        <p id="demo"></p>
                      </div>
                    </div>
                    <?php //print_r($row[1]); ?>
                    <?php //echo $row[1]['question']; ?>
                    <div class="row" style="padding-top: 20px; padding-bottom: 40px;font-family: 'PT Serif', serif;">     <!-- Row STARTS -->
                      <!-- <div class="col-md-1"></div> -->
                      <div class="col-md-8">
                        <!-- Form starts -->
                        <form action="action/exam_submit.inc.php" method="POST">
                          <div style="border: 2px solid grey; min-height: 200px; padding: 10px; border-radius: 10px;">
                            <div class="container">
                              
                            <div class="row">
                              <div class="col-md-1">
                                <input type="text" name="qno" readonly value="<?php echo $qno.'.'; ?>" style="width: 30px; border-color: transparent; background-color: transparent;">
                                <input type="hidden" name="qid" value="<?php echo $row[$qno]['id']; ?>">
                                <?php
                                  $visited = array();
                                  if (!isset($_SESSION['visited_questions'])) {
                                    // $visited = array();
                                    $visited[$qno] = "visited";
                                    $_SESSION['visited_questions'] = $visited;    //Set array for keeping record of visited questions
                                  } else {
                                    $visited = $_SESSION['visited_questions'];
                                    $visited[$qno] = "visited";
                                    $_SESSION['visited_questions'] = $visited;
                                  }
                                  
                                ?>
                                <input type="hidden" name="question" readonly value="<?php echo $row[$qno]['question']; ?>" style="width: 80%; height: 100%; border-color: transparent; background-color: transparent;">
                                <?php
                                  // echo $exam_start;
                                  // echo date("d-m-Y h:i:s", $exam_start);
                                  // echo "<br>";
                                  $now = time();
                                  // echo date("d-m-Y h:i:s", $now);
                                ?>
                              </div>
                              <div class="col-md-10">
                                <p><?php echo $row[$qno]['question']; ?></p>
                              </div>
                            </div>
                            </div>
                          </div>
                          
                          <div style="border: 2px solid grey; min-height: 80px; padding: 10px; margin-top: 10px; border-radius: 10px;">
                              <div class="container">
                                <div class="row">
                                  <div class="col-md-6 form-inline" style="display: table;">
                                    <?php 
                                      $ans = "SELECT * FROM answers WHERE can_id='$can_id' AND qno='$qno' AND dates>='$exam_start_time'";
                                      $ans_query = mysqli_query($conn, $ans);
                                      $answered = mysqli_fetch_assoc($ans_query);
                                      // var_dump($answered);
                                      // echo $answered['answers_given'];
                                      $answered['answers_given'];
                                    ?>
                                    <input type="radio" name="option" id="option1" value="A" style="display: table-cell;" 
                                    <?php
                                      if ($answered['answers_given'] == "A") {
                                        echo "checked";
                                      }
                                    ?>
                                    >
                                    <label for="option1" style="display: table-cell; width: 1px; padding: 5px;">A.</label>
                                    <label for="option1" style="display: table-cell; width: 100%;"><?php echo $row[$qno]['optionA']; ?></label>
                                  </div>
                                  <div class="col-md-6 form-inline" style="display: table;">
                                    <input type="radio" name="option" id="option2" value="B" style="display: table-cell;"
                                    <?php
                                      if ($answered['answers_given'] == "B") {
                                        echo "checked";
                                      }
                                    ?>
                                    >
                                    <label for="option2" style="display: table-cell; width: 1px; padding: 5px;">B.</label>
                                    <label for="option2" style="display: table-cell; width: 100%;"><?php echo $row[$qno]['optionB']; ?></label>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-6 form-inline" style="display: table;">
                                    <input type="radio" name="option" id="option3" value="C" style="display: table-cell;"
                                    <?php
                                      if ($answered['answers_given'] == "C") {
                                        echo "checked";
                                      }
                                    ?>
                                    >
                                    <label for="option3" style="display: table-cell; width: 1px; padding: 5px;">C.</label>
                                    <label for="option3" style="display: table-cell; width: 100%;"><?php echo $row[$qno]['optionC']; ?></label>
                                  </div>
                                  <div class="col-md-6 form-inline" style="display: table;">
                                    <input type="radio" name="option" id="option4" value="D" style="display: table-cell;"
                                    <?php
                                      if ($answered['answers_given'] == "D") {
                                        echo "checked";
                                      }
                                    ?>
                                    >
                                    <label for="option4" style="display: table-cell; width: 1px; padding: 5px;">D.</label>
                                    <label for="option4" style="display: table-cell; width: 100%;"><?php echo $row[$qno]['optionD']; ?></label>
                                  </div>
                                </div>
                              </div>
                            </div>

                          <div style="border: 2px solid grey; min-height: 50px; padding: 10px; margin-top: 10px; border-radius: 10px;">
                            <?php

                              if (!isset($_SESSION['marked_questions'])) {
                                $marked_questions = array();
                                $_SESSION['marked_questions'] = $marked_questions;
                              } else {
                                $marked_questions = $_SESSION['marked_questions'];
                                // print_r($marked_questions);
                              }

                              if ($qno == $_SESSION['no_of_questions']) {
                            ?>
                              <button class="btn btn-success" name="submit">Save & Submit</button>
                              <button class="btn btn-info" name="marked">Save and Mark</button>
                            <?php
                              } else {
                            ?>
                              <button class="btn btn-warning" name="skip">Skip</button>
                              <button class="btn btn-success" name="submit">Save and Next</button>
                              <button class="btn btn-info" name="marked">Save and Mark</button>
                            <?php
                              }
                            ?>
                          </div>
                        </form>
                      </div>
                      
                      <div class="col-md-4">
                        
                        <div class="container" style="border: 2px solid grey; border-radius: 10px;">   <!-- Container STARTS -->
                          
                          <div class="row">
                            <div class="text-center" style="margin: 5px; border-radius: 5px; min-height: 30px;width: 100%; font-family: 'PT Serif', serif;">
                              <div style="padding: 5px; border: 2px solid lightgray; border-radius: 10px;">
                                <span style="padding-left: 5px; padding-right: 5px; border: 2px solid lightgray; border-radius: 5px;"><font id="hour"></font></span>hr
                                <font class="text-center">:</font>
                                <span style="padding-left: 5px; padding-right: 5px; border: 2px solid lightgray; border-radius: 5px;"><font id="min"></font></span>min
                                <font class="text-center">:</font>
                                <span style="padding-left: 5px; padding-right: 5px; border: 2px solid lightgray; border-radius: 5px;"><font id="sec"></font></span>seconds
                              </div>
                            </div>
                          </div>
                          
                          <div class="row">
                            <div style="font-family: 'Uncial Antiqua', cursive; border: 2px solid lightgray; border-radius: 10px; margin: 5px; height: 200px; padding: 2px; text-align: center;">
                              
                                <?php

                                  $visited_questions = $_SESSION['visited_questions']; 
                                  // echo $number['question_nos'];    //Total Question Numbers
                                  for($i = 1; $i <= $_SESSION['no_of_questions']; $i++) {
                                ?>
                                    <form action="action/exam_submit.inc.php" method="POST" style="display: inline; z-index: -2;">
                                      <?php
                                          // if (isset($_COOKIE['timer'])) {
                                          // echo $_SESSION['time_limit'];
                                          // echo $count;   //Cookie time
                                        // }
                                        //$qno_values = "NA";   //Default value for question numbers attemped id not attempted
                                        $fetch_answers = "SELECT answers_given,dates FROM answers WHERE can_id='$can_id' AND qno='$i' AND dates>='$exam_start_time'";
                                        // echo $fetch_answers;
                                        // print_r($conn);
                                        $fetch_answers_query = mysqli_query($conn, $fetch_answers);
                                        if ($data = mysqli_fetch_assoc($fetch_answers_query)) {
                                          ?>
                                            <?php
                                                if (!empty($data['answers_given'])) {
                                                  if (isset($marked_questions[$i]) && $marked_questions[$i] == "marked") {
                                                    ?>
                                                      <input type="hidden" name="q_num" value="<?php echo $i; ?>" style="border: transparent; background-color: transparent;">
                                                      <button class="text-center btn" name="num" style="height: 40px; width: 40px; border-radius: 50%; background-color: skyblue; border: 1px solid grey; margin: 2px;">
                                                          <span style="color: lightgreen; text-shadow: 1px 1px black; -webkit-text-stroke: 1px black; text-stroke: 1px black; font-size: 20px; position: absolute; z-index: 1; line-height: 2px; padding-left: 10px;"><b>&#10004;</b></span>
                                                          <?php echo $i; ?>
                                                          
                                                        </button>
                                                    <?php
                                                  } else {
                                                    ?>
                                                      <input type="hidden" name="q_num" value="<?php echo $i; ?>" style="border: transparent; background-color: transparent;">
                                                      <button class="text-center btn" name="num" style="height: 40px; width: 40px; border-radius: 50%; background-color: lime; border: 1px solid grey; margin: 2px;"><?php echo $i; ?></button>
                                                    <?php
                                                  }
                                                } else {
                                                  ?>
                                                    <input type="hidden" name="q_num" value="<?php echo $i; ?>" style="border: transparent; background-color: transparent;">
                                                    <button class="text-center btn" name="num" style="height: 40px; width: 40px; border-radius: 50%; background-color: orange; border: 1px solid grey;"><?php echo $i; ?></button>
                                                  <?php
                                                }
                                            ?>
                                          <?php
                                        } elseif (isset($marked_questions[$i]) && $marked_questions[$i] == "marked") {
                                           // echo "For visited questions";
                                        ?>
                                            <input type="hidden" name="q_num" value="<?php echo $i; ?>" style="border: transparent; background-color: transparent;">
                                            <button class="text-center btn" name="num" style="height: 40px; width: 40px; border-radius: 50%; background-color: skyblue; border: 1px solid grey; margin: 2px;"><?php echo $i; ?></button>
                                        <?php
                                        } elseif (isset($visited_questions[$i]) && $visited_questions[$i] == "visited") {
                                           // echo "For visited questions";
                                        ?>
                                            <input type="hidden" name="q_num" value="<?php echo $i; ?>" style="border: transparent; background-color: transparent;">
                                            <button class="text-center btn" name="num" style="height: 40px; width: 40px; border-radius: 50%; background-color: yellow; border: 1px solid grey; margin: 2px;"><?php echo $i; ?></button>
                                        <?php
                                        } else {
                                          ?>
                                            <input type="hidden" name="q_num" value="<?php echo $i; ?>" style="border: transparent; background-color: transparent;">
                                            <button class="text-center btn" name="num" style="height: 40px; width: 40px; border-radius: 50%; border: 1px solid white; background-color: rgb(200,200,200); margin: 2px;"><?php echo $i; ?></button>
                                          <?php
                                        }
                                      ?>
                                    </form>
                                    <!-- <button>Hello</button> -->
                                <?php
                                  }
                                ?>

                            </div>
                          </div>
                        </div>    <!-- Container ENDS -->

                        <div class="text-center" style="height: 175px; border: 2px solid grey; border-radius: 10px; margin-top: 10px;">
                          <br>
                          <form action="action/exam_submit.inc.php" method="POST">
                            <button class="btn text-center" name="exit">Exit Exam</button>
                          </form>
                        </div>

                      </div>
                    </div>      <!-- Row end -->
                  
                  </div>
                </div>
              </div>
            </div>

          </div>

        </section>

    </body>
    </html>

<?php 
  // }
}
?>