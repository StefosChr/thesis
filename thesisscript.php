<?php 
	session_start();
	require('thesisdb.php');
	if (isset($_POST['title']) and isset($_POST['description']) and isset($_POST['supervisor']) and isset($_POST['subject']) and isset($_POST['deadline']) ){
		$title = $_POST['title'];
		$description = $_POST['description'];
		$supervisor = $_POST['supervisor'];
		$subject = $_POST['subject'];
		$deadline = $_POST['deadline'];

		$query = "INSERT INTO thesis (title, description, supervisor, subject, adminID, deadline, date_created) 
		VALUE('$title', '$description', '$supervisor', '$subject'," .$_SESSION['uID'].", '$deadline', NOW() )";
	
	if(mysqli_query($connection,$query)){
            $status='Success';
        }else{
            $status='Failed';
        }


    Header('Location: newthesis.php?status='.$status);
    }else{
        $status='PostVariable';
    Header('Location: newthesis.php?status='.$status);
    }

	
?>