<?php
session_start();
include 'db_connection.php';

$user_id = $_SESSION['user_id']; // Assume user_id is stored in session after login

$sql = "SELECT email, first_name, last_name, user_level FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode($result->fetch_assoc());
} else {
    echo json_encode(["error" => "User not found"]);
}
?>
