<?php
include 'header.php';
include 'db.php';

$cust_id = isset($_GET['cust_id']) ? intval($_GET['cust_id']) : 0;
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$quantity = isset($_GET['quantity']) ? intval($_GET['quantity']) : 1; // Default to 1 if not set

if (!$cust_id) {
    header('Location: cust_login.html');
    exit;
}

$sql_cust = "SELECT name, phone, address_line1, address_line2, city, state, postal_code FROM customer_management WHERE cust_id = $cust_id";
$result_cust = $conn->query($sql_cust);

if ($result_cust->num_rows > 0) {
    $customer = $result_cust->fetch_assoc();
    $full_address = $customer['address_line1'] . ', ' . $customer['address_line2'] . ', ' . $customer['city'] . ', ' . $customer['state'] . ' - ' . $customer['postal_code'];
} else {
    echo "Customer not found.";
    exit;
}

$sql_prod = "SELECT pro_name, pro_img, sell_price, admin_id FROM admin_products WHERE pro_id = $product_id";
$result_prod = $conn->query($sql_prod);

if ($result_prod->num_rows > 0) {
    $product = $result_prod->fetch_assoc();
} else {
    echo "Product not found.";
    exit;
}

// Generate a random order_id and ensure it's unique
function generateUniqueOrderId($conn) {
    do {
        $order_id = rand(11111, 99999);
        $sql_check = "SELECT * FROM customer_orders WHERE order_id = $order_id";
        $result_check = $conn->query($sql_check);
    } while ($result_check->num_rows > 0);
    return $order_id;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {  // Check if the form is submitted
    $order_id = generateUniqueOrderId($conn);
    $payment_method = $_POST['payment_method'];
    $status = 'Pending'; // default status
    $total_price = $product['sell_price'] * $quantity; // Calculate total price based on quantity

    // Insert order details into the database
    $sql_order = "INSERT INTO customer_orders (order_id, cust_id, pro_id, cust_name, phone, address, payment, status, total_price, quantity)
                  VALUES ($order_id, $cust_id, $product_id, '{$customer['name']}', '{$customer['phone']}', '$full_address', '$payment_method', '$status', $total_price, '$quantity')";
    
    if ($conn->query($sql_order) === TRUE) {
        echo "<script>alert('Order placed successfully!'); window.location.href='order-page.php';</script>";
    } else {
        echo "Error: " . $sql_order . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Processing</title>
    <link rel="stylesheet" href="styles/order-process-page.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.0/css/boxicons.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .order-container {
            max-width: 1000px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .order-header, .order-content {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .order-header .order-details, .order-header .product-details {
            flex: 1;
            margin: 0 10px;
            padding: 20px;
            border-radius: 8px;
        }

        .order-header .product-details img {
            max-width: 100px;
            margin-bottom: 10px;
        }

        h2 {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 1.5em;
            font-family: 'Times New Roman', Times, serif;
        }

        .order-details h2 a {
            font-size: 14px;
            color: #fff;
            text-decoration: none;
            background-color: #535a3b;
            padding: 5px 10px;
            transition: background-color 0.3s;
        }

        .order-details h2 a:hover {
            background-color: #ced4da;
        }

        .order-content .payment-methods, .order-content .order-summary {
            flex: 1;
            margin: 0 32px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border-radius: 4px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
        }

        .form-group select {
            cursor: pointer;
        }

        .button-group {
            text-align: center;
        }

        .button-group button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            background-color: #007bff;
            color: #fff;
            border-radius: 5px;
        }

        .button-group button:hover {
            background-color: #0056b3;
        }

        .payment-methods hr {
            margin: 15px 0;
            border: 0;
            border-top: 1px solid #ddd;
            width: 75%;
        }

        .order-summary hr {
            margin: 15px 0;
            border: 0;
            border-top: 1px solid #ddd;
            width: 75%;
        }

        .radio-group {
            align-items: center;
        }

        .radio-group input[type="radio"] {
            margin-left: 40px;
            margin-bottom: -17px;
        }
    </style>
</head>
<body>
    <div class="order-container">
        <div class="order-header">
            <div class="order-details">
                <h2>Customer Details <a href="edit_profile.php">CHANGE</a></h2>
                <div class="form-group">
                    <label for="cust_name">Customer Name</label>
                    <input type="text" id="cust_name" name="cust_name" value="<?php echo $customer['name']; ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="address">Delivery Address</label>
                    <input type="text" id="address" name="address" value="<?php echo $full_address; ?>" disabled>
                </div>
            </div>
            <div class="product-details">
                <h2>Product Details</h2>
                <div class="form-group">
                    <label for="pro_name">Product Name</label>
                    <input type="text" id="pro_name" name="pro_name" value="<?php echo $product['pro_name']; ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="total_price">Product Price</label>
                    <input type="text" id="total_price" name="total_price" value="$<?php echo $product['sell_price']; ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="text" id="quantity" name="quantity" value="<?php echo $quantity; ?>" disabled>
                </div>
            </div>
        </div>
        <div class="order-content">
            <div class="payment-methods">
                <h2>Payment Method</h2>
                <form method="POST">
                    <div class="form-group">
                        <div class="radio-group">
                            <input type="radio" id="upi" name="payment_method" value="UPI" required>
                            <label for="upi">UPI</label>
                        </div>
                        <hr>
                        <div class="radio-group">
                            <input type="radio" id="wallet" name="payment_method" value="Wallet" required>
                            <label for="wallet">Wallet</label>
                        </div>
                        <hr>
                        <div class="radio-group">
                            <input type="radio" id="card" name="payment_method" value="Debit Card/Credit Card/ATM Card" required>
                            <label for="card">Debit Card/Credit Card/ATM Card</label>
                        </div>
                        <hr>
                        <div class="radio-group">
                            <input type="radio" id="cod" name="payment_method" value="Cash on Delivery" required>
                            <label for="cod">Cash on Delivery</label>
                        </div>
                    </div>
                    <div class="button-group">
                        <button type="submit">Place Order</button>
                    </div>
                </form>
            </div>
            <div class="order-summary">
                <h2>Order Summary</h2>
                <p>Product Price: $<?php echo $product['sell_price']; ?> x <?php echo $quantity; ?></p>
                <p>Delivery Charges: Free</p>
                <hr>
                <h4>Total: $<?php echo $product['sell_price'] * $quantity; ?></h4>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
