<?php

include "connect.php";

$sql = "SELECT * FROM workers";
$result = mysqli_query($conn,$sql);

while($row = mysqli_fetch_assoc($result)){

echo "<div class='worker-card'>";

echo "<h3>".$row['name']."</h3>";
echo "<p>Skill: ".$row['skill']."</p>";
echo "<p>Location: ".$row['location']."</p>";
echo "<p>Wage: ₹".$row['wage']."</p>";

echo "<a href='worker_profile.php?id=".$row['id']."'>
<button>View Profile</button></a>";

echo "</div>";

}

?>

<h2>WORKER PROFILE</h2>
Name:<?php echo $row['name'];?><br>
Skill:<?php echo $row['skill']?><br>
Location:<?php echo $row['location'];?><br>
Expected Wage:<?php echo $row['wage'];?><br>

<h3>Rate Worker</h3>
<form action="add_rating.php" method="post">
<input type="hidden" name="worker_id" value="<?php echo $row['id'];?>">

Rating(1-5):
<input type="number" name="rating" min="1" max="5">\
<br><br>
Comment :
<textarea name="comment" ></textarea>
<br><br>
<input type ="submit" value="Submit Rating">
</form>
$sql2 ="SELECT AVG(rating) as avg_rating FROM ratings WHERE worker_id=
'$id'";
$result2=mysqli_query($conn,$sql2);
$row2=mysqli_fetch_assoc($result2);
echo "Average Rtaings:
".round"($row2['avg_rating'],1)."⭐";