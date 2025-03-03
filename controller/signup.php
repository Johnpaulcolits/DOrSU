<?php

include_once "../database/config.php";

if(isset($_POST['signup'])){

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if($password !== $confirm_password){
        echo "<script>alert('Passwords didn\'t match'); window.location.href='../register.php';</script>";
    } else {

        $check_email = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($check_email);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0){
            echo "<script>alert('Email already exists'); window.location.href='../register.php';</script>";
        } else {
            $hashed_password  = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $name, $email, $hashed_password);

            if($stmt->execute()){
                echo "<script>alert('Registered successfully!'); window.location.href='../index.php';</script>";
            } else {
                echo "<script>alert('An error occurred!'); window.location.href='../register.php';</script>";
            }
            $stmt->close();
        }
        $result->close();
    }

    $conn->close();
}


?>
