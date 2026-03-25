<?php
session_start();
include "connect.php";

if(!isset($_SESSION['worker_phone'])){
    header("Location: workerlogin.html");
    exit();
}

$phone = $_SESSION['worker_phone'];

$sql = "SELECT jobs.skill, jobs.location, jobs.wage, applications.status
        FROM applications
        JOIN jobs ON applications.job_id = jobs.id
        WHERE applications.worker_phone = ?";

$stmt = $conn->prepare($sql);

if(!$stmt){
    die("SQL Error: " . $conn->error);
}

$stmt->bind_param("s", $phone);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Applications</title>

    <style>
        body {
            margin: 0;
            font-family: Arial;
            background: #111;
            color: white;
        }

        .container {
            width: 85%;
            margin: 40px auto;
            background: #222;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(255,165,0,0.3);
        }

        h2 {
            text-align: center;
            color: orange;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            border: 1px solid #444;
            text-align: center;
        }

        th {
            background: orange;
            color: black;
        }

        tr:hover {
            background: rgba(255,165,0,0.2);
        }

        .pending {
            color: orange;
            font-weight: bold;
        }

        .accepted {
            color: lightgreen;
            font-weight: bold;
        }

        .rejected {
            color: red;
            font-weight: bold;
        }

        .back-btn {
            display: block;
            width: 220px;
            margin: 25px auto 0;
            padding: 10px;
            background: orange;
            color: black;
            text-align: center;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
        }

        .back-btn:hover {
            background: #ff9933;
        }
    </style>
</head>

<body>

<div class="container">
    <h2>My Applied Jobs</h2>

    <table>
        <tr>
            <th>Skill</th>
            <th>Location</th>
            <th>Wage</th>
            <th>Status</th>
        </tr>

        <?php
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                echo "<tr>";
                echo "<td>".$row['skill']."</td>";
                echo "<td>".$row['location']."</td>";
                echo "<td>₹".$row['wage']."</td>";

                if($row['status'] == "Pending"){
                    echo "<td class='pending'>Pending</td>";
                } elseif($row['status'] == "Accepted"){
                    echo "<td class='accepted'>Accepted</td>";
                } else {
                    echo "<td class='rejected'>Rejected</td>";
                }

                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No jobs applied yet</td></tr>";
        }
        ?>
    </table>

    <a href="worker_dashboard.php" class="back-btn">Back to Dashboard</a>
</div>

</body>
</html>