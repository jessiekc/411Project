<?php

$db_host = "cpanel3";
$db_username = "momenttrip_yren";
$db_password = "qwer1234";
$db_name = "momenttrip_db";

$mysqli = new mysqli($db_host, $db_username, $db_password, $db_name);

// // Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
// else echo "Connected successfully";
