<?php

session_start();
require('thesisdb.php');

$_POST = json_decode(file_get_contents('php://input'), true);

if (isset($_POST['action']) and $_POST['action'] == 'promote_to_admin') {
	if(isset($_POST['uID']) and $_POST['uID'] > 0) {
		$uID = $_POST['uID'];
		$query = "UPDATE `users` SET `level`=1 WHERE `uID`= " . $uID;
		if(mysqli_query($connection,$query)){
		    $status='Success';
		}else{
		    $status='Failed';
		}
	    echo $status;
	} else{
	    $status='Failed';
	    echo $status;
	}
} 

if (isset($_POST['action']) and $_POST['action'] == 'demote_to_admin') {
	if(isset($_POST['uID']) and $_POST['uID'] > 0) {
		$uID = $_POST['uID'];
		$query = "UPDATE `users` SET `level`=0 WHERE `uID`= " . $uID;
		if(mysqli_query($connection,$query)){
		    $status='Success';
		}else{
		    $status='Failed';
		}
	    echo $status;
	} else{
	    $status='Failed';
	    echo $status;
	}
} 





?>