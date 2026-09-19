<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Article</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

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
            <h1 class="display-3 text-white mb-3 animated slideInDown">Article</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb text-uppercase mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Artikel</a></li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- About Start -->
    <div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <p class="d-inline-block border rounded-pill py-1 px-4">Articles</p>
            <h1>Artikel Tentang Bullying</h1>
        </div>
        <div class="row g-4">
            <!-- Artikel 1 -->
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="article-item bg-light rounded h-100 p-4">
                    <img src="https://doktersehat.com/wp-content/uploads/2019/04/apa-itu-bullying-doktersehat.jpg" alt="Apa Itu Bullying?" class="img-fluid rounded mb-3">
                    <h4 class="mb-3">Apa Itu Bullying?</h4>
                    <p class="mb-4">Bullying adalah tindakan intimidasi atau kekerasan yang dilakukan secara berulang terhadap seseorang...</p>
                    <a class="btn btn-primary" href="https://www.halodoc.com/kesehatan/bullying" target="_blank">Read More</a>
                </div>
            </div>

            <!-- Artikel 2 -->
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="article-item bg-light rounded h-100 p-4">
                    <img src="https://imgx.sonora.id/crop/0x0:0x0/700x465/filters:format(webp):quality(50)/photo/2023/10/11/screenshot-2023-10-11-082000jpg-20231011082015.jpg" alt="Dampak Negatif Bullying" class="img-fluid rounded mb-3">
                    <h4 class="mb-3">Dampak Negatif Bullying</h4>
                    <p class="mb-4">Tindakan bullying dapat menyebabkan dampak psikologis yang serius, seperti depresi dan rendah diri...</p>
                    <a class="btn btn-primary" href="https://www.sonora.id/read/423934267/3-artikel-ilmiah-populer-tentang-bullying-singkat-dan-sesuai-strukturnya" target="_blank">Read More</a>
                </div>
            </div>

            <!-- Artikel 3 -->
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="article-item bg-light rounded h-100 p-4">
                    <img src="https://cdn1.katadata.co.id/media/images/thumb/2023/09/19/Ilustrasi_Pengertian_Bullying-2023_09_19-16_26_40_162c2dc21c85931dfd71104b6b5b273c_960x640_thumb.jpg" alt="Cara Mengatasi Bullying" class="img-fluid rounded mb-3">
                    <h4 class="mb-3">Cara Mengatasi Bullying</h4>
                    <p class="mb-4">Ada berbagai cara untuk mengatasi bullying, termasuk melaporkan kejadian tersebut dan mencari dukungan...</p>
                    <a class="btn btn-primary" href="https://katadata.co.id/lifestyle/varia/65096b1927616/pengertian-bullying-penyebab-dan-jenis-jenisnya-secara-lengkap" target="_blank">Read More</a>
                </div>
            </div>
        </div>
    </div>
</div>
        

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