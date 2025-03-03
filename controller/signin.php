<?php 
session_start();
include_once "../database/config.php";

if(isset($_POST['signin'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 1){
        $user = $result->fetch_assoc();
        if(password_verify($password, $user['password'])){
            $_SESSION['unique_id'] = $user['id'];
            header("Location: ../../view/budget/request.status.php");
            exit();
        } else {  
            $_SESSION['error'] = "Invalid Username or Password";
            header("Location: ../index.php"); // Make sure this is your login page
            exit();
        }
    } else {
        $_SESSION['error'] = "Invalid Username or Password";
        header("Location: ../index.php");
        exit();
    }
}
?>
