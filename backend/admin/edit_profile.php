<?php
session_start();
include 'db.php';
if (!isset($_SESSION['email'])) {
    header("Location: admin_login.html");
    exit;
}

// Update the session variables when the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['phone'] = $_POST['phone'];
    $_SESSION['pan'] = $_POST['pan'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['address_line1'] = $_POST['address_line1'];
    $_SESSION['address_line2'] = $_POST['address_line2'];
    $_SESSION['city'] = $_POST['city'];
    $_SESSION['state'] = $_POST['state'];
    $_SESSION['postal_code'] = $_POST['postal_code'];
    $_SESSION['country'] = $_POST['country'];

    $stmt = $conn->prepare("UPDATE admin_management SET name = ?, phone = ?, pan = ?, address_line1 = ?, address_line2 = ?, city = ?, state = ?, postal_code = ?, country = ? WHERE email = ?");
    $stmt->bind_param("ssssssssss", $_POST['name'], $_POST['phone'], $_POST['pan'], $_POST['address_line1'], $_POST['address_line2'], $_POST['city'], $_POST['state'], $_POST['postal_code'], $_POST['country'], $_POST['email']);
    $stmt->execute();
    $stmt->close();

    header("Location: profile.php");
    exit;
}

$name = isset($_SESSION['name']) && $_SESSION['name'] !== "- not added -" ? $_SESSION['name'] : "";
$phone = isset($_SESSION['phone']) && $_SESSION['phone'] !== "- not added -" ? $_SESSION['phone'] : "";
$pan = isset($_SESSION['pan']) && $_SESSION['pan'] !== "- not added -" ? $_SESSION['pan'] : "";
$email = isset($_SESSION['email']) && $_SESSION['email'] !== "- not added -" ? $_SESSION['email'] : "";
$address_line1 = isset($_SESSION['address_line1']) && $_SESSION['address_line1'] !== "- not added -" ? $_SESSION['address_line1'] : "";
$address_line2 = isset($_SESSION['address_line2']) && $_SESSION['address_line2'] !== "- not added -" ? $_SESSION['address_line2'] : "";
$city = isset($_SESSION['city']) && $_SESSION['city'] !== "- not added -" ? $_SESSION['city'] : "";
$state = isset($_SESSION['state']) && $_SESSION['state'] !== "- not added -" ? $_SESSION['state'] : "";
$postal_code = isset($_SESSION['postal_code']) && $_SESSION['postal_code'] !== "- not added -" ? $_SESSION['postal_code'] : "";
$country = isset($_SESSION['country']) && $_SESSION['country'] !== "- not added -" ? $_SESSION['country'] : "";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
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
            gap: 10px;
        }
        .profile-info label {
            color: #666;
        }
        .profile-info input {
            border: 1px solid #ccc;
            padding: 0.75em;
            height: 22px;
            border: 1px solid #ddd;
            width: calc(97.7% - 5px); /* Adjust width to fit two fields in a row with a gap */
            margin-bottom: 11.5px;
        }
        
        .save-btn {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #4CAF50;
            color: #fff;
            text-align: center;
            border: none;
            cursor: pointer;
            width: 420px;
            font-size: 15.4px;
            text-decoration: none;
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
            cursor: pointer;
            width: 420px;
            text-decoration: none;
        }
        .cancel-btn:hover {
            background-color: #d32f2f;
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
        <a href="profile.php"><i class='bx bx-chevron-left'></i>Back</a>
        <h1>ADMIN PROFILE</h1>
    </header>
    <div class="sidebar">
        <a href="profile.php">Profile Information</a>
        <a href="payments.php">Saved UPI</a>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
    <div class="main">
        <div class="container">
            <h2>Edit Profile</h2><hr>
            <form method="post" action="">
                <div class="profile-info">
                    <label>Name</label>
                    <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" placeholder="- not added -">

                    <label>Phone</label>
                    <input type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>" placeholder="- not added -">
                </div>
                <div class="profile-info">
                    <label>PAN ID</label>
                    <input type="text" name="pan" value="<?php echo htmlspecialchars($pan); ?>" placeholder="- not added -">

                    <label>Email</label>
                    <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>" placeholder="- not added -">
                </div>
                <div class="profile-info">
                    <label>Address Line 1</label>
                    <input type="text" name="address_line1" value="<?php echo htmlspecialchars($address_line1); ?>" placeholder="- not added -">

                    <label>Address Line 2</label>
                    <input type="text" name="address_line2" value="<?php echo htmlspecialchars($address_line2); ?>" placeholder="- not added -">
                </div>
                <div class="profile-info">
                    <label>City</label>
                    <input type="text" name="city" value="<?php echo htmlspecialchars($city); ?>" placeholder="- not added -">

                    <label>State</label>
                    <input type="text" name="state" value="<?php echo htmlspecialchars($state); ?>" placeholder="- not added -">
                </div>
                <div class="profile-info">
                    <label>Postal Code</label>
                    <input type="text" name="postal_code" value="<?php echo htmlspecialchars($postal_code); ?>" placeholder="- not added -">

                    <label>Country</label>
                    <input type="text" name="country" value="<?php echo htmlspecialchars($country); ?>" placeholder="- not added -">
                </div>
                <button type="submit" class="save-btn">Save Changes</button>
                <a href="profile.php" class="cancel-btn">Cancel</a>
                </div>
                
            </form>
        </div>
    </div>
</body>
</html>
