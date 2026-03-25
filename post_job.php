<?php 
include "connect.php";

// Get form data
$skill = $_POST['skill'];
$phone = $_POST['phone'];
$location = $_POST['location'];
$wage = $_POST['wage'];
$workers_needed = $_POST['workers_needed'];

$sql = "INSERT INTO jobs (skill, phone, location, wage, workers_needed) 
VALUES('$skill','$phone','$location','$wage','$workers_needed')";

if($conn->query($sql) === TRUE){
    echo "<script>alert('Job Posted Successfully');</script>";
} else{
    echo "Error: " . $conn->error;
}
?>