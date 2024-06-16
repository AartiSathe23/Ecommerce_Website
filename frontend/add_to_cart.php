<?php
include 'db.php';
session_start();

$product_id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$cust_id = isset($_POST['cust_id']) ? intval($_POST['cust_id']) : 0;
$quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

$sql = "SELECT pro_name, pro_img, brand, sell_price FROM admin_products WHERE pro_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
    $pro_name = $product['pro_name'];
    $brand = $product['brand'];
    $sell_price = $product['sell_price'];
    $pro_img = $product['pro_img'];

    $insert_sql = "INSERT INTO customer_cart (cust_id, pro_id, pro_name, brand, sell_price, quantity, pro_img) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $insert_stmt = $conn->prepare($insert_sql);
    $insert_stmt->bind_param("iissdis", $cust_id, $product_id, $pro_name, $brand, $sell_price, $quantity, $pro_img);

    if ($insert_stmt->execute()) {
        echo "Product added to cart successfully.";
    } else {
        echo "Error: " . $insert_stmt->error;
    }

    $insert_stmt->close();
} else {
    echo "Product not found.";
}

$stmt->close();
$conn->close();
?>
