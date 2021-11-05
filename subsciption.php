<?php 
	session_start();
	require('thesisdb.php');
	if (isset($_POST['email'])){
		$email = $_POST['email'];
		

		$query ="SELECT `email` FROM `subs` WHERE email='$email'";
		
	
	if(mysqli_query($connection,$query)){

		$count = mysqli_num_rows(mysqli_query($connection, $query));

			if ($count == 0){

			$query2 = "INSERT INTO subs (email) VALUE('$email')";
		
				if(mysqli_query($connection,$query2)){

					$status='Success';
					
					}else{

					$status='Failed2';

					}

        	}else{

        	$status='Subscribed';

        	}

        }else{
            $status='Failed';
        }


    Header('Location: index.php?status='.$status);
    }else{
        $status='PostVariable';
    Header('Location: index.php?status='.$status);
    }

	
?>