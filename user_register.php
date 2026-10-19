<?php
session_start();
include('db_connection.php');
include('admin_config.php');

$errors = [];
$email_taken = false;
$old = ['first_name' => '', 'last_name' => '', 'email' => ''];
$account_type = (($_POST['account_type'] ?? 'user') === 'admin') ? 'admin' : 'user';

function field_class($errors, $key) { return isset($errors[$key]) ? ' is-invalid' : ''; }
function field_error($errors, $key) {
    if (isset($errors[$key])) {
        echo '<div class="field-error" role="alert">' . htmlspecialchars($errors[$key]) . '</div>';
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $old['first_name'] = trim($_POST['first_name'] ?? '');
    $old['last_name']  = trim($_POST['last_name'] ?? '');
    $old['email']      = trim($_POST['email'] ?? '');
    $password          = $_POST['password'] ?? '';
    $confirm           = $_POST['confirm_password'] ?? '';

    if ($old['first_name'] === '') { $errors['first_name'] = "Nama depan wajib diisi."; }
    if ($old['last_name'] === '')  { $errors['last_name'] = "Nama belakang wajib diisi."; }
    if (!filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Format email tidak valid.";
    }
    if (strlen($password) < 8) {
        $errors['password'] = "Kata sandi minimal 8 karakter.";
    }
    if ($password !== $confirm) {
        $errors['confirm_password'] = "Konfirmasi kata sandi belum sama dengan kata sandi di atas.";
    }
    if ($account_type === 'admin' && !admin_code_ok($_POST['admin_code'] ?? '')) {
        $errors['admin_code'] = "Kode admin salah. Klik \"Tampilkan\" untuk memeriksa yang kamu ketik.";
    }

    if (!isset($errors['email'])) {
        $check = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
        $check->bind_param("s", $old['email']);
        $check->execute();
        if ($check->get_result()->num_rows > 0) {
            $errors['email'] = "Email ini sudah terdaftar. Gunakan email lain, atau masuk jika itu akunmu.";
            $email_taken = true;
        }
    }

    if (!$errors) {
        $role = ($account_type === 'admin') ? 'admin' : 'member';
        $user_level = ($account_type === 'admin') ? '2' : '1';
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password, user_level, role) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $old['first_name'], $old['last_name'], $old['email'], $hash, $user_level, $role);

        if ($stmt->execute()) {
            header("Location: user_login.php?registered=" . $account_type);
            exit();
        }
        $errors['form'] = "Pendaftaran gagal karena kendala server. Silakan coba lagi.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Daftar - Berani Berbicara</title>
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
                    <h2>Bergabung, lalu mulai bersuara.</h2>
                    <p>Laporkan bullying, ceritakan pengalamanmu, atau buat janji konsultasi dengan psikolog.</p>
                    <svg class="bubble" viewBox="0 0 200 180" aria-hidden="true" fill="none" stroke="#fff" stroke-width="10">
                        <path d="M30 20h140a14 14 0 0 1 14 14v84a14 14 0 0 1-14 14H90l-40 32v-32H30a14 14 0 0 1-14-14V34a14 14 0 0 1 14-14z"/>
                    </svg>
                </section>

                <section class="col-lg-7 form-panel">
                    <h1>Buat akun baru</h1>
                    <p class="mb-4">Isi data di bawah untuk mulai menggunakan Berani Berbicara.</p>

                    <?php if ($errors): ?>
                        <div class="msg msg-error mb-3" role="alert">
                            <?php echo isset($errors['form']) ? htmlspecialchars($errors['form']) : "Pendaftaran belum berhasil. Periksa kolom yang ditandai merah."; ?>
                        </div>
                    <?php endif; ?>

                    <form action="user_register.php" method="POST" novalidate>
                        <div class="role-switch mb-1" role="radiogroup" aria-label="Jenis akun">
                            <input type="radio" name="account_type" id="type-user" value="user" <?php echo $account_type === 'user' ? 'checked' : ''; ?>>
                            <label for="type-user">Pengguna</label>
                            <input type="radio" name="account_type" id="type-admin" value="admin" <?php echo $account_type === 'admin' ? 'checked' : ''; ?>>
                            <label for="type-admin">Admin</label>
                        </div>
                        <p class="role-hint mb-3">Admin membutuhkan kode admin yang hanya dimiliki pengelola.</p>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control<?php echo field_class($errors, 'first_name'); ?>" id="first_name" name="first_name" placeholder="Nama depan" value="<?php echo htmlspecialchars($old['first_name']); ?>" required>
                                    <label for="first_name">Nama depan</label>
                                </div>
                                <?php field_error($errors, 'first_name'); ?>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control<?php echo field_class($errors, 'last_name'); ?>" id="last_name" name="last_name" placeholder="Nama belakang" value="<?php echo htmlspecialchars($old['last_name']); ?>" required>
                                    <label for="last_name">Nama belakang</label>
                                </div>
                                <?php field_error($errors, 'last_name'); ?>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="email" class="form-control<?php echo field_class($errors, 'email'); ?>" id="email" name="email" placeholder="Email" autocomplete="email" value="<?php echo htmlspecialchars($old['email']); ?>" required>
                                    <label for="email">Email</label>
                                </div>
                                <?php field_error($errors, 'email'); ?>
                                <?php if ($email_taken): ?><div class="field-error"><a href="user_login.php">Masuk dengan email ini</a></div><?php endif; ?>
                            </div>
                            <div class="col-12">
                                <div class="form-floating position-relative">
                                    <input type="password" class="form-control has-toggle<?php echo field_class($errors, 'password'); ?>" id="password" name="password" placeholder="Kata sandi" autocomplete="new-password" required>
                                    <label for="password">Kata sandi (minimal 8 karakter)</label>
                                    <button type="button" class="toggle-pass" data-target="password" data-label="kata sandi">Tampilkan</button>
                                </div>
                                <?php field_error($errors, 'password'); ?>
                            </div>
                            <div class="col-12">
                                <div class="form-floating position-relative">
                                    <input type="password" class="form-control has-toggle<?php echo field_class($errors, 'confirm_password'); ?>" id="confirm_password" name="confirm_password" placeholder="Ulangi kata sandi" autocomplete="new-password" required>
                                    <label for="confirm_password">Ulangi kata sandi</label>
                                    <button type="button" class="toggle-pass" data-target="confirm_password" data-label="ulangi kata sandi">Tampilkan</button>
                                </div>
                                <div id="matchHint" class="match-hint" aria-live="polite"></div>
                                <?php field_error($errors, 'confirm_password'); ?>
                            </div>
                            <div class="col-12" id="adminCodeBox" <?php echo $account_type === 'admin' ? '' : 'hidden'; ?>>
                                <div class="form-floating position-relative">
                                    <input type="password" class="form-control has-toggle<?php echo field_class($errors, 'admin_code'); ?>" id="admin_code" name="admin_code" placeholder="Kode admin" autocomplete="off">
                                    <label for="admin_code">Kode admin</label>
                                    <button type="button" class="toggle-pass" data-target="admin_code" data-label="kode admin">Tampilkan</button>
                                </div>
                                <?php field_error($errors, 'admin_code'); ?>
                            </div>
                            <div class="col-12">
                                <button type="submit" name="submit" class="btn btn-auth w-100">Daftar</button>
                            </div>
                        </div>
                    </form>

                    <p class="text-center mt-4 mb-0">Sudah punya akun? <a href="user_login.php">Masuk di sini</a></p>
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

        var pw = document.getElementById('password');
        var cf = document.getElementById('confirm_password');
        var hint = document.getElementById('matchHint');
        function checkMatch() {
            if (cf.value === '') { hint.textContent = ''; hint.className = 'match-hint'; return; }
            var same = pw.value === cf.value;
            hint.textContent = same ? 'Kata sandi cocok.' : 'Kata sandi belum sama.';
            hint.className = 'match-hint ' + (same ? 'ok' : 'bad');
        }
        pw.addEventListener('input', checkMatch);
        cf.addEventListener('input', checkMatch);

        var firstBad = document.querySelector('.is-invalid');
        if (firstBad) { firstBad.focus(); }
    </script>
</body>
</html>
