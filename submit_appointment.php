<?php
session_start();
include('db_connection.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: user_login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$name = $_POST['name'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$doctor_choice = $_POST['doctor_choice'];
$appointment_date = $_POST['appointment_date'];
$appointment_time = $_POST['appointment_time'];

$query = "INSERT INTO appointments (user_id, name, email, mobile, doctor_choice, appointment_date, appointment_time) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("issssss", $user_id, $name, $email, $mobile, $doctor_choice, $appointment_date, $appointment_time);

if ($stmt->execute()) {
    header("refresh:2;url=login_session_user.php");
    echo "<div style='background:#d4edda;color:#155724;padding:20px;margin:20px;border-radius:8px;font-family:sans-serif;text-align:center;'>Booking konsultasi berhasil! Mengalihkan...</div>";
} else {
    echo "<div style='background:#f8d7da;color:#721c24;padding:20px;margin:20px;border-radius:8px;font-family:sans-serif;text-align:center;'>Error: " . $stmt->error . "</div>";
}

$stmt->close();
$conn->close();
?>