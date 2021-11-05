<?php

session_start();
require_once('thesisdb.php');

$uID = 0;
if (isset($_SESSION["uID"]) and $_SESSION["uID"] > 0) {
  $uID = $_SESSION["uID"];
} 

$level = 0;
if(isset($_SESSION["level"])&&($_SESSION["level"])=='1') {
  $level = 1;
} 

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>NUP Thesis Portal</title>
  <style type="text/css">
    
    .row.equal {
    display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display:         flex;
  flex-wrap: wrap;
  }

  </style>
</head>

<body onload="status()">
<?php require_once('header.php') ?>
 
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center">
          <h1 data-aos="fade-up">Find your thesis that suits you!</h1>
          <h2 data-aos="fade-up" data-aos-delay="400">Our team of talented Lecturers n' Professors is here to help you</h2>
          <div data-aos="fade-up" data-aos-delay="600">
            <div class="text-center text-lg-start">
              <a href="#thesiswrapper" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                <span>Get Started</span>
                <i class="bi bi-arrow-down"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
          <img src="assets/img/hero-img.png" class="img-fluid" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

    <!-- ======= Recent Thesis (Values Section) ======= -->

      <section class="ftco-section bg-light" id="thesiswrapper" >
      <div class="container">
        <div class="row">
          <div class="col-lg-12 pr-lg-9">
            <div class="row justify-content-center">
              <div class="col-md-12 mb-4">
                <span class="subheading"></span>
                <h2>Recently Added Theses</h2>
              </div>
            </div>
        
         <div class="row">
         <?php
             

$sql="SELECT `tID`,`supervisor`, `title`, `subject`, `deadline` FROM `thesis` WHERE deadline >= CURDATE() ORDER BY thesis.date_created DESC LIMIT 4";


if ($result=mysqli_query($connection,$sql))
  {
    $rowcount=mysqli_num_rows($result);
    
    if($rowcount > 0) {
      // Fetch one and one row
      echo '<div class="card-group">';
      while ($row=mysqli_fetch_row($result)) {

        echo '
                              <div id="thesis' . $row[0] . '" class="card border border-2 border-light">
                                <div class="card-header bg-white border-0">
                                  <div class="mb-2"><label>Supervisor:<br />'. $row[1] .  '</label></div>
                                  <div><label>Deadline:<br />'. $row[4] .  '</label></div>
                                </div>
                                <div class="card-body">
                                   <label>Title:</label><h4>'. $row[2] .'</h4>
                                </div>
                                <div class="card-footer bg-white border-0">
                                    <a href="thesissingle.php?tid=' . $row[0] . '" class="btn btn-primary py-2">View details</a>
                                </div>
                              </div>
                            
             ';

    }
    echo '</div>';

    echo '<div class="d-lg-flex justify-content-center"><a href="allthesis.php" class="btn btn-primary btn-lg mt-5 mb-5 border border-light">View All Theses</a><div>';

  } else {
    echo '<div class="col-md-12 mt-3 mb-3 bg-white pt-2 pb-2">No thesis found</div>';
  }
  
} else {
  echo '<div class="col-md-12 mt-3 mb-3 bg-white pt-2 pb-2">There was an error.</div>';
}

?>
                  
<script>


</script>
            </div>
          </div>
        
          
    </section>

    <!-- End Values Section -->

    
  </main><!-- End #main -->
  <footer id="" class="footer">
    <div class="footer-newsletter">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-12 text-center">
            
            <h4>NEWSLETTER</h4>
            <p>Subscribe to our newsletter to receive updates regarding NUP.</p>

          </div>
          <div class="col-lg-6">
            <form action="subsciption.php" method="post" enctype="multipart/form-data">
              <input type="email" id="defaultForm-email" name="email" placeholder="Enter your email" class="form-control validate" required>
              <input type="submit" value="Subscribe">
            </form>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <script>
    function status(){

var url_string = window.location.href;
var url = new URL(url_string);
var status = url.searchParams.get("status");

      if(status=='Success'){

        Swal.fire({
            icon: 'success',
            title:"You subscribed successfully!",
            toast: true,
            position: 'top-end', 
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
            didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
           }

        })

      }else if(status=='Subscribed'){
        Swal.fire({
            icon: 'error',
            title:"You have already subscribed!",
            toast: true,
            position: 'top-end', 
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
            didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
           }

        })

      }else if(status=='Failed'){

        Swal.fire({
            icon: 'error',
            title:"Unable to subscribe. Connection is corrupted!",
            toast: true,
            position: 'top-end', 
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
            didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
           }

        })

      }else if(status=='Failed2'){
        Swal.fire({
            icon: 'error',
            title:"Something went wrong! Please contact an Admin.",
            toast: true,
            position: 'top-end', 
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
            didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
           }

        })

      }else{
     
      }

  }

</script>
  <?php
  require('footer.php');
  ?>

</body>

</html>