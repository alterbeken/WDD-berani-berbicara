<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Profile</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="css/style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <!-- Navbar -->
    <?php include 'navbar.php'; ?>

    <!-- Profile Section -->
    <div class="container py-5">
        <div class="text-center">
            <h1 class="mb-4">My Profile</h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form id="profileForm">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" class="form-control" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" id="first_name" name="first_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" id="last_name" name="last_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="user_level" class="form-label">User Level</label>
                        <input type="text" id="user_level" class="form-control" disabled>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            // Fetch profile data
            $.getJSON('process/fetch_profile.php', function (data) {
                if (data.error) {
                    alert(data.error);
                } else {
                    $('#email').val(data.email);
                    $('#first_name').val(data.first_name);
                    $('#last_name').val(data.last_name);
                    $('#user_level').val(data.user_level);
                }
            });

            // Update profile
            $('#profileForm').on('submit', function (e) {
                e.preventDefault();
                $.post('process/update_profile.php', $(this).serialize(), function (data) {
                    const response = JSON.parse(data);
                    if (response.success) {
                        alert('Profile updated successfully!');
                    } else {
                        alert('Error: ' + response.error);
                    }
                });
            });
        });
    </script>
</body>

</html>
