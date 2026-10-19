<?php
// Halaman yang meng-include file ini hanya bisa dibuka setelah login.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header("Location: user_login.php");
    exit();
}

// Helper teks (tanpa bergantung pada ekstensi mbstring)
if (!function_exists('text_length')) {
    function text_length($text) {            // jumlah karakter (UTF-8)
        return (int)preg_match_all('/./us', $text);
    }
}

// Nama yang ditampilkan di cerita: nama depan + inisial nama belakang (contoh: "Budi S.")
if (!function_exists('story_author_name')) {
    function story_author_name() {
        $first = trim($_SESSION['first_name'] ?? '');
        $last = trim($_SESSION['last_name'] ?? '');
        $initial = '';
        if ($last !== '' && preg_match('/^./us', $last, $m)) {
            $initial = ' ' . strtoupper($m[0]) . '.';
        }
        $name = trim($first . $initial);
        return $name !== '' ? $name : 'Pengguna';
    }
}
