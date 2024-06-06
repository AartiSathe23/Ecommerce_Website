<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit;
}

// Update the session variables when the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['dob'] = $_POST['dob'];
    // $_SESSION['location'] = $_POST['location'];
    $_SESSION['alt_phone'] = $_POST['alt_phone'];
    $_SESSION['hint_name'] = $_POST['hint_name'];

    // Update the database with new information
    // Assuming you have a database connection established as $conn
    // $stmt = $conn->prepare("UPDATE users SET dob = ?, location = ?, alt_phone = ?, hint_name = ? WHERE email = ?");
    // $stmt->bind_param("sssss", $_POST['dob'], $_POST['location'], $_POST['alt_phone'], $_POST['hint_name'], $_SESSION['email']);
    // $stmt->execute();
    // $stmt->close();

    header("Location: profile.php");
    exit;
}

$name = isset($_SESSION['name']) && $_SESSION['name'] !== "- not added -" ? $_SESSION['name'] : "";
$dob = isset($_SESSION['dob']) && $_SESSION['dob'] !== "- not added -" ? $_SESSION['dob'] : "";
// $location = isset($_SESSION['location']) && $_SESSION['location'] !== "- not added -" ? $_SESSION['location'] : "";
$alt_phone = isset($_SESSION['alt_phone']) && $_SESSION['alt_phone'] !== "- not added -" ? $_SESSION['alt_phone'] : "";
$hint_name = isset($_SESSION['hint_name']) && $_SESSION['hint_name'] !== "- not added -" ? $_SESSION['hint_name'] : "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
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
        .profile-info input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .save-btn {
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
        .save-btn:hover {
            background-color: #45a049;
        }
        .cancel-btn {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #f44336;
            color: #fff;
            text-align: center;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .cancel-btn:hover {
            background-color: #d32f2f;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            let inputs = document.querySelectorAll('input');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    if (this.value === "- not added -") {
                        this.value = '';
                    }
                });
                input.addEventListener('blur', function() {
                    if (this.value === '') {
                        this.value = '- not added -';
                    }
                });
            });
        });
    </script>
</head>
<body>
    <header>
        <h1>Edit Profile</h1>
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
            <form method="post" action="">
                <div class="profile-info">
                    <label>Name:</label>
                    <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" placeholder="- not added -">
                </div>
                <div class="profile-info">
                    <label>Date of Birth:</label>
                    <input type="date" name="dob" value="<?php echo htmlspecialchars($dob); ?>" placeholder="- not added -">
                </div>
                <div class="profile-info">
                    <label>Alternate Mobile:</label>
                    <input type="text" name="alt_phone" value="<?php echo htmlspecialchars($alt_phone); ?>" placeholder="- not added -">
                </div>
                <div class="profile-info">
                    <label>Hint Name:</label>
                    <input type="text" name="hint_name" value="<?php echo htmlspecialchars($hint_name); ?>" placeholder="- not added -">
                </div>
                <button type="submit" class="save-btn">Save Changes</button>
                <a href="profile.php" class="cancel-btn">Cancel</a>
            </form>
        </div>
    </div>
</body>
</html>
