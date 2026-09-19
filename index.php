<?php
session_start();
include('db_connection.php');


if (!isset($_SESSION['user_id'])) {
    header("Location: user_login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$query = "SELECT first_name, last_name FROM users WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Berani Berbicara</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="" rel="icon">

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


    <!-- Header Start -->
    <div class="container-fluid header bg-primary p-0 mb-5">
        <div class="row g-0 align-items-center flex-column-reverse flex-lg-row">
            <div class="col-lg-6 p-5 wow fadeIn" data-wow-delay="0.1s">
                <h1 class="display-4 text-white mb-5">AYO KITA LAWAN BULLYING!!</h1>
                <div class="row g-4">
                    <div class="col-sm-4">
                        <div class="border-start border-light ps-4">
                            <h2 class="text-white mb-1" data-toggle="counter-up">125</h2>
                            <p class="text-light mb-0">Psikolog</p>
                        </div>
                    </div>
                    
                    <div class="col-sm-4">
                        <div class="border-start border-light ps-4">
                            <h2 class="text-white mb-1" data-toggle="counter-up">12345</h2>
                            <p class="text-light mb-0">Komunitas</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <div class="owl-carousel header-carousel">
                    <div class="owl-carousel-item position-relative">
                        <img class="img-fluid" src="img/s1.png" alt="">
                        <div class="owl-carousel-text">
                            <h1 class="display-1 text-white mb-0">Verbal</h1>
                        </div>
                    </div>
                    <div class="owl-carousel-item position-relative">
                        <img class="img-fluid" src="img/s2.png" alt="">
                        <div class="owl-carousel-text">
                            <h1 class="display-1 text-white mb-0">Fisik</h1>
                        </div>
                    </div>
                    <div class="owl-carousel-item position-relative">
                        <img class="img-fluid" src="img/s3.png" alt="">
                        <div class="owl-carousel-text">
                            <h1 class="display-1 text-white mb-0">Cyber</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="d-flex flex-column">
                        <img class="img-fluid rounded w-75 align-self-end" src="img/about-2.png" alt="">
                        <img class="img-fluid rounded w-50 bg-white pt-3 pe-3" src="img/about-1.png" alt="" style="margin-top: -25%;">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <p class="d-inline-block border rounded-pill py-1 px-4">Tentang Bullying</p>
                    <h1 class="mb-4">Apakah kamu tahu apa itu Bullying?</h1>
                    <p>Bullying atau perundungan merupakan salah satu tindakan tidak terpuji yang merugikan korbannya bahkan hingga mempengaruhi kesehatan psikis korban. Parahnya kasus bullying juga kerap ditemukan di mana saja, mulai dari sekolah hingga tempat kerja.</p>
                    <p class="mb-4">Jika dibiarkan, dampak bullying bisa merugikan korban secara berkepanjangan, misalnya stres, depresi, bahkan trauma. Agar lebih lengkap, berikut penjelasan mengenai pengertian bullying, penyebab dan jenis-jenisnya.</p>
                    <a class="btn btn-primary rounded-pill py-3 px-5 mt-3" href="https://www.halodoc.com/kesehatan/bullying" target="_blank">Read More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->




    <!-- Team Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <p class="d-inline-block border rounded-pill py-1 px-4">Psikolog Kami</p>
                <h1>Daftar Psikolog</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item position-relative rounded overflow-hidden">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="img/Alter.png" alt="">
                        </div>
                        <div class="team-text bg-light text-center p-4">
                            <h5>Alter</h5>
                            <p class="text-primary">Psikolog</p>
                            <div class="team-social text-center">
                                <a class="btn btn-square" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square" href="https://www.instagram.com/ffelixlie7/"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-item position-relative rounded overflow-hidden">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="img/baben.jpg" alt="">
                        </div>
                        <div class="team-text bg-light text-center p-4">
                            <h5>Benediktus Ezra Pradipta I</h5>
                            <p class="text-primary">Psikolog</p>
                            <div class="team-social text-center">
                                <a class="btn btn-square" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="team-item position-relative rounded overflow-hidden">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="img/kevin.jpg" alt="">
                        </div>
                        <div class="team-text bg-light text-center p-4">
                            <h5>Kevin Rakhmad Fauzan</h5>
                            <p class="text-primary">Psikolog</p>
                            <div class="team-social text-center">
                                <a class="btn btn-square" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="team-item position-relative rounded overflow-hidden">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="img/jonatan.jpg" alt="">
                        </div>
                        <div class="team-text bg-light text-center p-4">
                            <h5>Jonathan Sutandi</h5>
                            <p class="text-primary">Psikolog</p>
                            <div class="team-social text-center">
                                <a class="btn btn-square" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->


    <!-- Appointment Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <p class="d-inline-block border rounded-pill py-1 px-4">Pelaporan</p>
                <h1 class="mb-4">Laporkan jika anda melihat bullying!</h1>
                <div class="bg-light rounded d-flex align-items-center p-5">
                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-white" style="width: 55px; height: 55px;">
                        <i class="fa fa-phone-alt text-primary"></i>
                    </div>
                    <div class="ms-4">
                        <p class="mb-2">Call Us Now</p>
                        <h5 class="mb-0">0812434425344</h5>
                    </div>
                </div>
                <div class="bg-light rounded d-flex align-items-center p-5">
                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-white" style="width: 55px; height: 55px;">
                        <i class="fa fa-envelope-open text-primary"></i>
                    </div>
                    <div class="ms-4">
                        <p class="mb-2">Mail Us Now</p>
                        <h5 class="mb-0">beraniberbicara@gmail.com</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="bg-light rounded h-100 p-5">
                <ul class="nav nav-pills nav-fill mb-4" id="pill-tab" role="tablist" style="border-radius: 10px; overflow: hidden;">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active w-100 py-3" data-bs-toggle="pill" data-bs-target="#pill-report" type="button">Laporkan Bullying</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link w-100 py-3" data-bs-toggle="pill" data-bs-target="#pill-appointment" type="button">Booking Konsultasi</button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="pill-report">
                        <form action="submit_report.php" method="POST">
                            <div class="row g-3">
                                <div class="col-12 col-sm-6">
                                    <input type="text" name="name" class="form-control border-0" placeholder="Your Name" style="height: 55px;" required>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="email" name="email" class="form-control border-0" placeholder="Your Email" style="height: 55px;" required>
                                </div>
                                <div class="col-12">
                                    <input type="text" name="mobile" class="form-control border-0" placeholder="Your Mobile Number" style="height: 55px;" required>
                                </div>
                                <div class="col-12">
                                    <textarea name="description" class="form-control border-0" rows="5" placeholder="Ceritakan kejadian yang kamu lihat/alami" required></textarea>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit">Submit Report</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="pill-appointment">
                        <form action="submit_appointment.php" method="POST">
                            <div class="row g-3">
                                <div class="col-12 col-sm-6">
                                    <input type="text" name="name" class="form-control border-0" placeholder="Your Name" style="height: 55px;" required>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="email" name="email" class="form-control border-0" placeholder="Your Email" style="height: 55px;" required>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="tel" name="mobile" class="form-control border-0" placeholder="Your Mobile Number" style="height: 55px;" pattern="[0-9]{10,15}" title="Nomor HP harus 10-15 digit angka" required>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <select name="doctor_choice" class="form-control border-0" style="height: 55px;" required>
                                        <option value="">Pilih Psikolog</option>
                                        <option value="Alter">Alter</option>
                                        <option value="Reef">Reef</option>
                                        <option value="Abner">Abner</option>
                                        <option value="Steve">Steve</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="date" name="appointment_date" class="form-control border-0" style="height: 55px;" required>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="time" name="appointment_time" class="form-control border-0" style="height: 55px;" required>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit">Book Consultation</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
    <script>
        if (window.location.hash === '#pill-appointment') {
            var trigger = document.querySelector('[data-bs-target="#pill-appointment"]');
            if (trigger) {
                new bootstrap.Tab(trigger).show();
                document.getElementById('pill-tab').scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }
</script>
</body>

</html>