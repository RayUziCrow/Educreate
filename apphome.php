<?php
//include auth.php file on all secure pages
// include("auth.php");
session_start();

$sqlStatus = "";
if(isset($_SESSION['formSubmit'])) { // chk if submitted
  $sqlStatus = $_SESSION['sqlStatus'];
  unset($_SESSION['sqlStatus']);
}

$username = $_SESSION['username'];
$name = $_SESSION['name'];


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

// get User info
$sql = "SELECT * FROM user WHERE Username = '$username' LIMIT 1";

$result = $conn->query($sql); // execute query

if ($result->num_rows > 0) {
  // gen getApplications query

  $sql = "SELECT * FROM application, programme, university WHERE application.applicant = '$username' AND programme.programmeID = application.programmeID AND university.universityID = programme.universityID";
 

  $result = $conn->query($sql); // execute query

  if ($result->num_rows > 0) {
    $currentApplications = [];
    while($row = $result->fetch_assoc()) {

      $currentApplications[] = $row;
    }
  } else {
    $currentApplications = "";
  }

}

$conn->close();
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="utf-8">
  <title>Educreate: Applicant Profile</title>

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
            <li class="nav-item active">
              <a class="nav-link" href="apphome.php">APPLICANT DASHBOARD</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="manageObtQLink">Obtained Qualification</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="viewprogramme.php">Apply for Programme</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </div>
</header>
<!-- /header -->

<!-- page title -->
<section class="page-title-section overlay" data-background="images/backgrounds/page-title.jpg">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <ul class="list-inline custom-breadcrumb">
          <li class="list-inline-item"><span class="h2 text-primary font-secondary">Applicant Dashboard</span></li>
          <li class="list-inline-item text-white h3 font-secondary "></li>
        </ul>
        <p class="text-lighten"></p>
      </div>
    </div>
  </div>
</section>
<!-- /page title -->

<!-- courses -->
<section class="section">
  <div class="container">
    <!-- course list -->
<div class="row justify-content-center">
  <!-- course item -->
  <div class="col-lg-4 col-sm-6 mb-5">
    <div class="card p-0 border-primary rounded-0 hover-shadow">

      <div class="card-body">

        <a data-toggle="modal" data-target="#qualificationModal">
          <h4 class="card-title">Submit Obtained Qualification</h4>
        </a>
        <p class="card-text mb-4"> Submit your Obtained Qualification.</p>
        <a id="" onclick="checkexistobtQ('<?php echo $hasObtQ;?>')" class="btn btn-primary btn-sm">GO</a>
      </div>
    </div>
  </div>
  <!-- course item -->
  <div class="col-lg-4 col-sm-6 mb-5">
    <div class="card p-0 border-primary rounded-0 hover-shadow">

      <div class="card-body">

        <a href="registerUni.php">
          <h4 class="card-title">Apply for Programme</h4>
        </a>
        <p class="card-text mb-4"> Search and apply for a Programme.</p>
        <a href="viewprogramme.php" class="btn btn-primary btn-sm">GO</a>
      </div>
    </div>
  </div>

</div>
<!-- /course list -->
<div class="row justify-content-center">
  <div>
    <h2 class="section-title">Current Applications</h2>
  </div>
</div>
<div class="row justify-content-center">
  <div class="list-group" id="progListMenu">
    <a class="list-group-item list-group-item-action flex-column align-items-start">
      <div class="d-flex w-70 justify-content-between">
        <h5 class="mb-1">Bachelor's Degree In Finance</h5>
        <span>Date Applied: 12/7/2019</span>
      </div>
      <p class="mb-1">HELP University.</p>
      <br/>
      <span>Status: Pending</span>
    </a>
  </div>
</div>
    <!-- course list -->

  </div>
</section>

<!-- footer -->
<footer>
  <!-- newsletter -->

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
    var sqlStatus = "<?php echo $sqlStatus ?>";
    if(sqlStatus != "") {
      alert(sqlStatus);
    }

    var hasObtQ = "<?php echo $hasObtQ ?>"; // get php value
    var manageObtQLink = document.getElementById("manageObtQLink");

    if (hasObtQ == "yes") {
      manageObtQLink.innerHTML = "Preview Your Qualification";
      
      manageObtQLink.setAttribute("href", "obtQpreview.php");
    } else {
      manageObtQLink.innerHTML = "Set Up Obtained Qualifications";
    }

    var progList = <?php echo json_encode($currentApplications) ?>;
    window.onload = loadProgrammes();


    function checkexistobtQ(hasObtQ) {

      if (hasObtQ == "yes")
      {
        var overwrite = confirm("Do you want to overwrite your existing qualification? ");
        if (overwrite == true) 
        {
        window.location = "obtainedQualification.php";
        }
        else 
        {
        return false;
        }

      }
      else { 
        alert("okay");
              }


    }

    function loadProgrammes() {
      var progListMenu = document.getElementById("progListMenu");

      if(progList.length != 0) {
        for(var i = 0; i < progList.length; i++) {
          // gen Programme list item
          var progItem = document.createElement("a");

          var progItemDiv = document.createElement("div");
          var progItemH5 = document.createElement("h5");
          var progItemSpanUpper = document.createElement("span");
          var progItemP = document.createElement("p");
          var progItemBr = document.createElement("br");
          var progItemSpanLower = document.createElement("span");

          var txtnodeProgName = document.createTextNode(progList[i].name);
          var txtnodeUniName = document.createTextNode("University: " + progList[i].UniversityName);
          var txtnodeStatus = document.createTextNode("Status: " + progList[i].status);
          var txtnodeAppliedDate = document.createTextNode("Applied On: " + progList[i].date);

          progItemH5.appendChild(txtnodeProgName);
          progItemSpanUpper.appendChild(txtnodeAppliedDate);
          progItemP.appendChild(txtnodeUniName);
          progItemSpanLower.appendChild(txtnodeStatus);

          progItem.setAttribute("class", "list-group-item list-group-item-action flex-column align-items-start");
          progItemDiv.setAttribute("class", "d-flex w-70 justify-content-between");
          progItemH5.setAttribute("class", "mb-1");
          progItemP.setAttribute("class", "mb-1");

          progItemDiv.appendChild(progItemH5);
          progItemDiv.appendChild(progItemSpanUpper);

          progItem.appendChild(progItemDiv);
          progItem.appendChild(progItemP);
          progItem.appendChild(progItemBr);
          progItem.appendChild(progItemSpanLower);

          // attach progItem to list
          progListMenu.appendChild(progItem);
        }
      }
    }
    </script>

  </body>
  </html>
