<?php
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
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }

    header {
        background-color: #cedcc3;
        color: #fff;
        display: flex;
        align-items: center;
        padding: 10px 20px;
        text-align: center;
        width: 97.36%;
        position: sticky;
        top: 0;
        z-index: 1000; /* Ensure the header is on top */
    }

    .logo {
        max-height: 120px;
    }

    .nav-container {
        flex: 1;
    }

    .nav-container h1 {
        margin-bottom: 30px;
    }

    nav a {
        margin-left: 15px;
        text-decoration: none;
        color: #535a3b;
        font-weight: bold;
    }

    nav a:hover {
        text-decoration: underline;
    }

    .search-container {
        display: flex;
        align-items: center;
        margin-right: 30px;
        margin-top: 77px;
    }

    .search-bar {
        padding: 5px 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 20px 0 0 20px;
        outline: none;
    }

    .search-icon {
        background-color: #ccc;
        padding: 5px;
        border-radius: 0 20px 20px 0;
        cursor: pointer;
    }

    .icons i {
        font-size: 27px;
        margin-top: 80px;
        margin-right: 17px;
        color: #535a3b;
        cursor: pointer;
    }

    .banner {
        background-color: #535a3b;
        height: 450px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .banner p {
        font-family: 'Domine', serif;
        font-size: 70px;
        color: #fff;
        position: absolute;
        z-index: 1;
        text-align: center;
        padding: 20px;
        border-radius: 10px;
    }

    footer {
        background-color: #333;
        color: #fff;
        text-align: left;
        padding: 20px 0;
        width: 100%;
        margin-top: 20px;
        box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.2);
    }

    .footer-content {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        padding: 20px;
        max-width: 1300px;
        margin: 0 auto;
    }

    .footer-content img {
        max-height: 120px;
    }

    .footer-section {
        flex: 1;
        min-width: 250px;
        padding: 20px;
    }

    .footer-section h2 {
        font-family: 'Domine', serif;
        font-size: 20px;
        margin-bottom: 15px;
        color: white;
    }

    .footer-section p,
    .footer-section ul,
    .footer-section li {
        font-size: 14px;
        margin-bottom: 10px;
        color: #ccc;
    }

    .footer-section ul {
        list-style: none;
        padding: 0;
    }

    .footer-section ul li {
        margin-bottom: 10px;
    }

    .footer-section ul li a {
        color: #ccc;
        text-decoration: none;
    }

    .footer-section ul li a:hover {
        color: #e8630a;
    }

    .footer-section.newsletter form {
        /* display: flex; */
        flex-direction: column;
    }

    .footer-section.newsletter input[type="email"] {
        padding: 10px;
        border: 1px solid #ccc;
        /* border-radius: 5px; */
        margin-bottom: 10px;
        width: 60%;
        font-size: 14px;
        box-sizing: border-box;
        outline: none;
    }

    .footer-section.newsletter button {
        padding: 10px 20px;
        border: none;
        /* border-radius: 5px; */
        background-color: #e8630a;
        color: #fff;
        cursor: pointer;
        font-size: 15px;
        transition: background-color 0.3s ease;
    }

    .footer-section .newsletter button:hover {
        background-color: #d75703;
    }

    .footer-section.newsletter p {
        font-size: 14px;
        margin-bottom: 10px;
        color: #ccc;
    }

    .footer-section .social-icons {
        display: flex;
        justify-content: flex-start;
        margin-top: 10px;
    }

    .footer-section .social-icons a {
        color: #ccc;
        font-size: 24px;
        margin: 0 10px 0 0;
        text-decoration: none;
    }

    .footer-section .social-icons a:hover {
        color: #e8630a;
    }

    .footer-bottom {
        /* background-color: #222; */
        padding: 10px 0;
        margin-bottom: -10px;
        text-align: center;
        justify-content: center;
        color: #ccc;
        font-size: 14px;
        display: flex;
    }

    .footer-bottom img {
        max-height: 50px;
    }

    .cart-container {
        display: flex;
        justify-content: space-between;
        margin: 20px;
        border: 1px solid #ccc; /* Add border around cart container */
        padding: 20px; /* Add padding for spacing */
    }

    .cart-items {
        width: 70%;
    }

    .order-summary {
        width: 25%;
        height: 400px;
        padding: 20px;
        border: 1px solid #ccc;
    }

    .cart-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
        border-bottom: 1px solid #ccc;
        padding-bottom: 20px;
    }

    .cart-item img {
        width: 150px;
        height: 150px;
        margin-left: 40px;
    }

    .cart-item-info {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        /* margin-left: 20px; */
    }

    .cart-item-actions {
        display: flex;
        /* Ensure buttons are displayed inline */
        justify-content: space-between;
        align-items: center; /* Center vertically */
    }

    .cart-item-actions button {
        width: 80px; /* Set a fixed width for buttons */
        padding: 10px;
        background-color: #535a3b;
        color: #fff;
        text-align: center;
        cursor: pointer;
        border: none;
        margin-top: 5px;
    }

    .cart-item-actions button:first-child {
        margin-right: 5px; /* Add margin between buttons */
    }

    .summary-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .checkout-button,
    .remove-button,
    .view-button {
        width: 100%;
        padding: 10px;
        background-color: #535a3b;
        color: #fff;
        text-align: center;
        cursor: pointer;
        border: none;
        margin-bottom: 10px;
    }

    .checkout-button {
        margin-top: 30px;
    }

    .remove-button,
    .view-button {
        width: 80px;
        margin-right: 10px;
        margin-top: 5px;
    }

    .cart-item-quantity {
            display: flex;
            align-items: center;
        }
        .cart-item-quantity input {
            width: 40px;
            height: 30px;
            text-align: center;
            margin: 0 10px;
        }
</style>
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
        xhr.send("cartItems=" + encodeURIComponent(cartItemsJson) + "&payment=" + encodeURIComponent(paymentMethod) + "&custId=" + <?php echo $cust_id; ?>);
    }

</script>

<?php include 'footer.php'; ?>

</body>
</html>

<?php
if (isset($stmt)) {
    $stmt->close();
}
$conn->close();
?>
