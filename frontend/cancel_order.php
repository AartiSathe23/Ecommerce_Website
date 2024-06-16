<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: cust_login.html"); 
    exit;
}

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = $_POST['order_id'];

    // Update the order status in the database
    $sql_update = "UPDATE customer_orders SET status='Cancelled' WHERE order_id=?";
    $stmt = $conn->prepare($sql_update);
    $stmt->bind_param("i", $order_id);

    if ($stmt->execute()) {
        $response = array('success' => true);
    } else {
        $response = array('success' => false, 'message' => 'Failed to cancel the order in the database.');
    }

    $stmt->close();
    $conn->close();

    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
?>
