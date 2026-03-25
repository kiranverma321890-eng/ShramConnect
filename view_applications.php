<?php
session_start();
include "connect.php";

// Update status when button clicked
if(isset($_GET['action'])){
    $app_id = $_GET['id'];
    $action = $_GET['action'];

    if($action == "accept"){
        $conn->query("UPDATE applications SET status='Accepted' WHERE application_id=$app_id");
    }
    if($action == "reject"){
        $conn->query("UPDATE applications SET status='Rejected' WHERE application_id=$app_id");
    }
}

// Show applications
$sql = "SELECT applications.application_id, applications.worker_name,
               applications.worker_phone, applications.worker_location,
               applications.worker_skill, applications.status,
               jobs.skill, jobs.location, jobs.wage
        FROM applications
        JOIN jobs ON applications.job_id = jobs.id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Applications</title>

    <style>
        body {
            margin: 0;
            font-family: Arial;
            background: #111;
            color: white;
        }

        .container {
            width: 90%;
            margin: 40px auto;
            background: #222;
            padding: 30px;
            border-radius: 10px;
        }

        h2 {
            text-align: center;
            color: orange;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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

        .btn {
            padding: 6px 12px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }

        .accept {
            background: green;
            color: white;
        }

        .reject {
            background: red;
            color: white;
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

        .back {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px;
            background: orange;
            color: black;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>

<body>

<div class="container">
    <h2>Worker Applications</h2>

    <table>
        <tr>
            <th>Name</th>
            <th>Phone</th>
            <th>Location</th>
            <th>Skill</th>
            <th>Job Skill</th>
            <th>Job Location</th>
            <th>Wage</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php
        while($row = $result->fetch_assoc()){
            echo "<tr>";
            echo "<td>".$row['worker_name']."</td>";
            echo "<td>".$row['worker_phone']."</td>";
            echo "<td>".$row['worker_location']."</td>";
            echo "<td>".$row['worker_skill']."</td>";
            echo "<td>".$row['skill']."</td>";
            echo "<td>".$row['location']."</td>";
            echo "<td>₹".$row['wage']."</td>";

            // Status color
            if($row['status'] == "Pending"){
                echo "<td class='pending'>Pending</td>";
            } elseif($row['status'] == "Accepted"){
                echo "<td class='accepted'>Accepted</td>";
            } else {
                echo "<td class='rejected'>Rejected</td>";
            }

            echo "<td>
                    <a class='btn accept' href='view_applications.php?action=accept&id=".$row['application_id']."'>Accept</a>
                    <a class='btn reject' href='view_applications.php?action=reject&id=".$row['application_id']."'>Reject</a>
                  </td>";

            echo "</tr>";
        }
        ?>
    </table>

    <a href="contractor_dashboard.php" class="back">Back to Dashboard</a>
</div>

</body>
</html>