<?php
session_start();
require_once 'server/DB.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['verify_otp'])) {
    $entered_otp = $_POST['otp'];
    
    if (!isset($_SESSION['otp']) || !isset($_SESSION['temp_user'])) {
        echo "<script>alert('Session expired. Please register again.'); window.location='register.php';</script>";
        exit();
    }

    // Check if OTP matches
    if ($entered_otp == $_SESSION['otp']) {
        $user = $_SESSION['temp_user'];
        $stmt = $conn->prepare("INSERT INTO users (name, email, username, password) VALUES (?, ?, ?, ?)");
        if ($stmt->execute([$user['name'], $user['email'], $user['username'], $user['password']])) {
            $_SESSION['user'] = $user['username'];
            
            // Clear session OTP data after successful registration
            unset($_SESSION['otp']);
            unset($_SESSION['temp_user']);

            header("Location: chat.php");
            exit();
        } else {
            echo "<script>alert('Registration failed. Try again.');</script>";
        }
    } else {
        echo "<script>alert('Invalid OTP. Try again.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
</head>
<body>
    <h2>Enter OTP</h2>
    <form method="POST">
        <input type="text" name="otp" placeholder="Enter OTP" required>
        <button type="submit" name="verify_otp">Verify</button>
    </form>
</body>
</html>
