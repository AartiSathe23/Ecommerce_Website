<?php
include 'header.php';
include 'db.php';


$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

$sql = "SELECT pro_name, pro_img, pro_desc, brand, sell_price FROM admin_products WHERE pro_id = $product_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
} else {
    echo "Product not found.";
    exit;
}

$is_logged_in = isset($_SESSION['cust_id']) ? true : false;
$cust_id = $is_logged_in ? $_SESSION['cust_id'] : 0;

if ($is_logged_in) {
    $pro_name = $product['pro_name'];
    $brand = $product['brand'];
    $sell_price = $product['sell_price'];
    $pro_img = $product['pro_img'];

    $stmt = $conn->prepare("INSERT INTO customer_cart (cust_id, pro_id, pro_name, brand, sell_price, quantity, pro_img) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iissdis", $cust_id, $product_id, $pro_name, $brand, $sell_price, $quantity, $pro_img);

    // if ($stmt->execute()) {
    //     echo "Product added to cart successfully.";
    // } else {
    //     echo "Error: " . $stmt->error;
    // }

    $stmt->close();
} else {
    // echo "You must be logged in to add products to the cart.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link rel="stylesheet" href="styles/product-details.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.0/css/boxicons.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 20px;
        }

        .product-detail {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            width:75%;
            margin-bottom: 30px;
        }

        .product-detail img {
            max-width: 40%;
            height: auto;
        }

        .product-info {
            max-width: 40%;
            margin-left: 20px;
            position: relative;
        }

        .product-info p {
            margin: 25px 0;
        }

        .product-info h2 {
            font-size: 35px;
            margin-bottom: 10px;
        }

        .product-info .price {
            font-size: 22px;
            color: #b12704;
            margin-bottom: 20px;
        }

        .buttons {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .buttons button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border: none;
        }

        .buttons .buy-now {
            background-color: #8f8787;
            color: #fff;
        }

        .buttons .add-to-cart {
            background-color: #535a3b;
            color: #fff;
        }

        .heart-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            color: red;
            font-size: 24px;
            z-index: 2;
            cursor: pointer;
        }

        .quantity {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .quantity button {
            background-color: #fff;
            color: black;
            border: none;
            padding: 0;
            cursor: pointer;
            width: 40px; 
            height: 40px; 
            font-size: 16px;
            text-align: center;
            border: 1px solid #ccc;
        }

        .quantity input {
            width: 40px;
            height: 40px;
            padding: 5px;
            font-size: 16px;
            text-align: center;
            border: 1px solid #ccc;
            border-radius: 0; 
        }

        .description {
            width: 80%;
            margin-top: 30px;
        }
        
        .description ul {
            margin-top: -40px;
        }

        .related-products {
            width: 80%;
            margin-top: 20px;
        }

        .related-products h3 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .product-grid {
            display: flex;
            gap: 20px;
        }

        .product-grid img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
    <script>
        var isLoggedIn = <?php echo $is_logged_in ? 'true' : 'false'; ?>;
        var custId = <?php echo $cust_id; ?>;

        function checkLogin(action, productId) {
            if (!isLoggedIn) {
                alert('You must be logged in to perform this action.');
                window.location.href = 'cust_login.html';
                return;
            }

            if (action === 'order') {
                addToOrder(productId, custId);
            } else if (action === 'cart') {
                var quantity = document.getElementById('quantity').value;
                addToCart(productId, custId, quantity);
            } else if (action === 'wishlist') {
                addToWishlist(productId, custId);
            }
        }

        function addToCart(productId, custId, quantity) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "add_to_cart.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    alert(xhr.responseText);
                }
            };
            xhr.send("id=" + productId + "&cust_id=" + custId + "&quantity=" + quantity);
        }

        function redirectToProductPage(productId) {
            window.location.href = 'product-page.php?id=' + productId;
        }

        function addToOrder(productId, custId) {
            window.location.href = 'order-process-page.php?id=' + productId + '&cust_id=' + custId;
        }

        function addToWishlist(productId, custId) {
            var heartIcon = document.getElementById('heart-icon-' + productId);
            heartIcon.classList.remove('bx-heart');
            heartIcon.classList.add('bxs-heart');
            window.location.href = 'wishlist-page.php?id=' + productId + '&cust_id=' + custId;
        }

        function updateQuantity(operation) {
            var quantityInput = document.getElementById('quantity');
            var currentValue = parseInt(quantityInput.value);

            if (operation === 'increment') {
                quantityInput.value = currentValue + 1;
            } else if (operation === 'decrement' && currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        }
    </script>
</head>
<body>

<main>
    <div class="container">
        <div class="product-detail">
            <img src="<?php echo '../backend/admin/' . $product['pro_img']; ?>" alt="Product Image">
            <div class="product-info">
                <p><span><?php echo $product['brand']; ?></span></p>
                <h2><?php echo $product['pro_name']; ?></h2>
                <p class="price">$<?php echo $product['sell_price']; ?></p>
                <div class="buttons">
                    <button class="buy-now" onclick="checkLogin('order', <?php echo $product_id; ?>)">Buy Now</button>
                    <button class="add-to-cart" onclick="checkLogin('cart', <?php echo $product_id; ?>, document.getElementById('quantity').value)">Add to Cart</button>
                    <i class='bx bx-heart heart-icon' id="heart-icon-<?php echo $product_id; ?>" onclick="checkLogin('wishlist', <?php echo $product_id; ?>)"></i>
                </div>
                <div class="quantity">
                    <button onclick="updateQuantity('decrement')">-</button>
                    <input type="text" id="quantity" name="quantity" min="1" value="1">
                    <button onclick="updateQuantity('increment')">+</button>
                </div>
                <div class="related-products">
                    <h3>Product Images</h3>
                    <div class="product-grid">
                        <!-- Same product images for demonstration -->
                        <img src="<?php echo '../backend/admin/' . $product['pro_img']; ?>" alt="Product Image" onclick="redirectToProductPage(<?php echo $product_id; ?>)">
                        <img src="<?php echo '../backend/admin/' . $product['pro_img']; ?>" alt="Product Image" onclick="redirectToProductPage(<?php echo $product_id; ?>)">
                        <img src="<?php echo '../backend/admin/' . $product['pro_img']; ?>" alt="Product Image" onclick="redirectToProductPage(<?php echo $product_id; ?>)">
                    </div>
                </div>
            </div>
        </div>

        <div class="description">
            <h3>Product Description</h3>
            <p><?php echo nl2br($product['pro_desc']); ?></p>
        </div>
    </div>
</main>
<?php include 'footer.php'; ?>
</body>
</html>


