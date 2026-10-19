<?php
// Kode admin disimpan sebagai HASH (bukan teks asli), jadi isi file ini tidak membocorkan kodenya.
// Kode asli hanya diketahui admin. Untuk mengganti kode, jalankan di terminal:
//   C:\xampp\php\php.exe -r "echo password_hash('KODE_BARU', PASSWORD_DEFAULT);"
// lalu tempel hasilnya ke ADMIN_CODE_HASH di bawah.
define('ADMIN_CODE_HASH', '$2y$10$iIw016rFJFXVZujLb.W.ZO.iNcl6lRgnH1afKG91t6AfUdpB/VYJe');

function admin_code_ok($code) {
    return is_string($code) && $code !== '' && password_verify($code, ADMIN_CODE_HASH);
}
