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
} else{
  Header('Location: index.php');    
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Promote | Demote</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  </head>
  <body>
    
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
      <div style="flex: 0 0 100%; max-width: 100%" class="col-md-12 col-lg-8 bg-white border border-5 border-light">
        <div class="container">
          <div class="row align-items-end justify-content-start">
            <div class="col-md-12 bg-light mt-2 mb-2 text-center">
              <h1 class="mb-3 mt-3 bread">Promote | Demote</h1>
            </div>
          </div>
        </div>
      </div>
    </div>

   <div class="row mb-5">
   <?php
      require_once('thesisdb.php');

      $sql="SELECT `uID`, `name`,`surname`, `email`, `level` FROM `users`";

      if ($result=mysqli_query($connection,$sql)) {
          $rowcount=mysqli_num_rows($result);
          if($rowcount > 0) {
            while ($row=mysqli_fetch_row($result)) {
              $userlevel = $row[4];
              if($uID != $row[0]) {
                echo '<div id="user' . $row[0] . '" class="bg-white col-md-6 border border-5 border-light">
                  <div class="p-3 d-block d-lg-flex align-items-center">
                    <div class="one-third mb-4 mb-md-0">
                      <div style="display: block" class="align-items-center">
                        <h4>'. $row[2] ." ". $row[1] . '</h4>
                        <h4>'. $row[3] . '</h4>
                      </div>
                      <div class="d-block d-md-flex mt-3">';
              if($userlevel == 0) {
                echo '<a id="promotedemoteadmin' . $row[0] . '" onclick="promote(' . $row[0] . ')" class="btn btn-primary btn-success py-2">Promote</a>';
              } else {
                echo '<a id="promotedemoteadmin' . $row[0] . '" onclick="demote(' . $row[0] . ')" class="btn btn-primary btn-danger py-2">Demote</a>';
              }
               echo '
                      </div>
                    </div>
                  </div>
              </div>';
              }
              
            } 
        } else {
          echo '<div class="col-md-12 mt-3 mb-3 p-3 bg-white">No users found</div>';
        }
      } 
    ?>
    </div>
  </div>
</section>
<script>
function promote(uID){
  Swal.fire({
    title: 'Are you sure you want to promote this user to admin?',
    showDenyButton: false,
    showCancelButton: true,
    confirmButtonText: `Promote`,
    denyButtonText: `Don't save`,
  }).then((result) => {
    if (result.isConfirmed) {
      var request = new Request('promotionscript.php', {
        method: 'POST',
        body: JSON.stringify({
          uID: uID,
          action: 'promote_to_admin'
        })
      });
      fetch(request).then((response) => response.text()).then((text) => {
        if(text == 'Success') {
          Swal.fire('Promoted!', '', 'success');
          element = document.querySelector("#promotedemoteadmin" + uID);
          if (element.classList.contains('btn-success')) {
            element.classList.remove("btn-success");
          }
          element.classList.add("btn-danger");
          element.innerHTML = "Demote";
          element.setAttribute("onclick","demote(" + uID + ")");
        }
        if(text == 'Failed') {
            Swal.fire('Failed to promote this user to admin!', '', 'error');
        }
      });
    } 
  });
}

function demote(uID){
  Swal.fire({
    title: 'Are you sure you want to demote this admin to normal user?',
    showDenyButton: false,
    showCancelButton: true,
    confirmButtonText: `Demote`,
    denyButtonText: `Don't save`,
  }).then((result) => {
    if (result.isConfirmed) {
      var request = new Request('promotionscript.php', {
        method: 'POST',
        body: JSON.stringify({
          uID: uID,
          action: 'demote_to_admin'
        })
      });
      fetch(request).then((response) => response.text()).then((text) => {
        if(text == 'Success') {
          Swal.fire('Demoted!', '', 'success');
          element = document.querySelector("#promotedemoteadmin" + uID);
          if (element.classList.contains('btn-danger')) {
            element.classList.remove("btn-danger");
          }
          element.classList.add("btn-success");
          element.innerHTML = "Promote";
          element.setAttribute("onclick","promote(" + uID + ")");
        }
        if(text == 'Failed') {
            Swal.fire('Failed to demote this admin to normal user!', '', 'error');
        }
      });
    } 
  });
}

</script>

<?php require_once('footer.php');?>
	
  </body>
</html>

