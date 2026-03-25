<?php
include "connect.php";

$results = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $skill = $_POST['skill'];

    $stmt = $conn->prepare("SELECT worker_id, name, phone, skill, location, wage FROM workers WHERE skill = ?");
   
    if(!$stmt){
        die("SQL Error: " . $conn->error);
    }

    $stmt->bind_param("s", $skill);
    $stmt->execute();

    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $results[] = $row;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Find Workers</title>

    <style>
        body {
            background-color: #000;
            font-family: Arial, sans-serif;
            color: white;
        }

        .container {
            width: 80%;
            margin: 50px auto;
            text-align: center;
        }

        /* Card */
        .card {
            background: #111;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(255,140,0,0.3);
        }

        h2 {
            color: orange;
            margin-bottom: 20px;
        }

        /* Form */
        .search-box {
            display: flex;
            justify-content: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        select {
            padding: 12px;
            border-radius: 6px;
            border: none;
            min-width: 200px;
        }

        button {
            padding: 12px 20px;
            background: orange;
            color: black;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #ff9900;
            transform: scale(1.05);
        }

        /* Table */
        table {
            width: 100%;
            margin-top: 25px;
            border-collapse: collapse;
        }

        th {
            background: orange;
            color: black;
            padding: 12px;
        }

        td {
            padding: 12px;
            background: #1a1a1a;
            border-bottom: 1px solid #333;
        }

        tr:hover td {
            background: #262626;
        }

        .no-result {
            margin-top: 20px;
            color: #ccc;
        }
    </style>
</head>

<body>

<div class="container">
    <div class="card">
        <h2>Find Workers</h2>

        <form method="POST" class="search-box">
            <select name="skill" required>
                <option value="">Select Skill</option>
                <option value="Mason">Mason</option>
                <option value="Carpenter">Carpenter</option>
                <option value="Plumber">Plumber</option>
                <option value="Electrician">Electrician</option>
                <option value="Painter">Painter</option>
                <option value="Welder">Welder</option>
                <option value="Helper">Helper</option>
                <option value="Driver">Driver</option>
                <option value="Cleaner">Cleaner</option>
                <option value="Security Guard">Security Guard</option>
            </select>

            <button type="submit">🔍 Search</button>
        </form>

        <?php if (!empty($results)) { ?>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Skill</th>
                    <th>Location</th>
                    <th>Wage</th>
                </tr>

                <?php foreach ($results as $row) { ?>
                    <tr>
                        <td><?php echo $row['worker_id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <td><?php echo $row['skill']; ?></td>
                        <td><?php echo $row['location']; ?></td>
                        <td>₹<?php echo $row['wage']; ?></td>
                    </tr>
                <?php } ?>
            </table>
        <?php } elseif ($_SERVER["REQUEST_METHOD"] == "POST") { ?>
            <p class="no-result">No workers found.</p>
        <?php } ?>

    </div>
</div>

</body>
</html>