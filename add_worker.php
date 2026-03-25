<?php
session_start();
include "connect.php";

// Get form data
$name = $_POST['name'];
$phone = $_POST['phone'];
$skill = $_POST['skill'];
$location = $_POST['location'];
$wage = $_POST['wage'];
$password = $_POST['password'];

// Check if phone exists
$check = $conn->prepare("SELECT worker_id FROM workers WHERE phone = ?");
$check->bind_param("s", $phone);
$check->execute();
$check->store_result();

if($check->num_rows > 0){
    echo "<script>alert('Phone already registered'); window.history.back();</script>";
    exit();
}

// Insert worker
$stmt = $conn->prepare("INSERT INTO workers (name, phone, skill, location, wage, password) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $name, $phone, $skill, $location, $wage, $password);

if($stmt->execute()){
    echo "<script>
    alert('Registration Successful! Please login.');
    window.location.href='workerlogin.html';
    </script>";
    exit();
}else{
    echo "Error: " . $conn->error;
}
?>