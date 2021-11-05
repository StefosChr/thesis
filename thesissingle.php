<?php

session_start();

require_once('thesisdb.php');

$uID = 0;
if (isset($_SESSION["uID"]) and $_SESSION["uID"] > 0) {
	$uID = $_SESSION["uID"];
} 

if(isset($_GET['tid']) && $_GET['tid'] > 0) {

	$tid = $_GET['tid'];             

	$sql="SELECT * FROM `thesis` WHERE `tID` = " . $tid . " LIMIT 1";

	if ($result=mysqli_query($connection,$sql)) {
		$rowcount=mysqli_num_rows($result);
		if($rowcount > 0) {
			while ($row=mysqli_fetch_row($result)) {
				$title = $row[1];
				$description = $row[2];
				$supervisor = $row[3];
				$subject = $row[4];
				$deadline = $row[6];
			}
		} else {
			Header('Location: index.php');
		}
	} else {
		Header('Location: index.php');
	}

} else {
	Header('Location: index.php');
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
    <title><?php echo $title; ?></title>
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
			        <div class="row align-items-end justify-content-start">
			          <div class="col-md-12 bg-light mt-2 mb-2 text-center">
			            <h1 class="mb-3 mt-3 bread"><?php echo $title; ?></h1>
			          </div>
			        </div>
			      </div>
	          </div>
          	</div>
        </div>
    </section>
    <section class="ftco-section bg-light pt-2">
      <div class="container">
        <div class="row bg-white p-3">
          <div class="col-lg-12 pr-lg-9">
            <div class="row justify-content-center">
              <div class="col-md-12">
                <span class="subheading"></span>
                <label>Supervisor:</label><h4 class="mb-4"><?php echo $supervisor; ?></h4>
                <label>Deadline:</label><h4 class="mb-4"><?php echo $deadline; ?></h4>
                <label>Subject:</label><h4 class="mb-4"><?php echo $subject; ?></h4>
                <p class="mb-4"><?php echo $description; ?></p>
                <div id="thesisbuttons<?php echo $tid; ?>" class="d-block">
                <?php if($loggedin) { ?>
                  <?php if($level == 1) { ?>
                  <a id="editbutton<?php echo $tid; ?>" onclick="editthesis()" class="mr-5 btn btn-primary py-2">Edit</a>
                  <a id="deletebutton<?php echo $tid; ?>" onclick="deletethesis(<?php echo $tid; ?>)" class="btn btn-primary py-2">Delete</a>
                  <?php } else if($level == 0) { ?>
                  <a id="requestbutton<?php echo $tid; ?>" onclick="requestthesis(<?php echo $tid; ?>)" class="mr-5 btn btn-primary py-2">Apply</a>
                  <?php } else { ?>
                  	<a  </a>
                  <?php } ?>
                <?php } else { ?>
                  	<div class="row">
			      		<div class="col-md-12 text-center mb-0">
					    	<div class="alert alert-secondary" role="alert">
							  <div class="text-danger h5 mb-0">You need to login to apply a Thesis</div>
							</div>
						</div>
					</div>
                <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
	<section id="editthesissection" class="ftco-section bg-light d-none pt-1">
		<div class="container">
			<div class="row bg-white p-3">
				<div style="flex: 0 0 100%; max-width: 100%" class="col-md-12 col-lg-8">
					<form id="editthesisform" action="thesissinglescript.php?action=update_thesis" method="post" class="bg-white" enctype="multipart/form-data">
						<input type="hidden" id="thesisid" class="form-control" name="thesisid">
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
								<input type="submit" value="Post" class="btn btn-primary py-2 px-5">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
                    
<script>

function requestthesis(tID){
  Swal.fire({
    title: 'Are you sure you want to request thesis?',
    showDenyButton: false,
    showCancelButton: true,
    confirmButtonText: `Yes`,
  }).then((result) => {
    if (result.isConfirmed) {
      var request = new Request('thesissinglescript.php', {
        method: 'POST',
        body: JSON.stringify({
          tID: tID,
          action: 'request_thesis'
        })
      });
      fetch(request).then((response) => response.text()).then((text) => {
        if(text == 'Success') {
			Swal.fire('Requested successfully!', '', 'success');
			document.getElementById("requestbutton" + tID).remove();
        }
        if(text == 'Exist') {
        	Swal.fire('You have already requested this thesis. Please check the status in My Thesis section.', '', 'info');
        	document.getElementById("requestbutton" + tID).remove();
        }
        if(text == 'Failed') {
        	Swal.fire('Failed to request this thesis.', '', 'error');
        }
        
      });
    } 
  });
}

function deletethesis(tID){
  Swal.fire({
    title: 'Are you sure you want to delete this thesis?',
    showDenyButton: false,
    showCancelButton: true,
    confirmButtonText: `Yes`,
  }).then((result) => {
    if (result.isConfirmed) {
      var request = new Request('thesissinglescript.php', {
        method: 'POST',
        body: JSON.stringify({
          tID: tID,
          action: 'delete_thesis'
        })
      });
      fetch(request).then((response) => response.text()).then((text) => {
        if(text == 'SuccessALL') {
			Swal.fire('Deleted successfully!', '', 'success');
			document.getElementById("thesisbuttons" + tID).remove();
        }
        if(text == 'Success') {
			Swal.fire('Thesis deleted successfully but failed to remove thesis from status table!', '', 'info');
			document.getElementById("thesisbuttons" + tID).remove();
        }
        if(text == 'Failed') {
        	Swal.fire('Failed to delete this thesis.', '', 'error');
        }
      });
    } 
  });
}

function editthesis() {
	document.getElementById("editthesissection").classList.remove("d-none");
	document.getElementById("thesisid").value = "<?php echo $tid; ?>";
	document.getElementById("title").value = '<?php echo $title; ?>';
	document.getElementById("description").value = '<?php echo $description; ?>';
	document.getElementById("supervisor").value = '<?php echo $supervisor; ?>';
	document.getElementById("subject").value = '<?php echo $subject; ?>';
	document.getElementById("deadline").value = '<?php echo $deadline; ?>';
}

function status() {

	var url_string = window.location.href;
	var url = new URL(url_string);
	var status = url.searchParams.get("status");
	var iconmessage = '';

	if(status=='Success'){
		iconmessage = 'success';
		titlemessage = 'Thesis have been successfully updated!';
	} else if(status=='Failed'){
		iconmessage = 'error';
		titlemessage = 'Failed to update thesis.';
	} else if(status=='Vars'){
		iconmessage = 'error';
		titlemessage = 'Something went wrong with the posted variables.';
	} else {
		return false;
	}

	Swal.fire({
		icon: iconmessage,
		title:titlemessage,
		toast: true,
		position: 'top-end', 
		showConfirmButton: false,
		timer: 5000,
		timerProgressBar: true,
		didOpen: (toast) => {
			toast.addEventListener('mouseenter', Swal.stopTimer)
			toast.addEventListener('mouseleave', Swal.resumeTimer)
		}
	});

}

</script>

<?php require_once('footer.php');?>
		

	
  </body>
</html>

