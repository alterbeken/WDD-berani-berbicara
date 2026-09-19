
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
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold">Edogaru</span><span class="text-black-50">edogaru@mail.com.my</span><span> </span></div>
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

<script>
fetch('fetch_profile.php')
    .then(res => res.json())
    .then(data => {
        if (!data.error) {
            document.getElementById('first_name').value = data.first_name;
            document.getElementById('last_name').value = data.last_name;
            document.getElementById('email').value = data.email;
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
            } else {
                msg.innerHTML = "<div class='alert alert-danger'>Gagal: " + data.error + "</div>";
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