<?php
session_start();
include "connect.php";

if(!isset($_SESSION['admin'])){
    header("Location: admin_login.html");
    exit();
}

// COUNT DATA
$workers_count = $conn->query("SELECT COUNT(*) as total FROM workers")->fetch_assoc()['total'];
$contractors_count = $conn->query("SELECT COUNT(*) as total FROM contractors")->fetch_assoc()['total'];
$jobs_count = $conn->query("SELECT COUNT(*) as total FROM jobs")->fetch_assoc()['total'];
$applications_count = $conn->query("SELECT COUNT(*) as total FROM applications")->fetch_assoc()['total'];

// FETCH TABLE DATA
$workers = $conn->query("SELECT name, phone, skill FROM workers");
$contractors = $conn->query("SELECT name, email FROM contractors");
$jobs = $conn->query("SELECT skill, location, wage FROM jobs");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body style="margin:0; font-family:Arial; background:#111; color:white;">

<div style="display:flex; min-height:100vh;">

    <!-- SIDEBAR -->
    <div style="width:220px; background:#1e1e1e; padding:20px;">
        <h2 style="color:orange;">Admin</h2>

        <a href="?page=workers" style="display:block; color:white; padding:10px;">Workers</a>
        <a href="?page=contractors" style="display:block; color:white; padding:10px;">Contractors</a>
        <a href="?page=jobs" style="display:block; color:white; padding:10px;">Jobs</a>
        <a href="logout.php" style="display:block; color:red; padding:10px;">Logout</a>
    </div>

    <!-- MAIN CONTENT -->
    <div style="flex:1; padding:30px;">

        <h2 style="color:orange;">Dashboard Overview</h2>

        <!-- STATS -->
        <div style="display:flex; gap:20px; flex-wrap:wrap;">
            <div style="background:#222; padding:20px; border-radius:10px; width:200px;">
                <h3>Total Workers</h3>
                <h2 style="color:orange;"><?php echo $workers_count; ?></h2>
            </div>

            <div style="background:#222; padding:20px; border-radius:10px; width:200px;">
                <h3>Total Contractors</h3>
                <h2 style="color:orange;"><?php echo $contractors_count; ?></h2>
            </div>

            <div style="background:#222; padding:20px; border-radius:10px; width:200px;">
                <h3>Total Jobs</h3>
                <h2 style="color:orange;"><?php echo $jobs_count; ?></h2>
            </div>

            <div style="background:#222; padding:20px; border-radius:10px; width:200px;">
                <h3>Applications</h3>
                <h2 style="color:orange;"><?php echo $applications_count; ?></h2>
            </div>
        </div>

        <!-- CHART -->
        <div style="width:500px; margin-top:40px;">
            <canvas id="myChart"></canvas>
        </div>

        <script>
        var ctx = document.getElementById('myChart');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Workers', 'Contractors', 'Jobs', 'Applications'],
                datasets: [{
                    label: 'System Data',
                    data: [<?php echo $workers_count; ?>, <?php echo $contractors_count; ?>, <?php echo $jobs_count; ?>, <?php echo $applications_count; ?>],
                    backgroundColor: ['orange', 'blue', 'green', 'red']
                }]
            }
        });
        </script>

        <hr>

        <!-- TABLE DATA -->
        <?php
        if(isset($_GET['page'])){
            if($_GET['page'] == 'workers'){
                echo "<h3>All Workers</h3><table border='1' cellpadding='10'>
                <tr><th>Name</th><th>Phone</th><th>Skill</th></tr>";
                while($w = $workers->fetch_assoc()){
                    echo "<tr><td>{$w['name']}</td><td>{$w['phone']}</td><td>{$w['skill']}</td></tr>";
                }
                echo "</table>";
            }

            if($_GET['page'] == 'contractors'){
                echo "<h3>All Contractors</h3><table border='1' cellpadding='10'>
                <tr><th>Name</th><th>Email</th></tr>";
                while($c = $contractors->fetch_assoc()){
                    echo "<tr><td>{$c['name']}</td><td>{$c['email']}</td></tr>";
                }
                echo "</table>";
            }

            if($_GET['page'] == 'jobs'){
                echo "<h3>All Jobs</h3><table border='1' cellpadding='10'>
                <tr><th>Skill</th><th>Location</th><th>Wage</th></tr>";
                while($j = $jobs->fetch_assoc()){
                    echo "<tr><td>{$j['skill']}</td><td>{$j['location']}</td><td>{$j['wage']}</td></tr>";
                }
                echo "</table>";
            }
        }
        ?>

    </div>
</div>

</body>
</html>