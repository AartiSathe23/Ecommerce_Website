<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.html"); 
    exit;
}

// Set session variables for demonstration purposes
$_SESSION['phone_number'] = "9356121425";
$_SESSION['username'] = "aartisathet212@gmail.com";

// These fields can be set through a form or some other means
$_SESSION['name'] = isset($_SESSION['name']) ? $_SESSION['name'] : "- not added -";
$_SESSION['dob'] = isset($_SESSION['dob']) ? $_SESSION['dob'] : "- not added -";
$_SESSION['alt_phone'] = isset($_SESSION['alt_phone']) ? $_SESSION['alt_phone'] : "- not added -";
$_SESSION['hint_name'] = isset($_SESSION['hint_name']) ? $_SESSION['hint_name'] : "- not added -";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }
        .sidebar {
            width: 250px;
            background-color: #fff;
            position: fixed;
            height: 100%;
            overflow: auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .sidebar a {
            display: block;
            color: black;
            padding: 16px;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #ddd;
        }
        .main {
            margin-left: 260px; /* Same as the width of the sidebar */
            padding: 16px;
            overflow: hidden;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .profile-info {
            margin-bottom: 20px;
        }
        .profile-info label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        .profile-info span {
            display: block;
            margin-bottom: 10px;
        }
        .edit-btn {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #4CAF50;
            color: #fff;
            text-align: center;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .edit-btn:hover {
            background-color: #45a049;
        }
        .logout-btn {
            display: block;
            width: 80%;
            padding: 10px;
            margin-top: 20px;
            background-color: #f44336;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
        }
        .logout-btn:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <header>
        <h1>User Profile</h1>
    </header>
    <div class="sidebar">
        <a href="orders.php">My Orders</a>
        <a href="profile.php">Profile Information</a>
        <a href="addresses.php">Manage Addresses</a>
        <a href="pan_info.php">PAN Card Information</a>
        <a href="payments.php">Gift Cards</a>
        <a href="payments.php">Saved UPI</a>
        <a href="payments.php">Saved Cards</a>
        <a href="coupons.php">My Coupons</a>
        <a href="reviews.php">My Reviews & Ratings</a>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
    <div class="main">
        <div class="container">
            <div class="profile-info">
                <label>Full Name:</label>
                <span><?php echo $_SESSION['name']; ?></span>
            </div>
            <div class="profile-info">
                <label>Mobile Number:</label>
                <span><?php echo $_SESSION['phone_number']; ?></span>
            </div>
            <div class="profile-info">
                <label>Email ID:</label>
                <span><?php echo $_SESSION['username']; ?></span>
            </div>
            <div class="profile-info">
                <label>Date of Birth:</label>
                <span><?php echo $_SESSION['dob']; ?></span>
            </div>
            <div class="profile-info">
                <label>Alternate Mobile:</label>
                <span><?php echo $_SESSION['alt_phone']; ?></span>
            </div>
            <div class="profile-info">
                <label>Hint Name:</label>
                <span><?php echo $_SESSION['hint_name']; ?></span>
            </div>
            <a href="edit_profile.php" class="edit-btn">Edit Profile</a>
        </div>
    </div>
</body>
</html>
