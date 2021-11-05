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
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?php if($level == 1) { ?> Theses Requests <?php } else { ?> My Theses <?php } ?></title>
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
	          <div style="flex: 0 0 100%; max-width: 100%" class="col-md-12 col-lg-8 bg-white">
			    <div class="container">
			        <div class="row align-items-end justify-content-start">
			          <div class="col-md-12 bg-light mt-2 mb-2 text-center">
			            <h1 class="mb-3 mt-3 bread">
			            	<?php if($level == 1) { ?> Theses Requests <?php } else { ?> My Theses <?php } ?>
			            </h1>
			          </div>
			        </div>
			     </div>
	          </div>
          	</div>

          	<div class="row mt-2 mb-5">
	          	<?php

	          		$sql="SELECT * FROM `status` AS status LEFT JOIN `users` AS users ON users.uID = status.userID LEFT JOIN `thesis` AS thesis ON thesis.tID = status.thesisID WHERE thesis.deadline >= CURDATE()";
	          		if($level == 0) { 
	          			$sql.=" AND status.userID = " . $uID;
	          		} 

	          		$sql.=" ORDER BY thesis.date_created DESC";

					if ($result=mysqli_query($connection,$sql)) {
					    $rowcount=mysqli_num_rows($result);
					    if($rowcount > 0) {
							while ($row=mysqli_fetch_row($result)) {
								$statusstr = $row[3];
								if($statusstr == '0') {
									$statusstr = 'Pending';
								}
								switch ($statusstr) {
									case 'Accepted':
										$bgcolorclass = 'bg-success';
										$textclass = 'text-white';
										break;
									case 'Rejected':
										$bgcolorclass = 'bg-danger';
										$textclass = 'text-white';
										break;
									default:
										$bgcolorclass = 'bg-secondary';
										$textclass = 'text-white';
										break;
								}
	
								echo '<div id="thesis' . $row[0] . '" class="container"><div class="row mb-3 p-3 bg-white">
											<div class="col-md-9">
												<div><label>Title:<p class="mr-3 text-black fs-5">'. $row[13] . '</p></label></div>
												<div><label>Supervizor:<p class="mr-3 text-black fs-5">' . $row[15] . '</p></label></div>';
								if($level == 1) { 
										echo '	<div><label>Subject:<p class="mr-3 text-black fs-5">' . $row[16] . '</p></label></div>
												<div id="mythesisbuttons' . $row[0] . '" class="d-block mb-3">
								                  <a id="approvebutton' . $row[0] . '" onclick="approvethesis(' . $row[0] . ')" class="mr-5 btn btn-primary btn-success py-2">Approve</a>
								                  <a id="rejectbutton' . $row[0] . '" onclick="rejectthesis(' . $row[0] . ')" class="btn btn-primary btn-danger py-2">Reject</a>
								                </div>
											';
								}
								echo '		</div>';
								if($level == 1) { 
									echo '	<div class="col-md-3">
												<div><label>User Name:<p class="mr-3 text-black fs-5">'. $row[6] . ' '. $row[7] . '</p></label></div>
												<div><label>User Email:<p class="mr-3 text-black fs-5">' . $row[9] . '</p></label></div>
												<div><label>Date Reguested:<p class="mr-3 text-black fs-5">' . $row[4] . '</p></label></div>
												<div><label>Status:<p id="status' . $row[0] . '" class="mr-3 p-1 fs-5 ' . $textclass .' '. $bgcolorclass .'">' . $statusstr . '</p></label></div>
											</div>
										';
								} else {
									echo '	<div class="col-md-3">
												<div><label>Date Reguested:<p class="mr-3 text-black fs-5">' . $row[4] . '</p></label></div>
												<div><label>Status:<p class="mr-3 p-1 fs-5 ' . $textclass .' '. $bgcolorclass .'">' . $statusstr . '</p></label></div>
											</div>
										';
								}

								echo '</div></div>';
							}

					    } else {
					    	echo '<div class="col-md-12 mt-3 mb-3 p-3 bg-white">No thesis found</div>';
					    }
					}
  				?>
	        </div>

        </div>
    </section>
    
                    
<script>

<?php if($level == 1) { ?>
function approvethesis(sID){
  Swal.fire({
    title: 'Are you sure you want to approve thesis?',
    showDenyButton: false,
    showCancelButton: true,
    confirmButtonText: `Yes`,
  }).then((result) => {
    if (result.isConfirmed) {
      var request = new Request('mythesisscript.php', {
        method: 'POST',
        body: JSON.stringify({
          sID: sID,
          action: 'approve_thesis'
        })
      });
      fetch(request).then((response) => response.text()).then((text) => {
        if(text == 'Success') {
			Swal.fire('Approved successfully!', '', 'success');
			document.querySelector("#approvebutton" + sID).classList.add("d-none");
			document.querySelector("#rejectbutton" + sID).classList.remove("d-none");
			document.querySelector("#status" + sID).classList.remove("bg-danger");
			document.querySelector("#status" + sID).classList.remove("bg-secondary");
			document.querySelector("#status" + sID).classList.add("bg-success");
			document.querySelector("#status" + sID).innerHTML = "Accepted";
        }
        if(text == 'Exist') {
        	Swal.fire('You have already approved this thesis.', '', 'info');
        	document.querySelector("#approvebutton" + sID).classList.add("d-none");
			document.querySelector("#rejectbutton" + sID).classList.remove("d-none");
			document.querySelector("#status" + sID).classList.remove("bg-danger");
			document.querySelector("#status" + sID).classList.remove("bg-secondary");
			document.querySelector("#status" + sID).classList.add("bg-success");
			document.querySelector("#status" + sID).innerHTML = "Accepted";
        }
        if(text == 'Failed') {
        	Swal.fire('Failed to approve this thesis.', '', 'error');
        }
        
      });
    } 
  });
}

function rejectthesis(sID){
  Swal.fire({
    title: 'Are you sure you want to reject thesis?',
    showDenyButton: false,
    showCancelButton: true,
    confirmButtonText: `Yes`,
  }).then((result) => {
    if (result.isConfirmed) {
      var request = new Request('mythesisscript.php', {
        method: 'POST',
        body: JSON.stringify({
          sID: sID,
          action: 'reject_thesis'
        })
      });
      fetch(request).then((response) => response.text()).then((text) => {
        if(text == 'Success') {
			Swal.fire('Rejected successfully!', '', 'success');
			document.querySelector("#rejectbutton" + sID).classList.add("d-none");
			document.querySelector("#approvebutton" + sID).classList.remove("d-none");
			document.querySelector("#status" + sID).classList.remove("bg-success");
			document.querySelector("#status" + sID).classList.remove("bg-secondary");
			document.querySelector("#status" + sID).classList.add("bg-danger");
			document.querySelector("#status" + sID).innerHTML = "Rejected";
        }
        if(text == 'Exist') {
        	Swal.fire('You have already rejected this thesis.', '', 'info');
        	document.querySelector("#rejectbutton" + sID).classList.add("d-none");
			document.querySelector("#approvebutton" + sID).classList.remove("d-none");
			document.querySelector("#status" + sID).classList.remove("bg-success");
			document.querySelector("#status" + sID).classList.remove("bg-secondary");
			document.querySelector("#status" + sID).classList.add("bg-danger");
			document.querySelector("#status" + sID).innerHTML = "Rejected";
        }
        if(text == 'Failed') {
        	Swal.fire('Failed to reject this thesis.', '', 'error');
        }
        
      });
    } 
  });
}
<?php } ?>



</script>

<?php require_once('footer.php');?>
	
  </body>
</html>

