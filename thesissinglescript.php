<?php

session_start();
require('thesisdb.php');

if (isset($_GET['action']) and $_GET['action'] == 'update_thesis') { 
	if(isset($_POST['title']) and $_POST['title'] != '' and isset($_POST['description']) and $_POST['description'] != '' and isset($_POST['supervisor']) and $_POST['supervisor'] != '' and isset($_POST['subject']) and $_POST['subject'] != '' and isset($_POST['deadline']) and $_POST['deadline'] != '' and isset($_POST['thesisid']) and $_POST['thesisid'] > 0 and isset($_SESSION["uID"]) and $_SESSION["uID"] > 0) {
		$tID = $_POST['thesisid'];
		$uID = $_SESSION['uID'];
		$title = $_POST['title'];
		$description = $_POST['description'];
		$supervisor = $_POST['supervisor'];
		$subject = $_POST['subject'];
		$deadline = $_POST['deadline'];

		$query = "UPDATE `thesis` SET `title`='" . $title . "', `description`='" . $description . "', `supervisor`='" . $supervisor . "', `subject`='" . $subject . "', `adminID`=" . $uID . ", `deadline`='" . $deadline . "' WHERE `tID`= " . $tID; 
		// echo $query;
		if(mysqli_query($connection,$query)){
		    $status='Success';
		} else {
		    $status='Failed';
		}
	} else {
		$status='Vars';
	}
	
	Header('Location: thesissingle.php?tid=' . $tID . '&status=' . $status);
	exit;
} 

$_POST = json_decode(file_get_contents('php://input'), true);

if (isset($_POST['action']) and $_POST['action'] == 'request_thesis' and isset($_POST['tID']) and $_POST['tID'] > 0 and isset($_SESSION["uID"]) and $_SESSION["uID"] > 0) {
	$tID = $_POST['tID'];
	$uID = $_SESSION["uID"];

	$query = "SELECT * FROM `status` WHERE `thesisID`= " . $tID . " AND `userID`= " . $uID;
	if($result=mysqli_query($connection,$query)) {
	    $rowcount=mysqli_num_rows($result);
	    if($rowcount > 0) {
			$status='Exist';
		} else {
			$query = "INSERT INTO status (userID, thesisID, status, date_created) 
			VALUE(" . $uID . ", " . $tID . ", 0, NOW())";
		
			if(mysqli_query($connection,$query)){
	            $status='Success';
	        }else{
	            $status='Failed';
	        }
		}
	}else{
	    $status='Failed';
	}
    echo $status;
    exit;
} 

if (isset($_POST['action']) and $_POST['action'] == 'delete_thesis' and isset($_POST['tID']) and $_POST['tID'] > 0) {
	$tID = $_POST['tID'];

	$query = "DELETE FROM `thesis` WHERE `tID`= " . $tID;
	if(mysqli_query($connection,$query)) {
		$query = "DELETE FROM `status` WHERE `thesisID`= " . $tID;
		if(mysqli_query($connection,$query)) {
			$status='SuccessALL';
		} else {
			$status='Success';
		}
	}else{
	    $status='Failed';
	}
    echo $status;
    exit;
} 





?>