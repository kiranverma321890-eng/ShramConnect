<?php
include "connect.php";
$result = $conn->query("SELECT * FROM jobs");

echo "<table class='jobs-table'>";
echo "<tr>
        <th>Skill</th>
        <th>Location</th>
        <th>Wage</th>
        <th>Action</th>
      </tr>";

while($row = $result->fetch_assoc()){
    echo "<tr>";
    echo "<td>".$row['skill']."</td>";
    echo "<td>".$row['location']."</td>";
    echo "<td>₹".$row['wage']."</td>";
    echo "<td><a href='apply_job.php?job_id=".$row['id']."'><button class='apply-btn'>Apply</button></a></td>";
    echo "</tr>";
}

echo "</table>";
?>