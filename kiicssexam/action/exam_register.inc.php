<?php

  include 'dbh.inc.php';
  // include "datetime.inc.php";

  if(!isset($_SESSION)){
      session_start();
  }

  $sub_id = $_SESSION['sub_id'];

  if (!isset($sub_id)){
    $message="Session Expired. Please <a href=\"index.php\">Login</a> Again";
  }


  if (isset($_POST['submit'])) {
	$name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $gender = $_POST['gender'];
    $blood_group = $_POST['blood_group'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $university = $_POST['university'];
    $college = $_POST['college'];
    $cgpa = $_POST['cgpa'];
    $passout = $_POST['passout'];

    if (empty($name) || empty($email) || empty($contact) || empty($gender) || empty($blood_group) || empty($dob) || empty($address) || empty($university) || empty($college) || empty($cgpa) || empty($passout)) {
      // echo "Empty Fields";
      header("Location: ../exam_register.php?field=empty");
      exit();
    } else{
      // echo "Check Data to Register";

    $name_array = explode(" ", $name);
    // print_r($name_array);
    // echo "<br>";
    foreach ($name_array as $name_value) {         //Validate first, middle and last name
        if (!preg_match( '/^[A-Za-z]+$/' , $name_value)) {        //Validate Name# code...
            // echo "Name not valid";
            header("Location: ../exam_register.php?name=invalid");
            exit();  
        }
    }
    // if (preg_match( '/^[A-Za-z]+$/' , $name)) {        //Validate Name
    	$name = filter_var($name, FILTER_SANITIZE_STRING);    // Sanitize the name variable
      // echo $name;
    	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {  //Validate Email
    	  $email = filter_var($email, FILTER_SANITIZE_EMAIL);    // Sanitize the email variable
    	  if (preg_match('/^[0-9]*$/', $contact) && (strlen($contact) == 10)) {    //Validate Contact no and its length
    	    if (($gender == "Male") || $gender == "Female") {      //Validate Gender
    	      if (($blood_group == "A+") || ($blood_group == "A-") || ($blood_group == "B+") || ($blood_group == "B-") || ($blood_group == "AB+") || ($blood_group == "AB-") || ($blood_group == "O+") || ($blood_group == "O-")) {        //Validate Blood Group

                $today = date("d-m-Y");
                $start_date = date_format(date_create("01-01-1985"), "d-m-Y");

                $date_check = date("d-m-Y", strtotime("-18 year"));   //Date exactly 18 years ago
                // echo $date_check;
                  if (($dob < $date_check) && ($dob > $start_date)) {        //validate Date entered
                      if ((preg_match("/^[A-Za-z]+[A-Za-z0-9]*$/", $address))) {        //Validate Address
                          if (preg_match("/^[A-Za-z]+$/", $university)) {        //Validate University Name
                              $university = filter_var($university, FILTER_SANITIZE_STRING);
                              if (preg_match("/^[A-Za-z]+$/", $college)) {        //Validate College Name
                                  $university = filter_var($university, FILTER_SANITIZE_STRING);
                                  if ((filter_var($cgpa, FILTER_VALIDATE_FLOAT)) && ($cgpa <= 10.0) && ($cgpa >= 0)) {       //Validate CGPA
                                    $this_year = date('Y');
                                    $pass_year = date_format(date_create("2000-03-15"), "Y");
                                      if (($passout <= $this_year) && ($passout >= $pass_year)) {     //Passout Year
                                         
                                         $insert = "INSERT INTO candidate_details (can_name, can_email, can_contact, can_gender, can_blood_group, can_DOB, can_address, can_university, can_college, can_cgpa, can_passout_year) VALUES ('$name','$email','$contact','$gender','$blood_group','$dob','$address','$university','$college','$cgpa','$passout')";

                                         // $select_questions = ""

                                         $insert_query = mysqli_query($conn, $insert);
                                         if ($insert_query) {

                                              $_SESSION['can_name'] = $name;
                                              $_SESSION['can_email'] = $email;

                                              $qno = 1;
                                      
                                              $_SESSION['qno'] = $qno;
                                              header("Location: ../exam_dashboard.php?registration=success");
                                              exit();
                                            } else {
                                              header("Location: ../exam_register.php?registration=failed");
                                              exit();
                                            }

                                      } else {
                                        // echo "Year not valid";
                                        header("Location: ../exam_register.php?passout_year=invalid");
                                        exit();                          
                                      }
                                  } else {
                                    // echo "CGPA not valid";
                                    header("Location: ../exam_register.php?cgpa=invalid");
                                    exit();                      
                                  }
                              } else {
                                // echo "College name not valid";
                                header("Location: ../exam_register.php?college_name=invalid");
                                exit();                  
                              }
                          } else {
                            // echo "University name not valid";
                            header("Location: ../exam_register.php?university_name=invalid");
                            exit();              
                          }
                      } else {
                        // echo "Date not valid";
                        header("Location: ../exam_register.php?address=invalid");
                        exit();          
                      }
                  } else {
                    // echo "Date not valid";
                    header("Location: ../exam_register.php?date=invalid");
                    exit();      
                  }
              } else {
                // echo "Blood Group not valid";
                header("Location: ../exam_register.php?blood_group=invalid");
                exit();  
              }
    	    } else {
    	      // echo "Gender not valid";
    	      header("Location: ../exam_register.php?gender=invalid");
    	      exit();
    	    }
    	  } else {
    	    // echo "Contact Number not valid";
    	    header("Location: ../exam_register.php?contact_no=invalid");
    	    exit();
    	  }
    	} else {
    	  // echo "Email not valid";
    	  header("Location: ../exam_register.php?email=invalid");
    	  exit();  
    	}

 //      } else {
	// // echo "Name not valid";
	// header("Location: ../exam_register.php?name=invalid");
	// exit();
 //      }

    }
	
  } else {
	header("Location: ../exam_register.php?registration=failed");
	exit();
  }
?>