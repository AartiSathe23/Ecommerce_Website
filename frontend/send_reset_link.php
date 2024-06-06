<?php
session_start();
include 'db.php'; // Include your database connection file

$email = $_POST['email'];

$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
if (!$stmt->execute()) {
    // Handle database query execution error
    $_SESSION['error'] = "Error executing database query.";
    header("Location: forgot_password.html");
    exit();
}
$stmt->store_result();

if ($stmt->num_rows > 0) {
    // Generate a unique token
    $token = bin2hex(random_bytes(32));

    // Store token in the database
    $stmt = $conn->prepare("UPDATE users SET reset_token = ?, reset_token_expire = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE email = ?");
    $stmt->bind_param("ss", $token, $email);
    if (!$stmt->execute()) {
        // Handle database update error
        $_SESSION['error'] = "Error updating database.";
        header("Location: forgot_password.html");
        exit();
    }

    // Send reset link to the user's email
    $reset_link = "http://example.com/reset_password.php?token=$token";
    // Mail function or library to send the email
    if (!mail($email, "Password Reset Link", "Click the link to reset your password: $reset_link")) {
        // Handle email sending error
        $_SESSION['error'] = "Error sending email.";
        header("Location: forgot_password.html");
        exit();
    }

    $_SESSION['message'] = "Password reset link has been sent to your email.";
} else {
    $_SESSION['error'] = "No user found with that email address.";
}

header("Location: forgot_password.html");
exit();
?>
