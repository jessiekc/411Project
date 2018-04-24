<?php
    include_once 'login.php';
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    $current_city = $_POST['current_city'];
    $Username = $_POST['Username'];
    
    $sql = "INSERT INTO User(email, password, current_city, Username) VALUES('$email','$password', '$current_city', '$Username' );";
    
    $result = $mysqli->query($sql);
    
    if (!$result) {
        header('Location:../signup_login/signup_login.php');
        exit();
    }
    
//    mysqli_query($conn, $sql);
//    if($result) echo "work";
//    else echo "fail";
    session_start();
    $_SESSION['email'] = $email;
    header("Location: ../photogallery.php");
    
