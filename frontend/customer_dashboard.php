<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'customer') {
    header('Location: login.php');
    exit();
}

echo "Welcome to the customer dashboard!";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Dashboard</title>
</head>
<body>
    <h1>Customer Dashboard</h1>
    <a href="logout.php">Logout</a>
</body>
</html>
