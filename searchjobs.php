<?php
include "connect.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Job Results</title>
</head>

<body style="margin:0; font-family:Arial; background:black; color:white;">

<div style="width:80%; margin:auto; padding:40px;">

<h2 style="color:orange;">Job Results</h2>

<?php
if(isset($_POST['skill'])){
    $skill = $_POST['skill'];
    $location = $_POST['location'];

    $stmt = $conn->prepare("SELECT * FROM jobs WHERE skill LIKE ? AND location LIKE ?");
    
    if(!$stmt){
        die("SQL Error: " . $conn->error);
    }

    $searchSkill = "%".$skill."%";
    $searchLocation = "%".$location."%";

    $stmt->bind_param("ss", $searchSkill, $searchLocation);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            echo "<div style='background:#222; padding:15px; margin:15px 0; border-left:5px solid orange;'>";
            echo "<b>Skill:</b> ".$row['skill']."<br>";
            echo "<b>Location:</b> ".$row['location']."<br>";
            echo "<b>Wage:</b> ₹".$row['wage']."<br><br>";
            echo "<a href='apply_job.php?job_id=".$row['id']."' style='color:orange;'>Apply Job</a>";
            echo "</div>";
        }
    } else {
        echo "No jobs found.";
    }
}
?>

</div>

</body>
</html>