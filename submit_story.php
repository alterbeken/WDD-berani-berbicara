<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $problem = $_POST['problem'];

    $stmt = $conn->prepare("INSERT INTO storyboard (name, email, mobile, problem) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $mobile, $problem);

        if ($stmt->execute()) {
    header("refresh:2;url=appointment.php");
            echo "<div style='background:#d4edda;color:#155724;padding:20px;margin:20px;border-radius:8px;font-family:sans-serif;text-align:center;'>Cerita kamu berhasil dikirim! Mengalihkan...</div>";
    } else {
            echo "<div style='background:#f8d7da;color:#721c24;padding:20px;margin:20px;border-radius:8px;font-family:sans-serif;text-align:center;'>Error: " . $stmt->error . "</div>";
    }

    $stmt->close();
    $conn->close();
}
?>
