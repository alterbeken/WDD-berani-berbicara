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
$description = $_POST['description'];

if (empty($name) || empty($email) || empty($description)) {
    die("All required fields must be filled.");
}

$query = "INSERT INTO reports (user_id, name, email, mobile, description) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("issss", $user_id, $name, $email, $mobile, $description);

if ($stmt->execute()) {
    header("refresh:2;url=login_session_user.php");
    echo "<div style='background:#d4edda;color:#155724;padding:20px;margin:20px;border-radius:8px;font-family:sans-serif;text-align:center;'>Laporan kamu berhasil dikirim! Mengalihkan...</div>";
} else {
    echo "<div style='background:#f8d7da;color:#721c24;padding:20px;margin:20px;border-radius:8px;font-family:sans-serif;text-align:center;'>Error: " . $stmt->error . "</div>";
}

$stmt->close();
$conn->close();
?>