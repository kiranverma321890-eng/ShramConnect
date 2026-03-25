<?php
session_start();
include "connect.php";

if(isset($_POST['phone'])){
    $phone = $_POST['phone'];

    $stmt = $conn->prepare("SELECT * FROM workers WHERE phone=?");
    $stmt->bind_param("s", $phone);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $_SESSION['worker_phone'] = $phone;
        header("Location: worker_dashboard.php");
        exit();
    } else {
        echo "Invalid Phone Number!";
    }
}
?>