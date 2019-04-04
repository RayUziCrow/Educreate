<?php // Save New Qualification
  $sqlStatus = "";

  // get form fields
  $qID = $_POST['qualificationID'];
  $subjectBoxString = $_POST['qualificationGrades'];
  $username = $_POST['username'];

  if(empty($subjectBoxString)) {
    $url = 'apphome.php';
    header('Location: ' . $url);
    die();
  }
  else {
    processGrades();
  }

  function processGrades() {
    global $qID, $subjectBoxString, $username;
    // split Grades
    $obResults = explode(',', $subjectBoxString);

    // split Names & Upper Limits
    $gNames = [];
    $gUpperLimits = [];
    $subjectID = [];
    for($i = 0; $i < sizeof($obResults); $i++) {
      // $splitPos = strpos($obResults[$i], ':');
      // $subjectID[] = substr($obResults[$i], ':');
      // $gNames[] = substr($obResults[$i], 0, $splitPos);
      // $gUpperLimits[] = substr($obResults[$i], $splitPos + 1);
      $boom[] = explode($obResults[$i]);
      $subjectID[] = $boom[0];
      $gNames[] = $boom[1];
      $gUpperLimits[] = $boom[2];
    }

    // init db
    $conn = new mysqli('localhost', 'root', '', 'educreate');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // remove old, replace with new
    session_start(); // init store session var

    // gen delete query
    // $sql = "DELETE FROM gradelist WHERE qualificationID = '$qID'";

    // // execute delete query
    // if ($conn->query($sql) === TRUE) {
    //     $sqlStatus = "Grades deleted successfully";
    // } else {
    //     $sqlStatus = "Error: " . $sql . "<br>" . $conn->error;
    //     $_SESSION['formSubmit'] = 'fail';
    //     $selectedQ = $qID;
    //     $_SESSION['selectedQ'] = $selectedQ;
    // }
    // gen save query
    

    $sql = "INSERT INTO result (`subjectID`, `obtainedQualificationID`, `score`) VALUES ";
    for($i = 0; $i < sizeof($obResults); $i++) {
      if($i == sizeof($obResults) - 1) {
        $sql = $sql . "('$subjectID', '$gNames[$i]', '$gUpperLimits[$i]')";
      }
      else {
        $sql = $sql . "('$subjectID', '$gNames[$i]', '$gUpperLimits[$i]'), ";
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
      $url = 'apphome.php';
    }
    else {
      $url = 'subjectList.php';
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
  //   for($i = 0; $i < sizeof($obResults); $i++) {
  //     if($i == sizeof($obResults) - 1) {
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
