<?php
// checkout.php

session_start();
include 'db.php'; // Include your database connection script

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cartItems = json_decode($_POST['cartItems'], true); // Decode JSON string into PHP array
    $payment = $_POST['payment'];
    $custId = $_POST['custId'];

    // Perform validation or security checks if necessary

    // Insert into customer_orders table
    $orderDate = date('Y-m-d H:i:s');
    $sql = "INSERT INTO customer_orders (cust_id, pro_id, total_price, status, payment, order_date) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    foreach ($cartItems as $cartItem) {
        $productId = $cartItem['pro_id'];
        $totalPrice = $cartItem['sell_price'] * $cartItem['quantity'];
        $status = 'Pending'; // You can set default status here
        $stmt->bind_param("iiisss", $custId, $productId, $totalPrice, $status, $payment, $orderDate);
        $stmt->execute();
    }

    // Clear customer_cart table for this customer
    $sqlDelete = "DELETE FROM customer_cart WHERE cust_id = ?";
    $stmtDelete = $conn->prepare($sqlDelete);
    $stmtDelete->bind_param("i", $custId);
    $stmtDelete->execute();

    // Check if orders were successfully placed
    if ($stmt->affected_rows > 0) {
        echo json_encode(['success' => true, 'message' => 'Order placed successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to place order.']);
    }

    $stmt->close();
    $stmtDelete->close();
    $conn->close();
} else {
    // Invalid request method
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
