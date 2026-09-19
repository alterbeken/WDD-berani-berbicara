<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    die('User not logged in');
}

$host = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "admin_db1"; 

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];

    $sql = "UPDATE users SET first_name='$first_name', last_name='$last_name', email='$email' WHERE id=$user_id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Profile updated successfully";
        $_SESSION['first_name'] = $first_name;
        $_SESSION['last_name'] = $last_name;
        $_SESSION['email'] = $email;
    } else {
        echo "Error updating profile: " . $conn->error;
    }
}

$conn->close();
?>
