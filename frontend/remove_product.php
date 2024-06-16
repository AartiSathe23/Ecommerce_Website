<?php
session_start();
include 'db.php'; // Include your database connection script

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['productId']) && isset($_POST['custId'])) {
    $productId = $_POST['productId'];
    $custId = $_POST['custId'];

    // Prepare SQL statement to remove the product from customer_cart
    $sql = "DELETE FROM customer_cart WHERE cust_id = ? AND pro_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $custId, $productId);

    if ($stmt->execute()) {
        // Successfully deleted from database
        echo json_encode(['success' => true, 'message' => 'Product removed from cart successfully.']);
    } else {
        // Error deleting from database
        echo json_encode(['success' => false, 'message' => 'Failed to remove product from cart.']);
    }

    $stmt->close();
    $conn->close();
} else {
    // Invalid request
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}
?>
