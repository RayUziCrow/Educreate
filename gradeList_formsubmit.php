<?php // Save New Qualification
  $sqlStatus = "";

  // get form fields
  $qID = $_POST['qualificationID'];
  $qGradesString = $_POST['qualificationGrades'];

  if(empty($qGradesString)) {
    $url = 'masterDashboard.php';
    header('Location: ' . $url);
    die();
  }
  else {
    processGrades();
  }

  function processGrades() {
    global $qID, $qGradesString;

    // split Grades
    $qGrades = explode(',', $qGradesString);

    // split Names & Upper Limits
    $gNames = [];
    $gUpperLimits = [];
    for($i = 0; $i < sizeof($qGrades); $i++) {
      $splitPos = strpos($qGrades[$i], ':');
      $gNames[] = substr($qGrades[$i], 0, $splitPos);
      $gUpperLimits[] = substr($qGrades[$i], $splitPos + 1);
    }

    // init db
    $conn = new mysqli('localhost', 'root', '', 'educreate');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // remove old, replace with new
    session_start(); // init store session var

    // gen delete query
    $sql = "DELETE FROM gradelist WHERE qualificationID = '$qID'";

    // execute delete query
    if ($conn->query($sql) === TRUE) {
        $sqlStatus = "Grades deleted successfully";
    } else {
        $sqlStatus = "Error: " . $sql . "<br>" . $conn->error;
        $_SESSION['formSubmit'] = 'fail';
        $selectedQ = $qID;
        $_SESSION['selectedQ'] = $selectedQ;
    }
    // gen save query
    $sql = "INSERT INTO gradelist (`qualificationID`, `grade`, `scoreUpperLimit`) VALUES ";
    for($i = 0; $i < sizeof($qGrades); $i++) {
      if($i == sizeof($qGrades) - 1) {
        $sql = $sql . "('$qID', '$gNames[$i]', '$gUpperLimits[$i]')";
      }
      else {
        $sql = $sql . "('$qID', '$gNames[$i]', '$gUpperLimits[$i]'), ";
      }
    }

    // execute save query
    if ($conn->query($sql) === TRUE) {
        $sqlStatus = "Grades created successfully";
        $_SESSION['formSubmit'] = 'success';
    } else {
        $sqlStatus = "Error: " . $sql . "<br>" . $conn->error;
        $_SESSION['formSubmit'] = 'fail';
        $selectedQ = $qID;
        $_SESSION['selectedQ'] = $selectedQ;
    }

    $conn->close(); // close db

    $_SESSION['sqlStatus'] = $sqlStatus; // store msg

    if($_SESSION['formSubmit'] == 'success') {
      // redirect to form
      $url = 'masterDashboard.php';
    }
    else {
      $url = 'gradeList.php';
    }
    header('Location: ' . $url);
    die();
  }

  // function deleteOldGrades() {
  //   // gen delete query
  //   $sql = "DELETE FROM gradelist WHERE qualificationID = '$qID'";
  //
  //   // execute delete query
  //   if ($conn->query($sql) === TRUE) {
  //       $sqlStatus = "Grades deleted successfully";
  //   } else {
  //       $sqlStatus = "Error: " . $sql . "<br>" . $conn->error;
  //       $_SESSION['formSubmit'] = 'fail';
  //       $selectedQ = $qID;
  //       $_SESSION['selectedQ'] = $selectedQ;
  //   }
  // }
  //
  // function saveGrades() {
  //   // gen save query
  //   $sql = "INSERT INTO gradelist (`qualificationID`, `grade`, `scoreUpperLimit`) VALUES ";
  //   for($i = 0; $i < sizeof($qGrades); $i++) {
  //     if($i == sizeof($qGrades) - 1) {
  //       $sql = $sql . "('$qID[$i]', '$gNames[$i]', '$gUpperLimits[$i]')";
  //     }
  //     else {
  //       $sql = $sql . "('$qID[$i]', '$gNames[$i]', '$gUpperLimits[$i]'), ";
  //     }
  //   }
  //
  //   // execute save query
  //   if ($conn->query($sql) === TRUE) {
  //       $sqlStatus = "Grades created successfully";
  //       $_SESSION['formSubmit'] = 'success';
  //   } else {
  //       $sqlStatus = "Error: " . $sql . "<br>" . $conn->error;
  //       $_SESSION['formSubmit'] = 'fail';
  //       $selectedQ = $qID;
  //       $_SESSION['selectedQ'] = $selectedQ;
  //   }
  // }
?>
