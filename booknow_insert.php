<?php
    include_once 'booknow_consql.php';
    
    $departure_city = $_POST['departure_city'];
    $destination_city = $_POST['destination_city'];
    $departure_time = $_POST['departure_time'];
    $arrival_time = $_POST['arrival_time'];

    $sql = "INSERT INTO `Search_Flight`(departure_city, destination_city, departure_time, arrival_time) VALUES('$departure_city','$destination_city', '$departure_time', '$arrival_time' );";
    
    $result = $mysqli->query($sql);
    
    if (!$result) {
        printf("%s\n", $mysqli->error);
        exit();
    }

session_start();
$_SESSION['departure_city'] = $departure_city;
$_SESSION['destination_city'] = $destination_city;
$_SESSION['departure_time'] = $departure_time;

header("Location: ../tickets_histogram.php");
    
