<?php
include 'db_connection.php';

$result = $conn->query("SELECT * FROM storyboard ORDER BY created_at DESC");

$stories = [];
while ($row = $result->fetch_assoc()) {
    $stories[] = $row;
}

$conn->close();

echo json_encode($stories);
?>
