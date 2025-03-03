<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'dorsu';


$conn =  new  mysqli($host,$username,$password,$database);

if(!$conn){
    die("Connection failed: " . $conn->connect_error);
}

?>
    
