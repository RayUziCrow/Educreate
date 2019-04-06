<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="utf-8">
  <title>Educreate: Register</title>

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
<?php session_start(); ?>


<!-- header -->
<header class="fixed-top header">
  <!-- top header -->
  <div class="top-header py-2 bg-white">
    <div class="container">
      <div class="row no-gutters">
        <div class="col-lg-4 text-center text-lg-left">
          <ul class="list-inline d-inline">
            <li class="list-inline-item mx-0"><a class="d-inline-block p-2 text-color" href="#">Not Logged In</a></li>
          </ul>
        </div>
        <div class="col-lg-8 text-center text-lg-right">
          <ul class="list-inline">

            <li class="list-inline-item"><a class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block" href="register.php">signup</a></li>
            <li class="list-inline-item"><a class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block" href="#">login</a></li>

          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- navbar -->
  <div class="navigation w-100">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light p-0">
        <a class="navbar-brand" href="index.php"><img src="images/logo.png" alt="logo"></a>
        <button class="navbar-toggler rounded-0" type="button" data-toggle="collapse" data-target="#navigation"
          aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navigation">
          <ul class="navbar-nav ml-auto text-center">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home</a>
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
            <li class="nav-item @@contact">
              <a class="nav-link" href="contact.html">CONTACT</a>
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
          <li class="list-inline-item"><span class="h2 text-primary font-secondary">Sign up</span></li>
          <li class="list-inline-item text-white h3 font-secondary @@nasted"></li>
        </ul>
        <p class="text-lighten">Sign up and start applying for Programmes.</p>
      </div>
    </div>
  </div>
</section>
<!-- /page title -->

<!-- php -->

<?php
require('Connections/Myconnection.php');

// If form submitted, insert values into the database.
if (isset($_REQUEST['Username'])){
        // removes backslashes
    $username = stripslashes($_REQUEST['Username']);
        //escapes special characters in a string
    $username = mysqli_real_escape_string($con,$username);
    $password = stripslashes($_REQUEST['Password']);
    $password = mysqli_real_escape_string($con,$password);
    $name = stripslashes($_REQUEST['Name']);
    $name = mysqli_real_escape_string($con,$name);
    $email = stripslashes($_REQUEST['Email']);
    $email = mysqli_real_escape_string($con,$email);
    $idtype = stripslashes($_REQUEST['IDType']);
    $idtype = mysqli_real_escape_string($con,$idtype);
    $idnumber = stripslashes($_REQUEST['IDNumber']);
    $idnumber = mysqli_real_escape_string($con,$idnumber);
    $mobileno = stripslashes($_REQUEST['MobileNo']);
    $mobileno = mysqli_real_escape_string($con,$mobileno);
    $dateofbirth = stripslashes($_REQUEST['DateOfBirth']);
    $dateofbirth = mysqli_real_escape_string($con,$dateofbirth);


    //Insert parameters into User table.
        $query = "INSERT into `user` (Username, Password, Name, Email)
        VALUES ('$username', '".md5($password)."', '$name', '$email')";


        $result = mysqli_query($con,$query);
        if($result === TRUE){
            //If input data type equals true, insert parameters into Applicant table
        $query1 = "INSERT into `applicant` (Username, IDType, IDNumber, MobileNo, DateOfBirth) VALUES ('$username', '$idtype', '$idnumber',
          '$mobileno' , '$dateofbirth')";
        $result = mysqli_query($con,$query1);

        $_SESSION['username'] = $username;
        $_SESSION['name'] = $name;

        ?>
        <script type="text/javascript">
window.location="apphome.php";
</script>
<?php
}else{
?> <div class='container'>
<h3>Registration Failed</h3>
<br/>Click here to <a href='register.php'>Retry</as></div>
<?php  }}else{
?>

<!-- php -->

<!-- contact -->
<section class="section bg-gray">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h2 class="section-title">Sign up</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-7 mb-4 mb-lg-0">
        <form name="registerapplicant" class="form-horizontal" role="form"
        method="post" action="" onsubmit="return check()">
            <div class="col-12">
                <input type="text" class="form-control mb-3" id="Username" name="Username" placeholder="Username" onblur="">

                <br/>
            </div>
            <div class="col-12">
                <input type="password" class="form-control mb-3" id="Password"  name="Password" placeholder="Password" onblur="">
                <span id="errorpass"> </span>
                <br/>
            </div>
            <div class="col-12">
                <input type="password" class="form-control mb-3" id="ConfirmPassword"  name="ConfirmPassword" placeholder="Confirm Password" onblur="">
            </div>
            <div class="col-12">
                <input type="text" class="form-control mb-3" id="FullName"  name="Name" placeholder="Name">
            </div>
            <div class="col-12">
                <input type="email" class="form-control mb-3" id="Email"  name="Email" placeholder="Email">
            </div>
            <div class="col-12">
                <input type="text" class="form-control mb-3" id="MobileNo"  name="MobileNo" placeholder="Phone">
            </div>
            <div class="col-12">
              <p>Date of Birth:</p>
                <input type="date" class="form-control mb-3" id="DateOfBirth" name="DateOfBirth" placeholder="Date Of Birth">
            </div>
            <div class="col-12">
              <p>ID Type :
              <select name="IDType" id="IDType">
                <option value="">select IDtype</option>
                <option value="MYKAD">Mykad</option>
                <option value="PASSPORT">Passport</option>
              </select></p>
            </div>

            <div class="col-12">
                <input type="text" class="form-control mb-3" id="IDNumber"  name="IDNumber" placeholder="ID Number">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">SIGN UP</button>
            </div>
        </form>
      </div>
      <div class="col-lg-5">
        <p class="mb-5"><span id="errorname"></span></br></br><p class="mb-5"><span id="errorpassword"></span></p>
      </br></br><p class="mb-5"><span id="errorconfirmpass"></span></p>
      </div>
    </div>
  </div>
</section>
<?php } ?>
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

<!-- javascript -->
<script>

   function check()
   {
     var uname = document.getElementById('Username').value.trim();
     var pword = document.getElementById('Password').value.trim();
     var matchingpword = document.getElementById('ConfirmPassword').value.trim();
     var fname = document.getElementById('FullName').value.trim();
     var email = document.getElementById('Email').value.trim();
     var dob = document.getElementById('DateOfBirth').value.trim();
     var idtype = document.getElementById('IDType').value.trim();
     var idnum = document.getElementById('IDNumber').value.trim();

        if(uname == "")
        {
           //document.getElementById('errorname').innerHTML="invalid Username";
           alert("Please enter a valid username");
           return false;
        }
        if(pword ==null || pword =="")
        {
          //document.getElementById('errorpassword').innerHTML="invalid password";
          alert("Please enter a valid password");
          return false;
        }
        if(pword.length < 8)
        {
          alert("Password invalid. Please enter more than 8 characters");
          return false;
        }
        if(matchingpword != pword)
        {
          //document.getElementById('errorconfirmpass').innerHTML="passwords do not match";
          alert("Passwords do not match");
          return false;
        }
        if(fname == "")
        {
           alert("Please enter a full name");
           return false;
        }
        if(email == "")
        {
           alert("Your email is required");
           return false;
        }
        if(dob == null)
        {
          alert("Please enter your date of birth")
          return false;
        }
        if(idtype == "")
        {
          alert("Please select ID type")
          return false;
        }
        if(idnum == "")
        {
          alert("Please enter ID number");
          return false;
        }
        else
        {
          //alert("Registration successful");
          return true;
        }
   }
 </script>



<!-- /javascript -->

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



</body>
</html>
