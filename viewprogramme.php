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

// get User info
$sql = "SELECT * FROM user WHERE Username = '$username' LIMIT 1";

$result = $conn->query($sql); // execute query

if ($result->num_rows > 0) {
  // gen getApplications query

  $sql = "SELECT * FROM programme, university WHERE programme.universityID = university.universityID";
  // $sql = "SELECT universityName, programmeName, date, status FROM application, programme, university WHERE applicant = 'soniasulyn92' AND programme.programmeID = application.programmeID AND programme.universityID = university.UniversityID";

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
            <li class="nav-item">
            
              <a class="nav-link" href="uploadqualification.php">Set Up Obtained Qualifications</a>
          
           
          
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

          <form name="login" class="form-horizontal" role="form"
          method="post" action="">
          <div class="col-12">
            <input type="text" class="form-control mb-3" id="Username" name="Username" placeholder="Username">
          </div>
          <div class="col-12">
            <input type="password" class="form-control mb-3" id="password" name="password" placeholder="Password">
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
        <form name="login" class="form-horizontal" role="form"
        method="post" action="">
        <div class="col-12">
          <input type="text" class="form-control mb-3" name="username" placeholder="Username">
        </div>
        <div class="col-12">
          <input type="password" class="form-control mb-3" name="password" placeholder="Password">
        </div>
        <div class="col-12">
          <input type="submit" class="btn btn-primary">LOGIN</button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>


<!-- hero slider -->
<section class="hero-section overlay bg-cover" data-background="images/banner/banner-1.jpg">
  <div class="container">
    <div class="list-group" id="progListMenu">
      <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-70 justify-content-between">
          <h5 class="mb-1">Bachelor's Degree In Finance</h5>
          <small>3 days ago</small>
        </div>
        <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
        <small>Donec id elit non mi porta.</small>
      </a>
      <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-70 justify-content-between">
          <h5 class="mb-1">Diploma In Business Studies</h5>
          <small class="mb-1">3 days ago</small>

        </div>
        <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
        <small class="mb-1">Donec id elit non mi porta.</small>
      </a>
      <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-70 justify-content-between">
          <h5 class="mb-1">Degree In Psychology</h5>
          <small class="mb-1">3 days ago</small>
        </div>
        <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
        <small class="mb-1">Donec id elit non mi porta.</small>
      </a>
      <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-70 justify-content-between">
          <h5 class="mb-1">Degree In Psychology</h5>
          <small class="mb-1">3 days ago</small>
        </div>
        <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
        <small class="mb-1">Donec id elit non mi porta.</small>
      </a>
      <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-70 justify-content-between">
          <h5 class="mb-1">Degree In Psychology</h5>
          <small class="mb-1">3 days ago</small>
        </div>
        <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
        <small class="mb-1">Donec id elit non mi porta.</small>
      </a>
    </div>
    <form id="appform" action="confirmApplication.php" method="post">
      <input type="hidden" id="programmeID" name="programmeID" value="">
    </form>

  </div>
  <!-- slider item -->

  <!-- slider item -->

</section>
<!-- /hero slider -->

<!-- banner-feature -->

<!-- /banner-feature -->

<!-- about us -->

<!-- /about us -->

<!-- courses -->

<!-- course list -->

<!-- course item -->

<!-- /cta -->

<!-- success story -->

<!-- /success story -->

<!-- events -->

<!-- location -->

<!-- event -->

<!-- location -->

<!-- event -->

<!-- location -->

<!-- mobile see all button -->

<!-- /events -->

<!-- teachers -->

<!-- teacher -->

<!-- teacher -->


<!-- teacher -->

<!-- /teachers -->

<!-- blog -->

<!-- blog post -->

<!-- post meta -->

<!-- post date -->

<!-- author -->

<!-- blog post -->

<!-- blog post -->

<!-- /blog -->

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
        <script>
    var sqlStatus = "<?php echo $sqlStatus ?>";
    if(sqlStatus != "") {
      alert(sqlStatus);
    }

    var progList = <?php echo json_encode($currentApplications) ?>;
    window.onload = loadProgrammes();
    var chosenprog;

    function chooseProgramme(pid) {
    
    var chosenProgform = document.getElementById("appform");
    var chosenProg = document.getElementById("programmeID");
    chosenProg.value = pid;
    chosenProgform.submit();

    }




    function loadProgrammes() {
      var progListMenu = document.getElementById("progListMenu");


      if(progList.length != 0) {
        for(var i = 0; i < progList.length; i++) {
          // gen Programme list item
          var progItem = document.createElement("a");

          var progItemDiv = document.createElement("div");
          var progItemH5 = document.createElement("h5");
          var progItemSpanUpper = document.createElement("BUTTON");
          
          var progItemP = document.createElement("p");
          var progItemBr = document.createElement("br");
          var progItemSpanLower = document.createElement("span");
          

          var txtnodeProgName = document.createTextNode(progList[i].name);
          var txtnodeUniName = document.createTextNode("University: " + progList[i].UniversityName);
          var txtnodeStatus = document.createTextNode("Status: " + progList[i].status);

          

          if (progList[i].UniversityName != '') {
          var txtnodeAppliedDate = document.createTextNode("Apply Now");
          }
          else { 
          var txtnodeAppliedDate = document.createTextNode("Something");
          }

          progItemH5.appendChild(txtnodeProgName);
          progItemSpanUpper.appendChild(txtnodeAppliedDate);
          progItemP.appendChild(txtnodeUniName);
          progItemSpanLower.appendChild(txtnodeStatus);


          progItem.setAttribute("class", "list-group-item list-group-item-action flex-column align-items-start");
          progItemDiv.setAttribute("class", "d-flex w-70 justify-content-between");
          progItemH5.setAttribute("class", "mb-1");
          progItemP.setAttribute("class", "mb-1");
          progItemSpanUpper.setAttribute("onclick", "chooseProgramme("+ progList[i].programmeID +")");




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
