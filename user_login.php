<?php
session_start();
include('db_connection.php');
include('admin_config.php');

$error_message = null;
$registered = $_GET['registered'] ?? null;
$account_type = (($_POST['account_type'] ?? ($registered === 'admin' ? 'admin' : 'user')) === 'admin') ? 'admin' : 'user';
$code_error = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    if (!$user || !password_verify($password, $user['password'])) {
        $error_message = "Email atau kata sandi salah. Periksa lagi, lalu coba masuk kembali.";
    } else {
        $is_admin_account = ($user['role'] === 'admin');

        if ($account_type === 'admin' && !$is_admin_account) {
            $error_message = "Akun ini bukan akun admin. Pilih \"Pengguna\" untuk masuk.";
        } elseif ($account_type === 'user' && $is_admin_account) {
            $error_message = "Akun admin harus masuk lewat pilihan \"Admin\" dengan kode admin.";
        } elseif ($account_type === 'admin' && !admin_code_ok($_POST['admin_code'] ?? '')) {
            $code_error = "Kode admin salah. Klik \"Tampilkan\" untuk memeriksa yang kamu ketik.";
            $error_message = "Login admin belum berhasil. Periksa kolom yang ditandai merah.";
        } else {
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            $_SESSION['user_level'] = $user['user_level'];
            $_SESSION['role'] = $user['role'];

            header("Location: " . ($is_admin_account ? "admin_dashboard.php" : "index.php"));
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Masuk - Berani Berbicara</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/auth.css">
</head>
<body>
    <main class="min-vh-100 d-flex align-items-center justify-content-center p-3">
        <div class="auth-card w-100">
            <div class="row g-0">
                <section class="col-lg-5 brand-panel">
                    <div class="logo-plate"><img src="img/logo.png" alt="Logo Berani Berbicara"></div>
                    <h2>Kamu tidak perlu menghadapinya sendirian.</h2>
                    <p>Laporkan bullying, ceritakan pengalamanmu, atau buat janji konsultasi dengan psikolog.</p>
                    <svg class="bubble" viewBox="0 0 200 180" aria-hidden="true" fill="none" stroke="#fff" stroke-width="10">
                        <path d="M30 20h140a14 14 0 0 1 14 14v84a14 14 0 0 1-14 14H90l-40 32v-32H30a14 14 0 0 1-14-14V34a14 14 0 0 1 14-14z"/>
                    </svg>
                </section>

                <section class="col-lg-7 form-panel">
                    <h1>Masuk ke akunmu</h1>
                    <p class="mb-4">Pilih jenis akun, lalu masukkan email dan kata sandi.</p>

                    <?php if ($registered && !$_POST): ?>
                        <div class="msg msg-ok mb-3" role="status">
                            <?php echo $registered === 'admin'
                                ? 'Akun admin berhasil dibuat. Masuk dengan email, kata sandi, dan kode admin.'
                                : 'Akun berhasil dibuat. Silakan masuk.'; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($error_message): ?>
                        <div class="msg msg-error mb-3" role="alert"><?php echo htmlspecialchars($error_message); ?></div>
                    <?php endif; ?>

                    <form action="user_login.php" method="POST">
                        <div class="role-switch mb-1" role="radiogroup" aria-label="Jenis akun">
                            <input type="radio" name="account_type" id="type-user" value="user" <?php echo $account_type === 'user' ? 'checked' : ''; ?>>
                            <label for="type-user">Pengguna</label>
                            <input type="radio" name="account_type" id="type-admin" value="admin" <?php echo $account_type === 'admin' ? 'checked' : ''; ?>>
                            <label for="type-admin">Admin</label>
                        </div>
                        <p class="role-hint mb-3">Admin membutuhkan kode admin yang hanya dimiliki pengelola.</p>

                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" autocomplete="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
                            <label for="email">Email</label>
                        </div>
                        <div class="form-floating mb-3 position-relative">
                            <input type="password" class="form-control has-toggle" id="password" name="password" placeholder="Kata sandi" autocomplete="current-password" required>
                            <label for="password">Kata sandi</label>
                            <button type="button" class="toggle-pass" data-target="password" data-label="kata sandi">Tampilkan</button>
                        </div>
                        <div class="mb-3" id="adminCodeBox" <?php echo $account_type === 'admin' ? '' : 'hidden'; ?>>
                            <div class="form-floating position-relative">
                                <input type="password" class="form-control has-toggle<?php echo $code_error ? ' is-invalid' : ''; ?>" id="admin_code" name="admin_code" placeholder="Kode admin" autocomplete="off">
                                <label for="admin_code">Kode admin</label>
                                <button type="button" class="toggle-pass" data-target="admin_code" data-label="kode admin">Tampilkan</button>
                            </div>
                            <?php if ($code_error): ?><div class="field-error" role="alert"><?php echo htmlspecialchars($code_error); ?></div><?php endif; ?>
                        </div>
                        <button type="submit" name="submit" class="btn btn-auth w-100 mt-2">Masuk</button>
                    </form>

                    <p class="text-center mt-4 mb-0">Belum punya akun? <a href="user_register.php">Daftar di sini</a></p>
                </section>
            </div>
        </div>
    </main>

    <script>
        document.querySelectorAll('.toggle-pass').forEach(function (b) {
            b.addEventListener('click', function () {
                var input = document.getElementById(b.dataset.target);
                var hide = input.type === 'password';
                input.type = hide ? 'text' : 'password';
                b.textContent = hide ? 'Sembunyikan' : 'Tampilkan';
                b.setAttribute('aria-label', (hide ? 'Sembunyikan ' : 'Tampilkan ') + b.dataset.label);
            });
        });

        var box = document.getElementById('adminCodeBox');
        var code = document.getElementById('admin_code');
        function syncType() {
            var isAdmin = document.getElementById('type-admin').checked;
            box.hidden = !isAdmin;
            code.required = isAdmin;
            if (!isAdmin) { code.value = ''; }
        }
        document.querySelectorAll('input[name="account_type"]').forEach(function (r) { r.addEventListener('change', syncType); });
        syncType();

        var bad = document.querySelector('.is-invalid');
        if (bad) { bad.focus(); }
        else if (!document.querySelector('.msg-error')) { document.getElementById('email').focus(); }
        else { document.getElementById('password').focus(); }
    </script>
</body>
</html>
