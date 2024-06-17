<?php
session_start();
include 'db.php'; // Your database connection script

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $productId = $_GET['id'];
    $customerId = $_SESSION['cust_id'];

    // Check if the product is already in the wishlist
    $check_query = "SELECT * FROM customer_wishlist WHERE cust_id = {$customerId} AND pro_id = {$productId}";
    $check_result = $conn->query($check_query);

    if ($check_result->num_rows == 0) {
        // If not in wishlist, add it
        $insert_query = "INSERT INTO customer_wishlist (cust_id, pro_id) VALUES ({$customerId}, {$productId})";
        if ($conn->query($insert_query) === TRUE) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['error' => 'Failed to add to wishlist']);
        }
    } else {
        echo json_encode(['error' => 'Product already in wishlist']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}

$conn->close();
?>
