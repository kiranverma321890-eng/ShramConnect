<?php
include "connect.php";

// Get form data
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$password = $_POST['password'];
$location = $_POST['location'];

$sql = "INSERT INTO contractors (name, phone, email, password, location) VALUES('$name','$phone','$email','$password','$location')";
if($conn->query($sql) === TRUE){
echo "Registration Successful";
header ("Location: contractor_dashboard.php");
}
else{
echo "Error: " . $conn->error;
}
?>