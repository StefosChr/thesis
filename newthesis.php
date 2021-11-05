<?php

session_start();
require_once('thesisdb.php');

$uID = 0;
if (isset($_SESSION["uID"]) and $_SESSION["uID"] > 0) {
  $uID = $_SESSION["uID"];
} else {
  Header('Location: index.php');    
}

$level = 0;
if(isset($_SESSION["level"])&&($_SESSION["level"])=='1') {
  $level = 1;
} else {
  Header('Location: index.php');    
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Create New Thesis</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  </head>
  <body onload="status()">
	
	<?php
  require('header.php');      
?>

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
              <div class="row align-items-end justify-content-start">
                <div class="col-md-12 bg-light mt-2 mb-2 text-center">
                  <h1 class="mb-3 mt-3 bread">Post a Thesis</h1>
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
          
			     <form id="post-register-form" action="thesisscript.php" method="post" class="p-3 bg-white" enctype="multipart/form-data">
              <div class="row form-group">
                <div class="col-md-12 mb-3">
                  <label class="font-weight-bold" for="job_title"><h3>Thesis Title</h3></label>
                  <input type="text" id="title" class="form-control" name="title" placeholder="eg. Website Designer" required>
                </div>
              </div>
			  
              <div class="row form-group">
                <div class="col-md-12"><h3>Description</h3></div>
                <div class="col-md-12 mb-3">
                  <textarea name="description" class="form-control" id="description" cols="30" rows="5" required></textarea>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12 mb-3">
                  <label class="font-weight-bold" for="job_title"><h3>Supervisor</h3></label>
                  <input type="text" id="supervisor" class="form-control" name="supervisor" placeholder="" required>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12 mb-3">
                  <label class="font-weight-bold" for="job_title"><h3>Subject</h3></label>
                  <input type="text" id="subject" class="form-control" name="subject" placeholder="" required>
                </div>
              </div>

        			<div class="row form-group">
        			 <div class="col-md-12 mb-3"><h3>Deadline:</h3>
        				<label for="deadline"></label>
        				<input type="date" id="deadline" name="deadline" required>
        				</div>
        			</div>
      
              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" value="Post" class="btn btn-primary  py-2 px-5">
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
            title:"Thesis have been added successfully!",
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
            title:"Unable to add the Thesis. Connection is corrupted!",
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

