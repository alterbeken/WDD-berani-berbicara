<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode([]);
    exit();
}
include 'db_connection.php';

// Hanya kolom yang memang ditampilkan. Email dan nomor telepon penulis TIDAK dikirim ke browser.
$result = $conn->query("SELECT id, name, problem, created_at FROM storyboard ORDER BY created_at DESC");

$stories = [];
while ($row = $result->fetch_assoc()) {
    $stories[] = $row;
}

$conn->close();

header('Content-Type: application/json; charset=utf-8');
echo json_encode($stories);
