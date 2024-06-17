<?php
session_start();
include 'db.php';

// Decode the cart items and get payment method and customer ID
$cartItems = json_decode($_POST['cartItems'], true);
$paymentMethod = $_POST['payment'];
$custId = $_POST['custId'];

// Generate a new order ID (this assumes order_id is unique for each order, not each product)
$orderId = generateOrderId($conn);

// Calculate total amount for the order
$totalAmount = calculateTotalAmount($cartItems);

// Insert each cart item into the customer_orders table
foreach ($cartItems as $item) {
    $insertOrderSql = "INSERT INTO customer_orders (order_id, cust_id, pro_id, cust_name, phone, address, payment, status, total_price, order_date)
                       VALUES (?, ?, ?, ?, ?, ?, ?, 'pending', ?, NOW())";
    $stmt = $conn->prepare($insertOrderSql);
    $stmt->bind_param("iiissssd", 
                      $orderId, 
                      $custId, 
                      $item['pro_id'], 
                      $_SESSION['cust_name'], 
                      $_SESSION['phone'], 
                      $_SESSION['address'], 
                      $paymentMethod, 
                      $totalAmount);
    $stmt->execute();
}

// Clear the cart
$clearCartSql = "DELETE FROM customer_cart WHERE cust_id = ?";
$stmt = $conn->prepare($clearCartSql);
$stmt->bind_param("i", $custId);
$stmt->execute();

// Respond with success
$response = ['success' => true];
echo json_encode($response);

// Function to generate a unique order ID
function generateOrderId($conn) {
    $result = $conn->query("SELECT MAX(order_id) AS max_order_id FROM customer_orders");
    $row = $result->fetch_assoc();
    return $row['max_order_id'] + 1;
}

// Function to calculate total amount
function calculateTotalAmount($cartItems) {
    $total = 0;
    foreach ($cartItems as $item) {
        $total += $item['sell_price'] * $item['quantity'];
    }
    return $total;
}
?>
