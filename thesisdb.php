<?php
$connection = mysqli_connect('localhost', 'root', '','thesisdb');

if (!$connection){
    die("Database Connection Failed" . mysqli_error($connection));
}


?>