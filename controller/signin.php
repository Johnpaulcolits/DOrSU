<?php 
session_start();
include_once "../database/config.php";

if(isset($_POST['signin'])){


$email = $_POST['email'];
$password = $_POST['password'];


$sql = "SELECT * FROM users where email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s",$email);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows == 1){
 $user = $result->fetch_assoc();
 if(password_verify($password, $user['password'])){
   $_SESSION['unique_id'] = $user['id'];
    echo "<script>alert('Login Successfully'); window.location.href='../../view/budget/request.status.php';</script>";
    exit();
 }else{  
    echo "<script>alert('Login Successfully'); window.location.href='../register.php';</script>";
    exit();
 }
}








}












?>