<?php require 'auth_guard.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Tell Your Story</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/logo.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700;900&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Navbar Start -->
    <?php include 'navbar.php'; ?>
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Tell Your Story  </h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb text-uppercase mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="index.php">Home</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Tell Your Story</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Appointment Start -->
    <div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <!-- Formulir -->
            <div class="col-lg-6">
                <div class="bg-light rounded h-100 d-flex align-items-center p-5">
                    <form id="storyForm">
                        <div class="row g-3">
                            <div class="col-12">
                                <textarea name="problem" class="form-control border-0" rows="6" maxlength="1000" placeholder="Ceritakan pengalamanmu (maksimal 1000 karakter)" required></textarea>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="anonymous" value="1" id="anonymous">
                                    <label class="form-check-label" for="anonymous">Tampilkan sebagai Anonim</label>
                                </div>
                                <small class="text-muted d-block mt-1" id="authorHint" data-named="Ceritamu akan tampil dengan nama: <?php echo htmlspecialchars(story_author_name()); ?>" data-anon="Ceritamu akan tampil sebagai Anonim. Namamu tidak ditampilkan.">Ceritamu akan tampil dengan nama: <?php echo htmlspecialchars(story_author_name()); ?></small>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit">Kirim Cerita</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Storyboard -->
            <div class="col-lg-6">
                <div class="bg-light rounded h-100 p-5" style="overflow-y: auto; max-height: 500px;">
                    <h4 class="mb-4">Stories</h4>
                    <div id="storyboardContainer">
                        <!-- Stories akan dimuat secara dinamis -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Petunjuk nama penulis mengikuti centang Anonim
    $('#anonymous').on('change', function () {
        var hint = $('#authorHint');
        hint.text(this.checked ? hint.data('anon') : hint.data('named'));
    });

    // Submit story form
    $('#storyForm').on('submit', function (e) {
        e.preventDefault();
        $.post('submit_story.php', $(this).serialize(), function (response) {
            alert(response);
            loadStories();
            $('#storyForm')[0].reset();
            $('#anonymous').trigger('change');
        }).fail(function (xhr) {
            alert(xhr.responseText || 'Gagal mengirim cerita. Silakan coba lagi.');
        });
    });

    // Escape teks dari pengguna sebelum ditampilkan sebagai HTML
    function esc(text) {
        return $('<div>').text(text == null ? '' : String(text)).html();
    }

    // Load stories
    function loadStories() {
        $.getJSON('fetch_stories.php', function (data) {
            let html = '';
            data.forEach(story => {
                html += `
                    <div class="border rounded p-3 mb-3">
                        <h5>${esc(story.name)}</h5>
                        <small class="text-muted">${esc(story.created_at)}</small>
                        <p class="mt-2" style="white-space: pre-line;">${esc(story.problem)}</p>
                    </div>
                `;
            });
            $('#storyboardContainer').html(html);
        });
    }

    // Load stories on page load
    loadStories();
</script>
    <!-- Appointment End -->
        

    <?php include 'footer.php'; ?>


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>