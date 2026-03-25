<?php
session_start();
include "connect.php";

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT id FROM admin WHERE username=? AND password=?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$stmt->store_result();

if($stmt->num_rows > 0){
    $_SESSION['admin'] = $username;
    header("Location: dashboard.php");
    exit();
}
else{
    echo "<script>alert('Invalid Admin Login'); window.history.back();</script>";
}
?>