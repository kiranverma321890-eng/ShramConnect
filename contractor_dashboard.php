<?php
session_start();
if(!isset($_SESSION['contractor_id'])){
    header("Location: contractorlogin.html");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contractor Dashboard</title>
</head>
<body style="margin:0; font-family:Arial, sans-serif; background:#111; color:#fff;">

<div style="display:flex; justify-content:center; align-items:center; height:100vh;">
    <div style="background:#fff; color:#000; padding:30px; border-radius:10px; width:360px; text-align:center; box-shadow:0 8px 20px rgba(255,102,0,0.3);">
        
        <h2 style="color:#ff6600; margin-bottom:20px;">Welcome Contractor</h2>

        <a href="postjob.html" style="display:block; text-decoration:none; background:#ff6600; color:#fff; padding:10px; margin:10px 0; border-radius:5px;">
           Post Jobs
        </a>

        <a href="view_applications.php" style="display:block; text-decoration:none; background:#444; color:#fff; padding:10px; margin:10px 0; border-radius:5px;">
           View Applications
        </a>
         <a href="search_worker.php " style="display:block; text-decoration:none; background:red; color:#fff; padding:10px; margin:10px 0; border-radius:5px;">
           Search Worker
        </a>

        <a href="logout.php" style="display:block; text-decoration:none; background:red; color:#fff; padding:10px; margin:10px 0; border-radius:5px;">
           Logout
        </a>

    </div>
</div>
</body>
</html>