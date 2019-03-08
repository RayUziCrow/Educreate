<?php
session_start();
$sqlStatus = "";

$selectedQ = -1;
if(isset($_POST['selectedQ'])) { // chk if submitted
  $selectedQ = $_POST['selectedQ'];
}
if(isset($_SESSION['formSubmit'])) {
  if($_SESSION['formSubmit'] == "fail") {
    $sqlStatus = $_SESSION['sqlStatus'];
  }
  session_unset();
}

// init db
$conn = new mysqli('localhost', 'root', '', 'educreate');
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// dummy data (online)
// $selectedQ = 1;

$sql = "SELECT * FROM qualification WHERE qualificationID = '$selectedQ' LIMIT 1"; // gen load q query

// execute query
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data to var
  $foundQ = $result->fetch_assoc();
} else {

}

// dummy data (offline)
// $foundQ = array("qualificationID" => 1, "qualificationName" => "DummyQ", "minimumScore" => 0, "maximumScore" => 100, "resultCalcDescription" => "avg_highest", "resultCalcSubjectCount" => 3);

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
        <p class="text-lighten">Edit an existing Qualification by modifying the details below.</p>
      </div>
    </div>
  </div>
</section>
<!-- /page title -->

<!-- Qualification Form -->
<section class="section bg-gray">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h2 class="section-title">Edit Qualification<span id="qualificationTitle"></span></h2>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6 mb-4 mb-lg-0">
        <form action="editQualification_formsubmit.php" method="post" onsubmit="chkScoreChanged()">
          <input type="hidden" id="qualificationID" name="qualificationID">
          <input required type="text" class="form-control mb-3" id="qualificationName" name="qualificationName" placeholder="Qualification Name">
          <input required type="number" min="0" class="form-control mb-3" id="qualificationMinScore" name="qualificationMinScore" placeholder="Minimum Score">
          <input required type="number" min="0" class="form-control mb-3" id="qualificationMaxScore" name="qualificationMaxScore" placeholder="Maximum Score">
          <input type="hidden" id="scoreChanged" name="scoreChanged" value="false">
          <p>Score Calculation:
            <select class="nav-link" id="qualificationResultCalc" name="qualificationResultCalc">
              <option value="avg_highest">Average of Highest Scores</option>
              <option value="avg_lowest">Average of Lowest Scores</option>
              <option value="sum_highest">Total of Highest Scores</option>
              <option value="sum_lowest">Total of Lowest Scores</option>
            </select>
          </p>
          <p>Number of Subjects Calculated: <input required type='number' min='1' class='mb-3 nav-link' id='subjectCount' name='subjectCount' placeholder='eg: 1, 2, 3'></p>
          <div>
            <button type="submit" class="btn btn-primary">SAVE</button>
            <button type="reset" class="btn btn-primary">RESET</button>
          </div>
        </form>
      </div>
      <div class="col-lg-6">
        <div>
          <?php echo $sqlStatus ?>
        </div>
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

    <!-- Main Script -->
    <script src="js/script.js"></script>

    <!-- EX Script -->
    <script>
    var foundQ = <?php echo json_encode($foundQ) ?>;
    window.onload = loadQualification();

    function loadQualification() {
      // get form fields
      var qTitle = document.getElementById("qualificationTitle");
      var qID = document.getElementById("qualificationID");
      var qName = document.getElementById("qualificationName");
      var qMinScore = document.getElementById("qualificationMinScore");
      var qMaxScore = document.getElementById("qualificationMaxScore");
      var qResultCalc = document.getElementById("qualificationResultCalc");
      var qSubjectCount = document.getElementById("subjectCount");

      // fill fields
      qTitle.innerHTML = ": " + foundQ.qualificationName;
      qID.value = foundQ.qualificationID;
      qName.value = foundQ.qualificationName;
      qMinScore.value = foundQ.minimumScore;
      qMaxScore.value = foundQ.maximumScore;
      qResultCalc.value = foundQ.resultCalcDescription;
      qSubjectCount.value = foundQ.resultCalcSubjectCount;
    }

    function chkScoreChanged() {
      // get score fields
      var qMinScore = document.getElementById("qualificationMinScore");
      var qMaxScore = document.getElementById("qualificationMaxScore");

      var scoreChanged = document.getElementById("scoreChanged");
      if(qMinScore.value != foundQ.minimumScore || qMaxScore != foundQ.maximumScore) {
        scoreChanged.value = "true";
      }
    }
    </script>

  </body>
  </html>
