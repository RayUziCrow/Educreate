<?php
// include("auth.php");
session_start();

// dummydata
// $_SESSION['username'] = "eva_00";
// $_SESSION['name'] = "Ayanami Rei";

$username = $_SESSION['username'];
$name = $_SESSION['name'];

$sqlStatusLoad = "";

// init db
$conn = new mysqli('localhost', 'root', '', 'educreate');
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM obtQualification WHERE Username = '$username'"; // gen chkObtQ query

$result = $conn->query($sql); // execute query
if ($result->num_rows > 0) { // obtainedQ found
  $hasObtQ = "yes";
}
else { // obtainedQ not found
  $hasObtQ = "no";
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
  $sqlStatusLoad = $count . " Qualification(s) available.";
} else {
  $sqlStatusLoad = "No Qualifications available. We're sorry for the inconvenience.";
}

$conn->close(); // close db
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="utf-8">
  <title>Educreate: New Obtained Qualification</title>

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

            <ul class="list-inline d-inline">
              <li class="list-inline-item"><a class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block" href="#"><?php echo $username ?></a></li>
              <li class="list-inline-item"><a class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block" href="#"><?php echo $name ?></a></li>
            </ul>
          </div>
          <div class="col-lg-8 text-center text-lg-right">
            <ul class="list-inline">

              <li class="list-inline-item"><a class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block" href="logout.php">Logout</a></li>

            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- navbar -->
    <div class="navigation w-100">
      <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light p-0">
          <a class="navbar-brand" href="apphome.php"><img src="images/logo.png" alt="logo"></a>
          <button class="navbar-toggler rounded-0" type="button" data-toggle="collapse" data-target="#navigation"
          aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navigation">
          <ul class="navbar-nav ml-auto text-center">
            <li class="nav-item">
              <a class="nav-link" href="obtainedQualification.php" id="manageObtQLink">PENGUIN_ERROR</a>
            </li>
            <li class="nav-item @@about">
              <a class="nav-link" href="about.html">About</a>
            </li>
            <li class="nav-item @@courses">
              <a class="nav-link" href="courses.html">COURSES</a>
            </li>
            <li class="nav-item @@events">
              <a class="nav-link" href="events.html">EVENTS</a>
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
          <li class="list-inline-item"><span class="h2 text-primary font-secondary">New Qualification</span></li>
          <li class="list-inline-item text-white h3 font-secondary @@nasted"></li>
        </ul>
        <p class="text-lighten">Create a new Qualification by entering the details below.</p>
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
        <h2 class="section-title" id="formtitle">Submit Obtained Qualification</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6 mb-4 mb-lg-0">
        <form action="resultList.php" method="post">
          <p>
            Qualification Type
            <select class="nav-link" id="qSelectMenu" name="selectedQ">
              <!--Qualifications Go Here-->
            </select>
          </p>
          <div>
            <button type="submit" class="btn btn-primary">CONFIRM</button>
          </div>
        </form>
      </div>
      <div class="col-lg-6">
        <div>
          <p><?php echo $sqlStatusLoad ?></p>
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
          <a class="logo-footer" href="index.php"><img class="img-fluid mb-4" src="images/logo.png" alt="logo"></a>
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

    var hasObtQ = "<?php echo $hasObtQ ?>"; // get php value
    var manageObtQLink = document.getElementById("manageObtQLink");

    if (hasObtQ == "yes") {
      manageObtQLink.innerHTML = "Preview Your Qualification";
    } else {
      manageObtQLink.innerHTML = "Set Up Obtained Qualifications";
    }

    var qArray = <?php echo json_encode($qArray) ?>; // send php_array to js
    window.onload = showLoadedQualifications();
    // window.onload = editExistingQ();
    // function editExistingQ() {

    //   if (obtfound == 1)


    //     var formtitle = document.getElementById("formtitle");
    //     formtitle.innerHTML = "You have a qualification";

    // }




    function showLoadedQualifications() {

      var qSelectMenu = document.getElementById("qSelectMenu");

      if (qArray.length != 0) {
        for(var i = 0; i < qArray.length; i++) {
          // gen qualification list item
          var qItem = document.createElement("option");
          var textnode = document.createTextNode(qArray[i].qualificationName);
          qItem.appendChild(textnode);
          qItem.setAttribute("class", "dropdown-item");
          qItem.value = qArray[i].qualificationID;
          // qItem.setAttribute("onclick", "showCurrentEdit(" + qArray[i].qualificationID + ")");

          // attach qItem to list
          qSelectMenu.appendChild(qItem);
        }
      }
    }

    // function showCurrentEdit(qNum) {
    //   var selectedQForm = document.getElementById("selectedQForm");
    //   var selectedQ = document.getElementById("selectedQ");

    //   selectedQ.value = qNum;
    //   selectedQForm.submit(); // goto details
    // }

    // function saveQualification() {
    //   var qName = document.getElementById("qualificationName");
    //   var qMinScore = document.getElementById("qualificationMinScore");
    //   var qMaxScore = document.getElementById("qualificationMaxScore");
    //   var qResultCalc = document.getElementById("qualificationResultCalc");
    //   var qSubjectCount = document.getElementById("subjectCount");
    //
    //
    // }
    </script>

  </body>
  </html>
