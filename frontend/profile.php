<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: cust_login.html"); 
    exit;
}

// Set session variables for demonstration purposes
// $_SESSION['phone_number'] = "9356121425";
// $_SESSION['username'] = "aartisathet212@gmail.com";

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.0/css/boxicons.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        header {
            background-color: #535a3b;
            color: #fff;
            padding: 10px;
            text-align: center;
            font-family: 'Domine', serif;
            position: relative;
        }
        header a {
            text-decoration: none;
            color: #fff;
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            align-items: center;
        }
        header a i {
            margin-right: 5px;
        }

        .sidebar {
            font-family: 'Domine', serif;
            width: 250px;
            background-color: #cedcc3;
            position: fixed;
            height: 100%;
            overflow: auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .sidebar a {
            display: block;
            color: black;
            padding: 20px;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #ddd;
        }
        .main {
            margin-left: 260px; 
            padding: 16px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            background-color: #fff;
            padding: 40px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 1000px;
            margin-top: 40px;
        }
        h2 {
            text-align: left;
            font-size: 24px;
            margin-bottom: 20px;
        }
        hr {
            margin: 10px 0 20px;
            border: 0;
            border-top: 1px solid #ccc;
        }
        .profile-info {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
        }
        .profile-info label {
            color: #666;
        }
        .profile-info span {
            color: #666;
        }
        .edit-btn {
            margin-left: 24%;
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #e8630a;
            color: #fff;
            text-align: center;
            border: none;
            cursor: pointer;
            width: 400px;
            text-decoration: none;
        }
        .edit-btn:hover {
            background-color: chocolate;
        }
        .logout-btn {
            font-size: 20px;
            display: block;
            width: 70%;
            padding: 15px;
            margin-left: 18px;
            background-color: #fff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
        }
        .sidebar .logout-btn:hover {
            background-color: #d32f2f;
            color: #fff;
        }
    </style>
</head>
<body>
    <header>
        <a href="index.php"><i class='bx bx-chevron-left'></i>Home</a>
        <h1>USER PROFILE</h1>
    </header>
    <div class="sidebar">
        <a href="orders.php">My Orders</a>
        <a href="profile.php">Profile Information</a>
        <a href="pan_info.php">PAN Card Information</a>
        <a href="payments.php">Saved UPI</a>
        <a href="payments.php">Saved Cards</a>
        <a href="coupons.php">My Coupons</a>
        <a href="reviews.php">My Reviews & Ratings</a>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
    <div class="main">
        <div class="container">
            <h2>Profile Details</h2><hr>
            <div class="profile-info">
                <label>Full Name</label>
                <span><?php echo $_SESSION['name']; ?></span>
            </div>
            <div class="profile-info">
                <label>Mobile Number</label>
                <span><?php echo $_SESSION['phone']; ?></span>
            </div>
            <div class="profile-info">
                <label>Email ID</label>
                <span><?php echo $_SESSION['email']; ?></span>
            </div>
            <div class="profile-info">
                <label>Address</label>
                <span><?php echo $_SESSION['address_line1']; ?></span>
            </div>
            <div class="profile-info">
                <label></label>
                <span><?php echo $_SESSION['address_line2']; ?></span>
            </div>
            <div class="profile-info">
                <label>City</label>
                <span><?php echo $_SESSION['city']; ?></span>
            </div>
            <div class="profile-info">
                <label>State</label>
                <span><?php echo $_SESSION['state']; ?></span>
            </div>
            <div class="profile-info">
                <label>Postal Code</label>
                <span><?php echo $_SESSION['postal_code']; ?></span>
            </div>
            <div class="profile-info">
                <label>Country</label>
                <span><?php echo $_SESSION['country']; ?></span>
            </div>
            <a href="edit_profile.php" class="edit-btn">Edit Profile</a>
        </div>
    </div>
</body>
</html>
