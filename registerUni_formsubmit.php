<?php // Save New University
  $sqlStatus = "";

  // get form fields
  $uName = $_POST['uniName'];
  $uaUsername = $_POST['uniAdmin_username'];
  $uaPassword = $_POST['uniAdmin_password'];
  $uaName = $_POST['uniAdmin_name'];
  $uaEmail = $_POST['uniAdmin_email'];

  // init db
  $conn = new mysqli('localhost', 'root', '', 'educreate');
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  // gen save UniAdmin query
  $uaPassword_encrypted = md5($uaPassword);
  $sql = "INSERT INTO user (`Username`, `Password`, `Name`, `Email`) VALUES ('$uaUsername', '$uaPassword_encrypted', '$uaName', '$uaEmail')";

  // execute query
  if ($conn->query($sql) === TRUE) {
      $sqlStatus = "New UniAdmin registered successfully";

      // gen save Uni query
      $sql = "INSERT INTO university (`universityName`, `universityAdmin`) VALUES ('$uName', (SELECT `username` FROM user WHERE `username` = '$uaUsername'))";

      // execute query
      if ($conn->query($sql) === TRUE) {
          $sqlStatus = "New University registered successfully";
      } else {
          $sqlStatus = "Error: " . $sql . "<br>" . $conn->error;
      }
  } else {
      $sqlStatus = "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close(); // close db

  session_start();
  $_SESSION['formSubmit'] = 'sent'; // notify form is sent
  $_SESSION['sqlStatus'] = $sqlStatus; // store msg

  // redirect to form
  $url = 'registerUni.php';
  header('Location: ' . $url);
  die();
?>
