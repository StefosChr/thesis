
<?php 
if(session_id() == ''){
  session_start();
}

$level = 0;
if(isset($_SESSION["level"])&&($_SESSION["level"])=='1') {
  $level = 1;
}

$loggedin = false;
if(isset($_SESSION["loggedin"])&&($_SESSION["loggedin"])=='1') {
  $loggedin = true;
}

?>

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href="assets/img/favicon.png" rel="icon">
<link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

<!-- Vendor CSS Files -->
<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<link href="assets/vendor/aos/aos.css" rel="stylesheet">
<link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
<link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
<link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

<!-- Template Main CSS File -->
<link href="assets/css/style.css" rel="stylesheet">
<!--end of fs css-->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<!-- =======================================================
  * Template Name: FlexStart - v1.1.1
  * Template URL: https://bootstrapmade.com/flexstart-bootstrap-startup-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
    
 <!-- ======= Header ======= -->
<header id="header" class="header fixed-top">
  <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
    <a href="index.php" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <h5 style="font-size:30px;font-weight: 700;letter-spacing: 1px;color: #012970;font-family: 'Nunito', sans-serif;margin-top: 11px;">NUP THESIS PORTAL</h5>
    </a>
    <nav id="navbar" class="navbar">
      <ul>
        <li><a class="nav-link scrollto" href="index.php">Home</a></li>
        <li><a class="nav-link scrollto" href="allthesis.php">All Theses</a></li>
         <?php
          if($loggedin) {
            if($level == '1'){
              echo ' <li><a class="nav-link scrollto" href="mythesis.php">Applications</a></li>
                <li class="nav-link"><a href="newthesis.php" class="nav-link">Add Thesis</a></li>
                <li class="nav-link"><a href="Promotion.php" class="nav-link">Users</a></li>
                <li class="nav-link"><a href="messages.php" class="nav-link">Messages</a></li>';
            } else {
              echo '<li><a class="nav-link scrollto" href="mythesis.php">My Theses</a></li>';
            }
          }
          if($level == '0'){
            echo '<li><a class="nav-link scrollto" href="contact.php">Contact us</a></li>';
          }
        ?>
        <?php 
          if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
            echo '<li><a type="button" class="btn btn-primary text-white" onclick="document.getElementById(\'modalLoginForm\').style.display=\'block\'">Login</a></li>';
          } else {
            echo '<li class="nav-item"><a class="btn btn-primary text-white" href="logout.php"> Log out </a></li>';   
          }
        ?>
      </ul>
      <i class="bi bi-list mobile-nav-toggle"></i>
    </nav><!-- .navbar -->
  </div>

  <?php if(!$loggedin) { ?>
  <!--Start of Login Form-->
  <form id="login-form" method="post" action="loginscript.php" >
    <div class="w3-modal" id="modalLoginForm" style="display:none">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header text-center">
            <h4 class="modal-title w-100 font-weight-bold layered">Sign in</h4>
          </div>
          <div class="modal-body">
            <div class="mb-2">
              <label data-error="wrong" data-success="right" for="defaultForm-email">Email</label>
              <input require type="input" id="defaultForm-email" name="email" placeholder="Enter your email" class="form-control validate" required>
            </div>
            <div class="md-form mb-2">
              <label data-error="wrong" data-success="right" for="defaultForm-password">Password</label>
              <input type="password" id="defaultForm-pass" name="password" placeholder="Enter your password" class="form-control validate" required>
            </div>
            <input class="btn btn-primary " type="submit" value="Submit"></input>
            <h5 class="mt-4">Not register yet?</h5>
            <input onclick="document.getElementById('modalLoginForm').style.display='none';document.getElementById('modalRegisterForm').style.display='block'" class="btn btn-primary mb-2" value="Register"></input>
          </div>
        </div>
      </div>
    </div>
  </form>
  <!--End of Login Form-->
  
  <!--Start of Register Form-->
  <form id="register-form" onclick="submit_form();" method="post" action="registerscript.php ">
    <div class="w3-modal" id="modalRegisterForm" style="display:none">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header text-center">
            <h4  class="modal-title w-100 font-weight-bold layered ">Register</h4>
          </div>
        <div class="modal-body">
          <div class="mb-2">
              <label data-error="wrong" data-success="right" for="defaultForm-name">Name</label>
              <input type="name" id="defaultForm-name" name="name" placeholder="Enter your name" class="form-control validate" required>
          </div>

          <div class="mb-2">
              <label data-error="wrong" data-success="right" for="defaultForm-surname">Surname</label>
              <input type="surname" id="defaultForm-surname" name="surname" placeholder="Enter your surname" class="form-control validate" required>
          </div>
        
          <div class="mb-2">
            <label data-error="wrong" data-success="right" for="defaultForm-email">Email</label>
            <input type="email" id="defaultForm-email" name="email" placeholder="Enter your email" class="form-control validate" required>
   
          </div>
        
          <div class="mb-2">
              <label data-error="wrong" data-success="right" for="defaultForm-password">Password</label>
              <input type="password" id="defaultForm-password" name="password" placeholder="Enter your password" class="form-control validate" required >  
            
          </div>
    
          <input class="btn btn-primary mb-2" type="submit" value="Submit"></input>
        </div>  

        </div>
      </div>
    </div>
  </form>
  <!--End of Register Form-->
  <?php } ?>
</header><!-- End Header -->