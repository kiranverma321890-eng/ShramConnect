<?php
session_start();
include "connect.php";

if(!isset($_SESSION['worker_phone'])){
    header("Location: worker_login.php");
    exit();
}

$phone = $_SESSION['worker_phone'];

// Get worker info
$worker = $conn->query("SELECT * FROM workers WHERE phone='$phone'");
if(!$worker){
    die("SQL Error: " . $conn->error);
}
$w = $worker->fetch_assoc();

// Get applied jobs
$jobs = $conn->query("
    SELECT jobs.skill, jobs.location, jobs.wage
    FROM applications
    JOIN jobs ON applications.job_id = jobs.id
    WHERE applications.phone = '$phone'
");
?>
<!DOCTYPE html>
<html>
<head>
<title>Worker Dashboard</title>
<style>
body{
    margin:0;
    font-family:Arial;
    background:#2b2b2b;
    color:white;
}
.container{
    display:flex;
    min-height:100vh;
}
.profile{
    width:300px;
    background:#1e1e1e;
    padding:30px;
}
.profile h2{
    color:orange;
}
.profile p{
    margin:8px 0;
    border-bottom:1px solid #444;
    padding-bottom:5px;
}
.logout{
    display:block;
    margin-top:20px;
    color:orange;
    text-decoration:none;
    font-weight:bold;
}
.dashboard{
    flex:1;
    padding:40px;
}
.dashboard h2{
    color:orange;
}
.job-card{
    background:#3a3a3a;
    padding:20px;
    margin:10px 0;
    border-radius:10px;
}
.btn{
    background:orange;
    color:black;
    padding:10px 15px;
    text-decoration:none;
    border-radius:5px;
    margin-right:10px;
    font-weight:bold;
}
</style>
</head>

<body>

<div class="container">

<div class="profile">
    <h2>Worker Profile</h2>
    <p><b>Name:</b> <?php echo $w['name']; ?></p>
    <p><b>Phone:</b> <?php echo $w['phone']; ?></p>
    <p><b>Skill:</b> <?php echo $w['skill']; ?></p>
    <p><b>Location:</b> <?php echo $w['location']; ?></p>
    <p><b>Daily Wage:</b> ₹<?php echo $w['wage']; ?></p>

    <a href="logout.php" class="logout">Logout</a>
</div>

<div class="dashboard">
    <h2>Worker Dashboard</h2>

    <div style="margin-bottom:20px;">
        <a href="viewjobs.html" class="btn">View Jobs</a>
        <a href="searchjobs.html" class="btn">Search Jobs</a>
        <a href="my_applications.php" class="btn">My Applications</a>
    </div>

    <h2>Jobs You Applied</h2>

    <?php
    if($jobs->num_rows > 0){
        while($job = $jobs->fetch_assoc()){
            echo "<div class='job-card'>";
            echo "<p><b>Skill:</b> ".$job['skill']."</p>";
            echo "<p><b>Location:</b> ".$job['location']."</p>";
            echo "<p><b>Wage:</b> ₹".$job['wage']."</p>";
            echo "</div>";
        }
    } else {
        echo "<p>No jobs applied yet.</p>";
    }
    ?>
</div>

</div>

</body>
</html>