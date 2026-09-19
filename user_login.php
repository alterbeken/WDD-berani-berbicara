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
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
        $_SESSION['user_level'] = $user['user_level'];

        if ($user['role'] == "admin") {
            header("Location: admin_view_users.php");
        } elseif ($user['role'] == "member") {
            header("Location: login_session_user.php");
        }
        exit(); 
    } else {
        $error_message = "Email or password is incorrect.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container" style="margin-top:30px">
        <header >
            
        </header>

        <div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="bg-light rounded p-5">
                    <p class="d-inline-block border rounded-pill py-1 px-4">Welcome</p>
                    <h1 class="mb-4">Please Login First</h1>
                    <?php if (isset($error_message)): ?>
                        <p class="text-danger text-center"><?php echo $error_message; ?></p>
                    <?php endif; ?>
                    <form action="user_login.php" method="POST">
                        <div class="row g-3">
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
                                <button type="submit" name="submit" class="btn btn-primary w-100 py-3">LOGIN</button>
                            </div>
                        </div>
                    </form>
                    <p class="text-center mt-3">Don't have an account? <a href="user_register.php">Register here</a></p>
                </div>
            </div>
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <div class="h-100" style="min-height: 400px;">
                    <iframe class="rounded w-100 h-100"
                    
                            <img class="img-fluid" src="img/logo.png" alt="">
                        
                </div>
            </div>
        </div>
    </div>
</div>

        <footer class="text-center mt-5">
            
        </footer>
    </div>
</body>
</html>