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

$loggedin = false;
if(isset($_SESSION["loggedin"])&&($_SESSION["loggedin"])=='1') {
  $loggedin = true;
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>All Theses</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  </head>
  <body>
    
  <?php require_once('header.php'); ?>

	<section class="ftco-section bg-light">
		<div class="col-md-12 ftco-animate text-center mb-5">
		    <h1 style="margin-top:70px;" class="mb-3 bread"></h1>
		</div>
	</section> 
	<section class="ftco-section pt-0 pb-0 bg-light">
      	<div class="container">
	        <div class="row">
	          <div style="flex: 0 0 100%; max-width: 100%" class="col-md-12 col-lg-8 bg-white border border-5 border-light">
			    <div class="container">
			        <div class="row no-gutters slider-text align-items-end justify-content-start">
			          <div class="col-md-12 bg-light mt-2 mb-2 text-center">
			            <h1 class="mb-3 mt-3 bread">All Theses</h1>
			          </div>
			        </div>
			    </div>
	          </div>
          	</div>

          	
      		<?php if(!$loggedin) { ?>
      		<div class="row mt-2">
	      		<div class="col-md-12 bg-light text-center">
			    	<div class="alert alert-secondary" role="alert">
					  <div class="text-danger h5 mb-0">You need to login to apply a Thesis</div>
					</div>
				</div>
			</div>
			<?php } ?>
          	

          	<div class="row mb-5">
	          	<?php

	          		$sql="SELECT `tID`,`supervisor`, `title`, `subject`, `deadline` FROM `thesis` WHERE deadline >= CURDATE() ORDER BY thesis.date_created";

					if ($result=mysqli_query($connection,$sql)) {
					    $rowcount=mysqli_num_rows($result);
					    if($rowcount > 0) {
							while ($row=mysqli_fetch_row($result)) {
								echo'<div id="thesis' . $row[0] . '" class="bg-white col-md-6 border border-5 border-light">
				                        <div class="p-3 d-block m-0">
				                            <div class="d-block">
				                            	<label>Supervisor:</label><h4>'. $row[1] .  '</h4>
				                      			<label>Deadline:</label><h4>'. $row[4] .  '</h4>
				                      			<label>Title:</label><h4 class="mb-4">'. $row[2] .'</h4>
				                            </div>
				                            <div class="d-block">
				                              <a href="thesissingle.php?tid=' . $row[0] . '" class="btn btn-primary py-2">View details</a>
				                            </div>
				                        </div>
					        		</div>';
							}

					    } else {
					    	echo '<div class="col-md-12 mt-3 mb-3 bg-white pt-2 pb-2">No thesis found</div>';
					    }
					} else {
						  echo '<div class="col-md-12 mt-3 mb-3 bg-white pt-2 pb-2">There was an error.</div>';
						}
  				?>
	        </div>

        </div>
    </section>
 

<?php require_once('footer.php');?>
	
  </body>
</html>

