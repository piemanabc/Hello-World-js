<?php
$servername = "localhost";
$username = "sec_user";
$password = "greenChair153";
$dbname = "f_crochet";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';

if(!empty($sessData)){
    $user_id = $sessData['userID'];
} else {
  $user_id = 0;
}
?>
