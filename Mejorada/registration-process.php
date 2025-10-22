<?php
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $user_password = $_POST['user_password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($user_password != $confirm_password) {
        echo "<script>alert('Passwords do not match!');</script>";
    } else {
        // check if user already exists
        $check_user = "SELECT * FROM tbluser WHERE full_name='$full_name'";
        $result = $conn->query($check_user);

        if ($result->num_rows > 0) {
            echo "<script>alert('User already exists!');</script>";
        } else {
            // Hash password for security
            $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);

            // Insert new user
            $sql = "INSERT INTO tbluser (full_name, user_password) VALUES ('$full_name', '$hashed_password')";

            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Registration successful! Redirecting to login...');</script>";
                echo "<script>window.location='login.php';</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}

$conn->close();
?>