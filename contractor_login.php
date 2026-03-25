<?php
session_start();
include "connect.php";

if(isset($_POST['email']) && isset($_POST['password'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM contractors WHERE email=? AND password=?");

    if(!$stmt){
        die("SQL Error: " . $conn->error);
    }

    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();

        // ✅ SESSION SET
        $_SESSION['contractor_phone'] = $row['phone'];

        // ✅ DEBUG (TEMPORARY)
        // print_r($_SESSION); exit();

        header("Location: contractor_dashboard.php");
        exit();
    } else {
        echo "Invalid Email or Password";
    }
}
?>