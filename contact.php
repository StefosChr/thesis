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
    <title>Contact us</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  </head>
  <body onload="status()">
    
  <?php require_once('header.php'); ?>

	<section class="ftco-section bg-light">
		<div class="col-md-12 ftco-animate text-center mb-5">
		    <h1 style="margin-top:70px;" class="mb-3 bread"></h1>
		</div>
	</section> 
	<section class="ftco-section pt-0 pb-0 bg-light">
      	<div class="container">
	        <div class="row">
	          <div style="flex: 0 0 100%; max-width: 100%" class="col-md-12 col-lg-8 bg-white">
			    <div class="container">
			        <div class="row no-gutters slider-text align-items-end justify-content-start">
			          <div class="col-md-12 bg-light mt-2 mb-2 text-center">
			            <h1 class="mb-3 mt-3 bread">Contact us</h1>
			          </div>
			        </div>
			    </div>
	          </div>
          	</div>


        </div>
    </section>
    
<section class="ftco-section bg-light pt-2">
      <div class="container">
        <div class="row">
          <div style="flex: 0 0 100%; max-width: 100%" class="col-md-12 col-lg-8 mb-5 bg-white">
          
			     <form id="post-register-form" action="contactscript.php" method="post" class="p-3 bg-white" enctype="multipart/form-data">
              <div class="row form-group">
                <div class="col-md-12 mb-3">
                  <label class="font-weight-bold" for="job_title"><h3>Your Email</h3></label>
                  <input type="text" id="email" class="form-control" name="email" placeholder="someone@comp.com" required>
                </div>
              </div>
			  
              <div class="row form-group">
                <div class="col-md-12"><h3>Your Message</h3></div>
                <div class="col-md-12 mb-3">
                  <textarea name="comment" class="form-control" id="comment" cols="30" rows="5" required></textarea>
                </div>
              </div>
      
              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" value="Send" class="btn btn-primary  py-2 px-5">
                </div>
              </div>
			  
            </form>
          </div>

          
          </div>
        </div>
    </section>
<script>
    function status(){

      var url_string = window.location.href;
      var url = new URL(url_string);
      var status = url.searchParams.get("status");

      if(status=='Success'){

        Swal.fire({
            icon: 'success',
            title:"Your message has been sent successfully!",
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
            title:"Unable to send your message. Connection is corrupted!",
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

      }else if(status=='PostVariable'){
        Swal.fire({
            icon: 'error',
            title:"Some Post Variable is unsetted for some reason!",
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



	<?php require_once('footer.php');?>
	
  </body>
</html>

