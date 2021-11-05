<?php  
 require('thesisdb.php');

if (isset($_POST['email']) and isset($_POST['password'])){
	
// Assigning POST values to variables.
$email = $_POST['email'];
$password = $_POST['password'];

// CHECK FOR THE RECORD FROM TABLE
$query = "SELECT * FROM `users` WHERE email='$email' and password='$password'";
 
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
$row=mysqli_fetch_row($result); // added this to read user id
$count = mysqli_num_rows($result);

if ($count == 1){


session_start();
                            
// Store data in session variables
$_SESSION["loggedin"] = true;
$_SESSION["uID"] = $row[0]; // added this to read user id
$_SESSION["email"] = $email;
$_SESSION["level"] = $row[5]; // this read the type of user
Header('Location: index.php');
}else{
Header('Location: index.php');
}
}else{
require_once ('logout.php');
}
?>