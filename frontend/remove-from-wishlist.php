<?php
session_start();
include 'db.php'; // Your database connection script

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $productId = $_GET['id'];
    $customerId = $_SESSION['cust_id'];

    // Remove from wishlist
    $delete_query = "DELETE FROM customer_wishlist WHERE cust_id = {$customerId} AND pro_id = {$productId}";
    if ($conn->query($delete_query) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Failed to remove from wishlist']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}

$conn->close();
?>
