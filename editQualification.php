<?php // Save Edited Qualification
  // $sqlStatusSave = "";
  //
  // if(isset($_POST['formSubmit'])) { // chk if submitted
  //   // get form fields
  //   $qID = $_POST['qualificationID'];
  //   $qName = $_POST['qualificationName'];
  //   $qMinScore = $_POST['qualificationMinScore'];
  //   $qMaxScore = $_POST['qualificationMaxScore'];
  //   $qResultCalc = $_POST['qualificationResultCalc'];
  //   $qSubjectCount = $_POST['subjectCount'];
  //
  //   // init db
  //   $conn = new mysqli('localhost', 'root', '', 'educreate');
  //   if ($conn->connect_error) {
  //       die("Connection failed: " . $conn->connect_error);
  //   }
  //
  //   // gen update query
  //   $sql = "UPDATE qualification SET qualificationName = '$qName', minimumScore = '$qMinScore', maximumScore = '$qMaxScore', resultCalcDescription = '$qResultCalc', resultCalcSubjectCount = '$qSubjectCount', gradeList = '$qGrades' WHERE qualificationID = '$qID'";
  //
  //   // execute query
  //   if ($conn->query($sql) === TRUE) {
  //       $sqlStatusSave = "Qualification saved successfully";
  //   } else {
  //       $sqlStatusSave = "Error: " . $sql . "<br>" . $conn->error;
  //   }
  //
  //   $conn->close(); // close db
  //   unset($_POST['formSubmit']); // unset 'submitted'
  // }
?>

<?php // Load Qualifications
  $sqlStatusLoad = "";

  // init db
  $conn = new mysqli('localhost', 'root', '', 'educreate');
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $sql = "SELECT * FROM qualification"; // gen load query

  // execute query
  $result = $conn->query($sql);

  $qArray = array();
  $count = 0;
  if ($result->num_rows > 0) {
    // output data to array
    while($row = $result->fetch_assoc()) {
        $qArray[$count] = $row;
        $count++;
    }
    $sqlStatusLoad = $count . " Qualification(s) found.";
  } else {
      $sqlStatusLoad = "No Qualifications found.";
  }

  $conn->close(); // close db
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="utf-8">
  <title>Educreate: Edit Qualification</title>

  <!-- mobile responsive meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <!-- ** Plugins Needed for the Project ** -->
  <!-- Bootstrap -->
  <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css">
  <!-- slick slider -->
  <link rel="stylesheet" href="plugins/slick/slick.css">
  <!-- themefy-icon -->
  <link rel="stylesheet" href="plugins/themify-icons/themify-icons.css">
  <!-- animation css -->
  <link rel="stylesheet" href="plugins/animate/animate.css">
  <!-- aos -->
  <link rel="stylesheet" href="plugins/aos/aos.css">
  <!-- venobox popup -->
  <link rel="stylesheet" href="plugins/venobox/venobox.css">

  <!-- Main Stylesheet -->
  <link href="css/style.css" rel="stylesheet">

  <!--Favicon-->
  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
  <link rel="icon" href="images/favicon.ico" type="image/x-icon">

  <!--EX Styles-->
  <style>
  .noresize {
    resize: none;
  }
  </style>

</head>

<body>


  <!-- header -->
  <header class="fixed-top header">
    <!-- top header -->
    <div class="top-header py-2 bg-white">
      <div class="container">
        <div class="row no-gutters">
          <div class="col-lg-4 text-center text-lg-left">
            <span class="text-color mr-3"><strong>MASTER ADMIN</strong></span>

          </div>
          <div class="col-lg-8 text-center text-lg-right">

          </div>
        </div>
      </div>
    </div>
    <!-- navbar -->
    <div class="navigation w-100">
      <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light p-0">
          <a class="navbar-brand" href="index.html"><img src="images/logo.png" alt="logo"></a>
          <button class="navbar-toggler rounded-0" type="button" data-toggle="collapse" data-target="#navigation"
          aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navigation">
          <ul class="navbar-nav ml-auto text-center">
            <li class="nav-item @@home">
              <a class="nav-link" href="index.html">Home</a>
            </li>
            <li class="nav-item @@home">
              <a class="nav-link" href="masterDashboard.php">MASTER DASHBOARD</a>
            </li>
            <li class="nav-item dropdown view active">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              Qualifications
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="newQualification.html">New Qualification</a>
              <a class="dropdown-item" href="editQualification.php">Edit Qualification</a>
            </div>
          </li>
          <li class="nav-item @@contact">
            <a class="nav-link" href="registerUni.html">REGISTER UNIVERSITY</a>
          </li>
        </ul>
      </div>
    </nav>
  </div>
</div>
</header>
<!-- /header -->
<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content rounded-0 border-0 p-4">
      <div class="modal-header border-0">
        <h3>Register</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="login">
          <form action="#" class="row">
            <div class="col-12">
              <input type="text" class="form-control mb-3" id="signupPhone" name="signupPhone" placeholder="Phone">
            </div>
            <div class="col-12">
              <input type="text" class="form-control mb-3" id="signupName" name="signupName" placeholder="Name">
            </div>
            <div class="col-12">
              <input type="email" class="form-control mb-3" id="signupEmail" name="signupEmail" placeholder="Email">
            </div>
            <div class="col-12">
              <input type="password" class="form-control mb-3" id="signupPassword" name="signupPassword" placeholder="Password">
            </div>
            <div class="col-12">
              <button type="submit" class="btn btn-primary">SIGN UP</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content rounded-0 border-0 p-4">
      <div class="modal-header border-0">
        <h3>Login</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="#" class="row">
          <div class="col-12">
            <input type="text" class="form-control mb-3" id="loginPhone" name="loginPhone" placeholder="Phone">
          </div>
          <div class="col-12">
            <input type="text" class="form-control mb-3" id="loginName" name="loginName" placeholder="Name">
          </div>
          <div class="col-12">
            <input type="password" class="form-control mb-3" id="loginPassword" name="loginPassword" placeholder="Password">
          </div>
          <div class="col-12">
            <button type="submit" class="btn btn-primary">LOGIN</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- page title -->
<section class="page-title-section overlay" data-background="images/backgrounds/page-title.jpg">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <ul class="list-inline custom-breadcrumb">
          <li class="list-inline-item"><span class="h2 text-primary font-secondary">Edit Qualification</span></li>
          <li class="list-inline-item text-white h3 font-secondary @@nasted"></li>
        </ul>
        <p class="text-lighten">Edit an existing Qualification by selecting one and modifying its details.</p>
      </div>
    </div>
  </div>
</section>
<!-- /page title -->

<!-- Qualification Select -->
<section class="section bg-gray">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h2 class="section-title">Edit Qualification</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6 mb-4 mb-lg-0">
        <p class="mb-5">Edit an exist Qualification by selecting one from the list below.</p>
        <div class="dropdown view">
          <button class="nav-link dropdown-toggle" href="#" id="selectDropdown" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          Select Qualification
        </button>
        <div class="dropdown-menu" aria-labelledby="selectDropdown" id="qSelectMenu">

        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <form id="selectedQForm" action="editQualification_details.php" method="post">
        <div>
          <input type="hidden" id="selectedQ" name="selectedQ">
        </div>
      </form>
      <p><?php echo $sqlStatusLoad ?></p>
    </div>
  </div>
</div>
</section>
<!-- /contact -->

<!-- footer -->
<footer>

  <!-- footer content -->
  <div class="footer bg-footer section border-bottom">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-sm-8 mb-5 mb-lg-0">
          <!-- logo -->
          <a class="logo-footer" href="index.html"><img class="img-fluid mb-4" src="images/logo.png" alt="logo"></a>
          <ul class="list-unstyled">
            <li class="mb-2">No. 15, Jalan Sri Semantan 1, Off Jalan Semantan, Bukit Damansara 50490 Kuala Lumpur</li>
            <li class="mb-2">Ridge Hon Fay (B1600595) <a href="mailto:rayuzicrow@gmail.com">rayuzicrow@gmail.com</a></li>
            <li class="mb-2">Muhamad Muqriz (B1800732) <a href="mailto:muqrizx@gmail.com">muqrizx@gmail.com<a/></li>
            </ul>
          </div>

        </div>
      </div>
    </div>
    <!-- copyright -->
    <div class="copyright py-4 bg-footer">
      <div class="container">
        <div class="row">
          <div class="col-sm-7 text-sm-left text-center">
            <p class="mb-0">Copyright
              <script>
              var CurrentYear = new Date().getFullYear()
              document.write(CurrentYear)
              </script>
              © Theme By <a href="https://themefisher.com">themefisher.com</a></p> . All Rights Reserved.
            </div>
            <div class="col-sm-5 text-sm-right text-center">
              <ul class="list-inline">
                <li class="list-inline-item"><a class="d-inline-block p-2" href="https://www.facebook.com/themefisher"><i class="ti-facebook text-primary"></i></a></li>
                <li class="list-inline-item"><a class="d-inline-block p-2" href="https://www.twitter.com/themefisher"><i class="ti-twitter-alt text-primary"></i></a></li>
                <li class="list-inline-item"><a class="d-inline-block p-2" href="#"><i class="ti-instagram text-primary"></i></a></li>
                <li class="list-inline-item"><a class="d-inline-block p-2" href="https://dribbble.com/themefisher"><i class="ti-dribbble text-primary"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- /footer -->

    <!-- jQuery -->
    <script src="plugins/jQuery/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="plugins/bootstrap/bootstrap.min.js"></script>
    <!-- slick slider -->
    <script src="plugins/slick/slick.min.js"></script>
    <!-- aos -->
    <script src="plugins/aos/aos.js"></script>
    <!-- venobox popup -->
    <script src="plugins/venobox/venobox.min.js"></script>
    <!-- mixitup filter -->
    <script src="plugins/mixitup/mixitup.min.js"></script>
    <!-- google map -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU&libraries=places"></script>
    <script src="plugins/google-map/gmap.js"></script>

    <!-- Main Script -->
    <script src="js/script.js"></script>

    <!-- EX Script -->
    <script>
    var qArray = <?php echo json_encode($qArray) ?>; // send php_array to js
    window.onload = showLoadedQualifications();

    function showLoadedQualifications() {

      var qSelectMenu = document.getElementById("qSelectMenu");

      if (qArray.length != 0) {
        for(var i = 0; i < qArray.length; i++) {
          // gen qualification list item
          var qItem = document.createElement("a");
          var textnode = document.createTextNode(qArray[i].qualificationID + " - " + qArray[i].qualificationName);
          qItem.appendChild(textnode);
          qItem.setAttribute("class", "dropdown-item");
          qItem.setAttribute("onclick", "showCurrentEdit(" + qArray[i].qualificationID + ")");

          // attach qItem to list
          qSelectMenu.appendChild(qItem);
        }
      }
    }

    function showCurrentEdit(qNum) {
      var selectedQForm = document.getElementById("selectedQForm");
      var selectedQ = document.getElementById("selectedQ");

      selectedQ.value = qNum;
      selectedQForm.submit(); // goto details
    }
  </script>
</body>
</html>
