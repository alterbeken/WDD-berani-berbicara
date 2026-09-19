<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register User</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <script src="verify.js"> </script>
</head>

<body>
    <div class="container" style="margin-top:30px">
        

        <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <!-- Form Section -->
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="bg-light rounded p-5">
                        <p class="d-inline-block border rounded-pill py-1 px-4">Welcome</p>
                        <h1 class="mb-4">Register New User</h1>

                        <form action="" method="POST">
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" required>
                                        <label for="first_name"></label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" required>
                                        <label for="last_name"></label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" required>
                                        <label for="email"></label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                        <label for="password"></label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" id="user_level" name="user_level" placeholder="User Level" required>
                                        <label for="user_level"></label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" name="submit" class="btn btn-primary w-100 py-3">REGISTER</button>
                                </div>
                            </div>
                        </form>
                        <p class="text-center mt-3">Already have an account? <a href="user_login.php">Login here</a></p>
                    </div>
                </div>

                <!-- Image Section -->
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <div class="h-100" style="min-height: 400px;">
                        <img class="img-fluid rounded w-100 h-100" src="img/logo.png" alt="Registration Image">
                    </div>
                </div>
            </div>
        </div>
    </div>

                <?php
                include 'db_connection.php'; 

                if (isset($_POST['submit'])) {
                    $first_name = $_POST['first_name'];
                    $last_name = $_POST['last_name'];
                    $email = $_POST['email'];
                    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $user_level = $_POST['user_level'];

                    $query = "INSERT INTO users (first_name, last_name, email, password, user_level, role) VALUES ('$first_name', '$last_name', '$email', '$password', '$user_level', 'member')";
                    
                    if (mysqli_query($conn, $query)) {
                        header("refresh:2;url=user_login.php");
                            echo "<div class='alert alert-success text-center'>Registration successful! Redirecting to login...</div>";
                    } else {
                        echo "<div class='alert alert-danger text-center'>Error: " . mysqli_error($conn) . "</div>";
                    }
                }
                ?>
            </div>
        </div>

        <footer class="text-center mt-5">
           
        </footer>
    </div>
</body>
</html>