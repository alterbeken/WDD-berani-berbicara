<?php
if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
    session_start();
}
$current_page = basename($_SERVER['PHP_SELF']);
$is_admin = (($_SESSION['role'] ?? '') === 'admin');
function nav_active($pages, $current_page) {
    return in_array($current_page, (array)$pages) ? ' active' : '';
}
?>
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0 wow fadeIn" data-wow-delay="0.1s">
    <a href="index.php" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
        <h1 class="m-0 text-primary">Berani Berbicara!</h1>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="index.php" class="nav-item nav-link<?php echo nav_active('index.php', $current_page); ?>">Home</a>
            <a href="about.php" class="nav-item nav-link<?php echo nav_active('about.php', $current_page); ?>">Artikel</a>
            <a href="service.php" class="nav-item nav-link<?php echo nav_active('service.php', $current_page); ?>">Edukasi</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle<?php echo nav_active(['team.php', 'story.php'], $current_page); ?>" data-bs-toggle="dropdown">Pages</a>
                <div class="dropdown-menu rounded-0 rounded-bottom m-0">
                    <a href="team.php" class="dropdown-item<?php echo nav_active('team.php', $current_page); ?>">Daftar Psikolog</a>
                    <a href="story.php" class="dropdown-item<?php echo nav_active('story.php', $current_page); ?>">Tell Your Story</a>
                </div>
            </div>
            <a href="contact.php" class="nav-item nav-link<?php echo nav_active('contact.php', $current_page); ?>">Profil</a>
            <?php if ($is_admin): ?>
                <a href="admin_dashboard.php" class="nav-item nav-link<?php echo nav_active('admin_dashboard.php', $current_page); ?>">Admin</a>
            <?php endif; ?>
            <a href="logout.php" class="nav-item nav-link">Logout</a>
        </div>
        <a href="index.php#pill-appointment" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Booking Konsultasi<i class="fa fa-arrow-right ms-3"></i></a>
    </div>
</nav>
