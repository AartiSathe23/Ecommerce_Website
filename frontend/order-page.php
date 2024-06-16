<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: cust_login.html"); 
    exit;
}

$cust_id = $_SESSION['cust_id']; // Assuming cust_id is stored in the session

include 'db.php';

$sql_orders = "SELECT o.order_id, o.pro_id, o.total_price, o.status, o.payment, order_date, p.pro_name, p.brand, p.pro_img, p.sell_price 
               FROM customer_orders o
               JOIN admin_products p ON o.pro_id = p.pro_id
               WHERE o.cust_id = $cust_id";
$result_orders = $conn->query($sql_orders);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
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
            position: fixed;
            width: 100%;
            z-index: 1000;
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
            top: 80px;
            height: calc(100% - 60px);
            overflow: auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            padding-top: 20px;
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
            margin-top: 170px;
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
        .order-list {
            list-style-type: none;
            padding: 0;
        }
        .order-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px;
            margin-bottom: 15px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        .order-item img {
            max-width: 100px;
            margin-left: 40px;
            border-radius: 5px;
        }
        .order-details {
            flex: 1;
            margin-left: 80px;
        }
        .order-details p {
            margin: 15px 0 0 23px;
            color: #333;
        }
        .order-actions {
            text-align: left;
            margin-top: 5px;
        }
        .order-actions a {
            color: #666;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 5px;
            display: inline-block;
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
    function cancelOrder(orderId) {
        if (!confirm('Are you sure you want to cancel this order?')) {
            return;
        }
        
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "cancel_order.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    document.getElementById("status-" + orderId).textContent = "Cancelled";
                    alert('Order cancelled successfully.');
                } else {
                    alert('Failed to cancel order: ' + response.message);
                }
            }
        };
        xhr.send("order_id=" + orderId);
    }
    </script>
</head>
<body>
    <header>
        <a href="index.php"><i class='bx bx-chevron-left'></i>Home</a>
        <h1>MY ORDERS</h1>
    </header>
    <div class="sidebar">
        <a href="order-page.php">My Orders</a>
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
            <h2>Order History</h2><hr>
            <ul class="order-list">
                <?php
                if ($result_orders->num_rows > 0) {
                    while ($order = $result_orders->fetch_assoc()) {
                        echo "<li class='order-item'>
                                <img src='../backend/admin/{$order['pro_img']}' alt='{$order['pro_name']}'>
                                <div class='order-details'>
                                    <p><strong></strong> {$order['pro_name']}</p>
                                    <p><strong></strong> {$order['brand']}</p>
                                    <div class='order-actions'>
                                        <a href='#' onclick='cancelOrder({$order['order_id']})'><i class='bx bx-trash'></i>Cancel Order</a>
                                        <a href='product-page.php?id={$order['pro_id']}'><i class='bx bx-show'></i> View Product</a>
                                    </div>
                                </div>
                                <div class='order-details'>
                                    <p><strong></strong> {$order['order_date']}</p>
                                    <p><strong></strong><span id='status-{$order['order_id']}'>{$order['status']}</span></p>
                                    <p><strong></strong> {$order['payment']}</p>
                                    <p><strong></strong> \${$order['total_price']}</p>
                                </div>
                              </li>";
                    }
                } else {
                    echo "<p>You have no orders placed yet.</p>";
                }
                ?>
            </ul>
        </div>
    </div>
</body>
</html>
