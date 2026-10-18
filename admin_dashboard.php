<?php
session_start();
include('db_connection.php');

// Hanya admin yang boleh membuka halaman ini (role dicek langsung dari database).
if (!isset($_SESSION['user_id'])) {
    header("Location: user_login.php");
    exit();
}
$stmt = $conn->prepare("SELECT role FROM users WHERE user_id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$me = $stmt->get_result()->fetch_assoc();
if (!$me || $me['role'] !== 'admin') {
    http_response_code(403);
    die("Akses ditolak. Halaman ini khusus admin. <a href='index.php'>Kembali ke Home</a>");
}

function h($v) { return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }

function count_rows($conn, $table) {
    $r = $conn->query("SELECT COUNT(*) AS c FROM `$table`");
    return $r ? (int)$r->fetch_assoc()['c'] : 0;
}

function render_table($conn, $sql, $empty_text) {
    $res = $conn->query($sql);
    if (!$res) { echo "<div class='alert alert-danger'>Query gagal: " . h($conn->error) . "</div>"; return; }
    if ($res->num_rows === 0) { echo "<p class='text-muted p-3 mb-0'>" . h($empty_text) . "</p>"; return; }
    $fields = $res->fetch_fields();
    echo "<div class='table-responsive'><table class='table table-striped table-hover align-middle mb-0'><thead class='table-primary'><tr>";
    foreach ($fields as $f) { echo "<th>" . h($f->name) . "</th>"; }
    echo "</tr></thead><tbody>";
    while ($row = $res->fetch_assoc()) {
        echo "<tr>";
        foreach ($row as $val) { echo "<td>" . nl2br(h($val)) . "</td>"; }
        echo "</tr>";
    }
    echo "</tbody></table></div>";
}

$tabs = [
    'users'        => ['Pengguna',  "SELECT user_id, first_name, last_name, email, user_level, role FROM users ORDER BY 1 DESC", 'Belum ada pengguna.', 'users'],
    'reports'      => ['Laporan Bullying', "SELECT * FROM reports ORDER BY 1 DESC", 'Belum ada laporan masuk.', 'reports'],
    'appointments' => ['Booking Konsultasi', "SELECT * FROM appointments ORDER BY 1 DESC", 'Belum ada booking.', 'appointments'],
    'storyboard'   => ['Cerita', "SELECT * FROM storyboard ORDER BY 1 DESC", 'Belum ada cerita.', 'storyboard'],
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin - Berani Berbicara</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-primary px-3">
        <span class="navbar-brand mb-0 h1">Berani Berbicara! - Admin</span>
        <div>
            <a class="btn btn-sm btn-light me-2" href="index.php">Home</a>
            <a class="btn btn-sm btn-outline-light" href="logout.php">Logout</a>
        </div>
    </nav>

    <main class="container py-4">
        <h1 class="h3 mb-4">Dashboard Admin</h1>

        <div class="row g-3 mb-4">
            <?php foreach ($tabs as $key => $t): ?>
                <div class="col-6 col-lg-3">
                    <div class="card text-center h-100"><div class="card-body">
                        <div class="display-6 fw-bold text-primary"><?php echo count_rows($conn, $t[3]); ?></div>
                        <div class="text-muted"><?php echo h($t[0]); ?></div>
                    </div></div>
                </div>
            <?php endforeach; ?>
        </div>

        <ul class="nav nav-tabs" role="tablist">
            <?php $first = true; foreach ($tabs as $key => $t): ?>
                <li class="nav-item"><button class="nav-link<?php echo $first ? ' active' : ''; ?>" data-bs-toggle="tab" data-bs-target="#tab-<?php echo $key; ?>" type="button"><?php echo h($t[0]); ?></button></li>
            <?php $first = false; endforeach; ?>
        </ul>
        <div class="tab-content bg-white border border-top-0 rounded-bottom">
            <?php $first = true; foreach ($tabs as $key => $t): ?>
                <div class="tab-pane fade<?php echo $first ? ' show active' : ''; ?>" id="tab-<?php echo $key; ?>">
                    <?php render_table($conn, $t[1], $t[2]); ?>
                </div>
            <?php $first = false; endforeach; ?>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
