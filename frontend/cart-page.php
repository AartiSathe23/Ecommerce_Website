<?php
session_start();
include 'header.php';
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="styles/cart-page.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.0/css/boxicons.min.css">
</head>
<body>

<main>
    <div class="cart-container">
        <div class="cart-items">
            <h2>Your Cart</h2>
            <?php
            if (!isset($_SESSION['cust_id'])) {
                echo "<p>You need to login to view your cart.</p>";
            } else {
                $cust_id = $_SESSION['cust_id'];
                $sql = "SELECT cc.pro_id, cc.quantity, p.pro_name, p.pro_img, p.brand, p.sell_price 
                        FROM customer_cart cc 
                        JOIN admin_products p ON cc.pro_id = p.pro_id 
                        WHERE cc.cust_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $cust_id);
                $stmt->execute();
                $result = $stmt->get_result();

                $cartItems = [];
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $cartItems[] = $row;
                    }
                }

                if (empty($cartItems)) {
                    echo "<p>Your cart is empty.</p>";
                } else {
                    foreach ($cartItems as $cartItem) {
                        echo "<div class='cart-item'>
                                <img src='../backend/admin/{$cartItem['pro_img']}' alt='Product Image'>
                                <div class='cart-item-info'>
                                    <h4>{$cartItem['pro_name']}</h4>
                                    <p>{$cartItem['brand']}</p>
                                    <p>\${$cartItem['sell_price']}</p>
                                </div>
                                <div class='cart-item-actions'>
                                    <button class='view-button' onclick='viewProduct({$cartItem['pro_id']})'>View</button>
                                    <button class='remove-button' onclick='deleteProduct({$cartItem['pro_id']})'>Remove</button>
                                </div>
                            </div>";
                    }
                }
            }
            ?>
        </div>
        <?php if (isset($_SESSION['cust_id']) && !empty($cartItems)): ?>
            <?php
            // Calculate subtotal
            $subtotal = 0;
            foreach ($cartItems as $cartItem) {
                $subtotal += $cartItem['sell_price'] * $cartItem['quantity'];
            }

            // Calculate total including packaging fee
            $packagingFee = 10;
            $total = $subtotal + $packagingFee;
            ?>
            <div class="order-summary">
                <h3>Order Summary</h3>
                <div class="summary-item">
                    <span>Price(<?php echo count($cartItems); ?>)</span>
                    <span>$<?php echo $subtotal; ?></span>
                </div>
                <div class="summary-item">
                    <span>Delivery Charges</span>
                    <span>Free</span>
                </div>
                <div class="summary-item">
                    <span>Packaging Fee</span>
                    <span>$<?php echo $packagingFee; ?></span>
                </div>
                <hr>
                <div class="summary-item">
                    <span>Total</span>
                    <span>$<?php echo $total; ?></span>
                </div>
                <h4>Payment Options</h4>
                <input type="radio" name="payment" value="upi" checked> UPI<br>
                <input type="radio" name="payment" value="wallet"> Wallet<br>
                <input type="radio" name="payment" value="card"> Debit Card/Credit Card/ATM Card<br>
                <input type="radio" name="payment" value="COD"> Cash on Delivery<br>
                <button class="checkout-button" onclick="checkout()">Checkout</button>
            </div>
        <?php endif; ?>
    </div>
</main>

<script>
    function viewProduct(productId) {
        window.location.href = 'product-page.php?id=' + productId;
    }

    function deleteProduct(productId) {
        if (!confirm('Are you sure you want to remove this product from cart?')) {
            return;
        }

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "remove_product.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    location.reload();
                } else {
                    alert('Failed to remove product from cart: ' + response.message);
                }
            }
        };
        xhr.send("productId=" + productId + "&custId=" + <?php echo $cust_id; ?>);
    }

    function checkout() {
        let paymentMethod = document.querySelector('input[name="payment"]:checked').value;

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "checkout.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    window.location.href = 'order-page.php';
                } else {
                    alert('Failed to checkout: ' + response.message);
                }
            }
        };

        var cartItemsJson = JSON.stringify(<?php echo json_encode($cartItems); ?>);
        xhr.send("cartItems=" + cartItemsJson + "&payment=" + paymentMethod + "&custId=" + <?php echo $cust_id; ?>);
    }
</script>

<?php include 'footer.php'; ?>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
