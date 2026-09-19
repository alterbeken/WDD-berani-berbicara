<?php
session_start();
include('db_connection.php'); // Pastikan file ini menghubungkan ke database

if (!isset($_SESSION['user_id'])) {
    header("Location: user_login.php");
    exit();
}

// Ambil user_id dari session
$user_id = $_SESSION['user_id'];

// Ambil data dari form
$name = $_POST['name'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$doctor_choice = $_POST['doctor_choice'];
$report_date = $_POST['report_date'];
$report_time = $_POST['report_time'];
$description = $_POST['description'];

// Validasi data (opsional, disarankan untuk keamanan)
if (empty($name) || empty($email) || empty($description)) {
    die("All required fields must be filled.");
}

// Simpan data ke tabel `reports`
$query = "INSERT INTO reports (user_id, name, email, mobile, doctor_choice, report_date, report_time, description)
          VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("isssssss", $user_id, $name, $email, $mobile, $doctor_choice, $report_date, $report_time, $description);

if ($stmt->execute()) {
    echo "Report submitted successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
