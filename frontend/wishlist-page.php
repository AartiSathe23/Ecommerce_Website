<?php
include 'header.php';
include 'db.php'; // Your database connection script

if (!isset($_SESSION['cust_id'])) {
    // Redirect to login or handle unauthorized access
    header('Location: login.php');
    exit();
}

$wishlist_query = "
    SELECT p.pro_id, p.pro_name, p.pro_img, p.brand, p.sell_price
    FROM customer_wishlist w
    JOIN admin_products p ON w.pro_id = p.pro_id
    WHERE w.cust_id = {$_SESSION['cust_id']}
";
$wishlist_result = $conn->query($wishlist_query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Wishlist</title>
    <link rel="stylesheet" href="styles/f-homedecor.css">
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

        .footer-section p, .footer-section ul, .footer-section li {
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

        .footer-bottom img{
            max-height: 50px;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
        }
        .product-card {
            width: 350px;
            height: 430px;
            border: 1px solid #ccc;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background: #fff;
            cursor: pointer;
        }
        .product-image {
            width: 100%;
            height: 300px;
            overflow: hidden;
        }
        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .product-card .product-details {
            padding: 15px;
        }
        .product-card .product-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .product-card .product-title {
            font-size: 1.5em;
            margin: 0;
            font-family: 'Times New Roman', Times, serif;
        }
        .product-card .wishlist-icon {
            font-size: 1.5em;
            color: #111;
            text-decoration: none;
            cursor: pointer;
        }
        .product-card .product-brand-price {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .product-card .product-brand {
            font-size: 0.9em;
            color: #555;
        }
        .product-card .product-price {
            font-size: 1.2em;
            color: #b12704;
        }

        .no-products-found {
            justify-content: center;
            align-items: center;
            text-align: center;
            text-transform: uppercase;
            font-size: 1.2em;
            color: #555;
            margin-left: 580px;
            margin-top: 50px; 
            width: 440px;
        }

        .main-content h1 {
            text-align: center;
            background-color:#535a3b;
            color: #fff;
            padding: 20px;
        }

        /* .no-products-found::before,
        .no-products-found::after {
            content: "";
            display: block;
            width: 100px;
            height: 1px;
            background-color: #ccc;
            margin: 20px auto; 
        } */
    </style>
</head>
<body>

<main>
    <div class="main-content">
        <h1>My Wishlist</h1>
        <div class="product-grid">
            <?php
            if ($wishlist_result->num_rows > 0) {
                while ($product = $wishlist_result->fetch_assoc()) {
                    $imagePath = $product['pro_img'];
                    echo "<div class='product-card' onclick='redirectToProductPage(" . $product['pro_id'] . ")'>";
                    echo "<div class='product-image'><img src='" . $imagePath . "' alt='Product Image'></div>";
                    echo "<div class='product-details'>";
                    echo "<div class='product-header'>";
                    echo "<h2 class='product-title'>" . $product['pro_name'] . "</h2>";
                    echo "<a class='wishlist-icon' onclick='event.stopPropagation(); toggleWishlist(" . $product['pro_id'] . ")'><i class='bx bx-heart' style='color:#e51212' ></i></a>";
                    echo "</div>";
                    echo "<div class='product-brand-price'>";
                    echo "<p class='product-brand'>" . $product['brand'] . "</p>";
                    echo "<p class='product-price'>$" . $product['sell_price'] . "</p>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p class='no-products-found'>No products found in your wishlist.</p>";
            }

            $conn->close();
            ?>
            </div>
        </div>
    </main>
    <?php include 'footer.php'; ?>
    <script>
        function redirectToProductPage(productId) {
            window.location.href = 'product-page.php?id=' + productId;
        }

        function toggleWishlist(productId) {
            var wishlistIcon = event.currentTarget.querySelector('i');
            var isAdded = wishlistIcon.classList.contains('bxs-heart');

            if (isAdded) {
                // Remove from wishlist
                removeFromWishlist(productId);
                wishlistIcon.classList.remove('bxs-heart');
                wishlistIcon.classList.add('bx-heart');
            } else {
                // Add to wishlist
                addToWishlist(productId);
                wishlistIcon.classList.remove('bx-heart');
                wishlistIcon.classList.add('bxs-heart');
            }
        }
    </script>
    </body>
    </html>