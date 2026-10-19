<?php require 'auth_guard.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>User Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700;900&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <?php include 'navbar.php'; ?>

    <!-- Profile Section -->
    <div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" height="150px" alt="Foto profil" src="data:image/svg+xml;utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 150 150'%3E%3Crect width='150' height='150' fill='%23dbe6f7'/%3E%3Ccircle cx='75' cy='58' r='28' fill='%230047ab' opacity='.55'/%3E%3Cpath d='M20 150a55 55 0 0 1 110 0z' fill='%230047ab' opacity='.55'/%3E%3C/svg%3E"><span class="font-weight-bold mt-2" id="cardName"></span><span class="text-black-50" id="cardEmail"></span></div>
        </div>
        <div class="col-md-5 border-right">
    <div class="p-3 py-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="text-right">Profile Settings</h4>
        </div>
        <div id="profileMessage"></div>
        <div class="row mt-2">
            <div class="col-md-6"><label class="labels">First Name</label><input type="text" id="first_name" class="form-control" placeholder="first name"></div>
            <div class="col-md-6"><label class="labels">Last Name</label><input type="text" id="last_name" class="form-control" placeholder="last name"></div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12"><label class="labels">Email</label><input type="email" id="email" class="form-control" disabled></div>
        </div>
        <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button" id="saveProfileBtn">Save Profile</button></div>
    </div>
</div>
    </div>
</div>

<script>
fetch('fetch_profile.php')
    .then(res => res.json())
    .then(data => {
        if (!data.error) {
            document.getElementById('first_name').value = data.first_name;
            document.getElementById('last_name').value = data.last_name;
            document.getElementById('email').value = data.email;
            document.getElementById('cardName').textContent = data.first_name + ' ' + data.last_name;
            document.getElementById('cardEmail').textContent = data.email;
        }
    });

document.getElementById('saveProfileBtn').addEventListener('click', function() {
    const formData = new FormData();
    formData.append('first_name', document.getElementById('first_name').value);
    formData.append('last_name', document.getElementById('last_name').value);

    fetch('save_profile.php', { method: 'POST', body: formData })
        .then(res => res.json())
        .then(data => {
            const msg = document.getElementById('profileMessage');
            if (data.success) {
                msg.innerHTML = "<div class='alert alert-success'>Profil berhasil diperbarui!</div>";
                document.getElementById('cardName').textContent = document.getElementById('first_name').value + ' ' + document.getElementById('last_name').value;
            } else {
                msg.textContent = "Gagal: " + data.error; msg.className = "alert alert-danger";
            }
        });
});
</script>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>