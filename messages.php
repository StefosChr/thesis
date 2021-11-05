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
    <title>Messages</title>
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
			            <h1 class="mb-3 mt-3 bread">Messages</h1>
			          </div>
			        </div>
			    </div>
	          </div>
          	</div>

          	<div class="row mb-5">
	          	<?php

	          		$sql="SELECT `conID`,`email`, `comment` FROM `contact` ORDER BY date_created DESC";

					if ($result=mysqli_query($connection,$sql)) {
					    $rowcount=mysqli_num_rows($result);
					    if($rowcount > 0) {
							while ($row=mysqli_fetch_row($result)) {
								echo'<div id="contact' . $row[0] . '" class="bg-white col-md-6 border border-5 border-light">
				                        <div class="p-3 d-block m-0">
			                            	<div class="mb-2"><label>Email:<br />'. $row[1] .  '</label></div>
			                            	<div><label>Message:<br />'. $row[2] .'</label></div>
				                        </div>
					        		</div>';
							}
					    } else {
					    	echo '<div class="col-md-12 mt-3 mb-3 bg-white pt-2 pb-2">No comments found</div>';
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

