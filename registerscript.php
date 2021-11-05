<?php 
	require('thesisdb.php');
	if (isset($_POST['name']) and isset($_POST['surname']) and isset($_POST['email']) and isset($_POST['password']) ){
		$name = $_POST['name'];
		$surname = $_POST['surname'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		
		$query = "INSERT INTO users (name, surname, email, password, level, date_created) VALUE('$name', '$surname', '$email', '$password', 0, NOW())";
		mysqli_query($connection,$query);
		
	require('loginscript.php');
	}
	
?>