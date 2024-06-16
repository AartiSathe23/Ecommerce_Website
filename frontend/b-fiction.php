<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce Website</title>
    <link rel="stylesheet" href="styles/f-homedecor.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.0/css/boxicons.min.css">
    <style>
        .product-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
        }
        .product-card {
            width: 350px;
            height: 400px;
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
        .product-card .add-to-cart {
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
    <script>
        function redirectToProductPage(productId) {
            window.location.href = 'product-page.php?id=' + productId;
        }

        function addToCart(productId) {
            window.location.href = 'cart-page.php?id=' + productId;
        }
    </script>
</head>
<body>

<main>
    <div class="main-content">
        <div class="banner">
            <p>FICTIONAL BOOKS</p>
        </div>
        <div class="product-grid">
            <?php
            include 'db.php'; // This is your database connection script

            $products_query = "
                SELECT p.pro_id, p.pro_name, p.pro_img, p.brand, p.sell_price, sc.col_name
                FROM admin_products p
                JOIN admin_sub_collections sc ON p.pro_sub_col = sc.col_id
                WHERE sc.col_name = 'Fictional Books'
            ";
            $products_result = $conn->query($products_query);

            if ($products_result->num_rows > 0) {
                while ($product = $products_result->fetch_assoc()) {
                    echo "<div class='product-card' onclick='redirectToProductPage(" . $product['pro_id'] . ")'>";
                    echo "<div class='product-image'><img src='assets/" . $product['pro_img'] . "' alt='Product Image'></div>";
                    echo "<div class='product-details'>";
                    echo "<div class='product-header'>";
                    echo "<h2 class='product-title'>" . $product['pro_name'] . "</h2>";
                    echo "<a class='add-to-cart' onclick='event.stopPropagation(); addToCart(" . $product['pro_id'] . ")'><i class='bx bxs-cart-add'></i></a>";
                    echo "</div>";
                    echo "<div class='product-brand-price'>";
                    echo "<p class='product-brand'>" . $product['brand'] . "</p>";
                    echo "<p class='product-price'>$" . $product['sell_price'] . "</p>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p class='no-products-found'>No products found in this collection.</p>";
            }

            $conn->close();
            ?>
        </div>
    </div>
</main>
<?php include 'footer.php'; ?>

</body>
</html>
