<?php
    include_once 'login.php';
    $email = $_POST['email'];
    $password = $_POST['password'];
    $new_query = "SELECT* FROM `User` WHERE email ='$email' && password ='$password' ;";
    $result = $mysqli->query($new_query);
    if(!mysqli_num_rows($result)){
        // header("Location: ../signup_login/signup_login.php");
        // $message = "Wrong username or password";
        header('Location:../signup_login/signup_login.php');
        // echo 'Please Log In First';
        // $message = "Username and/or Password incorrect.\\nTry again.";
        // echo "<script type='text/javascript'>alert('$message');</script>";
        // echo "<script type='text/javascript'>alert('$message');</script>";
        // echo "Wrong username or password";
        exit();
    }
    else{
        // echo "here";
        // header("Location: ../photogallery.html");
        session_start();
        $_SESSION['email'] = $email;
        header("Location: ../favourite.php");
        exit();
    }
?>
    
