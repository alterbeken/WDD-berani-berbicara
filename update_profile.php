<?php
session_start();
include '../db_connection.php';

$user_id = $_SESSION['user_id']; // Assume user_id is stored in session
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];

$sql = "UPDATE users SET first_name = ?, last_name = ? WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssi", $first_name, $last_name, $user_id);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => $conn->error]);
}
?>
