<?php
session_start();
include('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
        $_SESSION['user_level'] = $user['user_level'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] == "admin") {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: index.php");
        }
        exit();
    } else {
        $error_message = "Email atau kata sandi salah. Periksa lagi, lalu coba masuk kembali.";
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
    <style>
        :root {
            --ink: #0b1f4b;
            --brand: #0047ab;
            --brand-deep: #00338a;
            --mist: #eef3fc;
            --line: #d5deef;
            --danger: #b3261e;
        }
        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, 'Segoe UI', sans-serif;
            background: var(--mist);
            color: var(--ink);
        }
        .auth-card {
            max-width: 980px;
            border-radius: 20px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 12px 40px rgba(11, 31, 75, 0.12);
        }
        .brand-panel {
            position: relative;
            overflow: hidden;
            background: linear-gradient(160deg, var(--brand) 0%, var(--brand-deep) 100%);
            color: #fff;
            padding: 2.5rem;
        }
        .logo-plate {
            display: inline-block;
            background: #fff;
            border-radius: 14px;
            padding: 0.75rem 1rem;
        }
        .logo-plate img { display: block; width: 190px; max-width: 100%; height: auto; }
        .brand-panel h2 { font-weight: 800; font-size: 1.75rem; line-height: 1.25; margin-top: 2rem; }
        .brand-panel p { color: rgba(255, 255, 255, 0.85); max-width: 32ch; }
        .bubble {
            position: absolute;
            right: -40px;
            bottom: -30px;
            width: 260px;
            opacity: 0.14;
        }
        .form-panel { padding: 2.5rem; }
        .form-panel h1 { font-weight: 800; font-size: 1.75rem; }
        .form-control { border-color: var(--line); border-radius: 12px; }
        .form-control:focus { border-color: var(--brand); box-shadow: 0 0 0 0.2rem rgba(0, 71, 171, 0.18); }
        .btn-login {
            background: var(--brand);
            border: 0;
            border-radius: 12px;
            font-weight: 700;
            padding: 0.9rem;
            color: #fff;
        }
        .btn-login:hover, .btn-login:focus { background: var(--brand-deep); color: #fff; }
        .toggle-pass {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            border: 0;
            background: none;
            color: var(--brand);
            font-size: 0.85rem;
            font-weight: 700;
            z-index: 5;
        }
        .error-box {
            border-left: 4px solid var(--danger);
            background: #fdecea;
            color: var(--danger);
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 0.9rem;
        }
        a { color: var(--brand); font-weight: 700; }
        @media (max-width: 991px) {
            .brand-panel, .form-panel { padding: 1.75rem; }
            .brand-panel h2 { margin-top: 1.25rem; font-size: 1.4rem; }
        }
    </style>
</head>
<body>
    <main class="min-vh-100 d-flex align-items-center justify-content-center p-3">
        <div class="auth-card w-100">
            <div class="row g-0">
                <section class="col-lg-5 brand-panel">
                    <div class="logo-plate">
                        <img src="img/logo.png" alt="Logo Berani Berbicara">
                    </div>
                    <h2>Kamu tidak perlu menghadapinya sendirian.</h2>
                    <p>Laporkan bullying, ceritakan pengalamanmu, atau buat janji konsultasi dengan psikolog.</p>
                    <svg class="bubble" viewBox="0 0 200 180" aria-hidden="true" fill="none" stroke="#fff" stroke-width="10">
                        <path d="M30 20h140a14 14 0 0 1 14 14v84a14 14 0 0 1-14 14H90l-40 32v-32H30a14 14 0 0 1-14-14V34a14 14 0 0 1 14-14z"/>
                    </svg>
                </section>

                <section class="col-lg-7 form-panel">
                    <h1>Masuk ke akunmu</h1>
                    <p class="mb-4">Masuk untuk membuat laporan atau janji konsultasi.</p>

                    <?php if (isset($error_message)): ?>
                        <div class="error-box mb-3" role="alert"><?php echo $error_message; ?></div>
                    <?php endif; ?>

                    <form action="user_login.php" method="POST">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" autocomplete="email" required autofocus>
                            <label for="email">Email</label>
                        </div>
                        <div class="form-floating mb-4 position-relative">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Kata sandi" autocomplete="current-password" required>
                            <label for="password">Kata sandi</label>
                            <button type="button" class="toggle-pass" id="togglePass" aria-label="Tampilkan kata sandi">Tampilkan</button>
                        </div>
                        <button type="submit" name="submit" class="btn btn-login w-100">Masuk</button>
                    </form>

                    <p class="text-center mt-4 mb-0">Belum punya akun? <a href="user_register.php">Daftar di sini</a></p>
                </section>
            </div>
        </div>
    </main>

    <script>
        var pass = document.getElementById('password');
        var btn = document.getElementById('togglePass');
        btn.addEventListener('click', function () {
            var hidden = pass.type === 'password';
            pass.type = hidden ? 'text' : 'password';
            btn.textContent = hidden ? 'Sembunyikan' : 'Tampilkan';
            btn.setAttribute('aria-label', hidden ? 'Sembunyikan kata sandi' : 'Tampilkan kata sandi');
        });
    </script>
</body>
</html>
