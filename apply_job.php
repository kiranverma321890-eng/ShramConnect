<?php
include "connect.php";

// If form submitted → insert into database
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $location = $_POST['location'];
    $skill = $_POST['skill'];
    $job_id = $_POST['job_id'];

    $sql = "INSERT INTO applications
            (job_id, worker_name, worker_phone, worker_location, worker_skill)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issss", $job_id, $name, $phone, $location, $skill);

    if($stmt->execute()){
        echo "<script>alert('Application Submitted Successfully'); window.location='worker_dashboard.php';</script>";
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

// If coming from Apply button → get job_id
if(isset($_GET['job_id'])){
    $job_id = $_GET['job_id'];
} else {
    $job_id = "";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Apply for Job</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #000000, #1a1a1a);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .apply-container {
            background: #111;
            padding: 30px 40px;
            border-radius: 10px;
            width: 350px;
            box-shadow: 0 0 15px rgba(255, 102, 0, 0.5);
            text-align: center;
            animation: fadeIn 1s ease;
        }

        .apply-container h2 {
            color: #ff6600;
            margin-bottom: 20px;
        }

        .apply-container input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 5px;
            border: none;
            font-size: 14px;
        }

        .apply-container button {
            width: 50%;
            padding: 10px;
            background: #ff6600;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .apply-container button:hover {
            background: #e65c00;
            transform: scale(1.05);
        }

        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(20px);}
            to {opacity: 1; transform: translateY(0);}
        }
    </style>
</head>

<body>

<div class="apply-container">
    <h2>Apply for Job</h2>

    <form method="POST">
        <input type="hidden" name="job_id" value="<?php echo $job_id; ?>">

        <input type="text" name="name" placeholder="Enter Your Name" required>
        <input type="text" name="phone" placeholder="Enter Phone Number" required>
        <input type="text" name="location" placeholder="Enter Your Location" required>
       <select name="skill" required
                style="width:106%; padding:10px; margin:8px 0; border:1px solid #ccc; border-radius:5px; font-size:14px; background:#f9f9f9;">
                <option value="">Select Skill</option>
                <option value="Mason">Mason (Rajmistri)</option>
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
 <br><br>
        <button type="submit">Submit Application</button>
    </form>
</div>

</body>
</html>