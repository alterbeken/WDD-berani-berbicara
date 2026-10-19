<?php
session_start();
include 'db_connection.php';
header('Content-Type: text/plain; charset=utf-8');

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    exit('Silakan masuk terlebih dahulu.');
}
require_once 'auth_guard.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $problem = trim($_POST['problem'] ?? '');

    if ($problem === '') {
        http_response_code(422);
        exit('Cerita tidak boleh kosong.');
    }
    if (text_length($problem) > 1000) {
        http_response_code(422);
        exit('Cerita maksimal 1000 karakter.');
    }

    // Nama ditentukan server dari akun yang login (tidak bisa dipalsukan dari form).
    // Jika "Anonim" dicentang, tidak ada nama yang disimpan.
    $name = !empty($_POST['anonymous']) ? 'Anonim' : story_author_name();

    $stmt = $conn->prepare("INSERT INTO storyboard (name, problem) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $problem);

    if ($stmt->execute()) {
        echo "Cerita kamu berhasil dikirim!";
    } else {
        http_response_code(500);
        echo "Gagal mengirim cerita. Silakan coba lagi.";
    }
    $stmt->close();
}
$conn->close();
