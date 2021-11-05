<?php

session_start();
require('thesisdb.php');

$_POST = json_decode(file_get_contents('php://input'), true);

if (isset($_POST['action']) and $_POST['action'] == 'approve_thesis' and isset($_POST['sID']) and $_POST['sID'] > 0 and isset($_SESSION["uID"]) and $_SESSION["uID"] > 0 and isset($_SESSION["level"])and($_SESSION["level"])=='1') {
	$sID = $_POST['sID'];

	$query = "SELECT * FROM `status` WHERE `sID`= " . $sID;
	if($result=mysqli_query($connection,$query)) {
	    $rowcount=mysqli_num_rows($result);
	    if($rowcount > 0) {
	    	while ($row=mysqli_fetch_row($result)) {
	    		if($row[3] == 'Accepted') {
	    			$status='Exist';
		    	} else {
		    		$query = "UPDATE status SET `status`='Accepted' WHERE `sID`= " . $sID;
					
					if(mysqli_query($connection,$query)){
			            $status='Success';
			        }else{
			            $status='Failed';
			        }
		    	}
	    	}			
		} else {
			$status='Failed';
		}
	}else{
	    $status='Failed';
	}
    echo $status;
    exit;
} 

if (isset($_POST['action']) and $_POST['action'] == 'reject_thesis' and isset($_POST['sID']) and $_POST['sID'] > 0 and isset($_SESSION["uID"]) and $_SESSION["uID"] > 0 and isset($_SESSION["level"])and($_SESSION["level"])=='1') {
	$sID = $_POST['sID'];

	$query = "SELECT * FROM `status` WHERE `sID`= " . $sID;
	if($result=mysqli_query($connection,$query)) {
	    $rowcount=mysqli_num_rows($result);
	    if($rowcount > 0) {
	    	while ($row=mysqli_fetch_row($result)) {
	    		if($row[3] == 'Rejected') {
	    			$status='Exist';
		    	} else {
		    		$query = "UPDATE status SET `status`='Rejected' WHERE `sID`= " . $sID;
					
					if(mysqli_query($connection,$query)){
			            $status='Success';
			        }else{
			            $status='Failed';
			        }
		    	}
	    	}			
		} else {
			$status='Failed';
		}
	}else{
	    $status='Failed';
	}
    echo $status;
    exit;
} 





?>