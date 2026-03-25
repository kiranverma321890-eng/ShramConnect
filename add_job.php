<?php

include "connect.php";

$job = $_POST['job'];
$location = $_POST['location'];
$wage = $_POST['wage'];
$workers = $_POST['workers'];

$sql ="INSERT INTO jobs(job_type,location,wage,workers_needed) VALUES
('$job','$location','$wage','$workers')";
mysqli_query($conn,$sql);
echo "JOB POSTED SUCCESSFULLY";
?>z