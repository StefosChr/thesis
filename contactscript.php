<?php 
	session_start();
	require('thesisdb.php');
	if (isset($_POST['email']) and isset($_POST['comment']) ){
		$email = $_POST['email'];
		$comment = $_POST['comment'];

		$query = "INSERT INTO contact (email, comment, date_created) 
		VALUE('$email', '$comment', NOW() )";
	
	if(mysqli_query($connection,$query)){
            $status='Success';
        }else{
            $status='Failed';
        }


    Header('Location: contact.php?status='.$status);
    }else{
        $status='PostVariable';
    Header('Location: contact.php?status='.$status);
    }

	
?>