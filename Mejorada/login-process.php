<?php
include 'db_connect.php';

// when login form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $user_password = $_POST['user_password'];

    // Check user
    $sql = "SELECT * FROM tbluser WHERE full_name='$full_name' AND user_password='$user_password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Successful login
        $_SESSION['full_name'] = $full_name;
        header("Location: welcome.php");
        exit();
    } else {
        echo "<script>alert('Invalid Username or Password');</script>";
    }
}

$conn->close();
?>