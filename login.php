<?php
session_start();

// Load credentials
$creds = include 'credentials.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $creds['username'] && $password === $creds['password']) {
        $_SESSION['admin'] = true;
        header("Location: dashboard.php");
        exit();
    } else {
        echo "<script>alert('Invalid Login'); window.location='index.html';</script>";
    }
}
?>
