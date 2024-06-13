<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Card</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css">
    <style>
        .product-card {
            width: 300px;
            border: 1px solid #ccc;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px;
            font-family: Arial, sans-serif;
        }
        .product-card img {
            width: 100%;
            height: auto;
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
            font-family:'Times New Roman', Times, serif;
        }
        .product-card .add-to-cart {
            font-size: 1.5em;
            color: #111;
            text-decoration: none;
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
        /* .product-card .product-description {
            font-size: 1em;
            margin: 10px 0;
            color: #555;
        } */
    </style>
</head>
<body>

<!-- <div class="product-card">
    <img src="https://via.placeholder.com/300" alt="Product Image">
    <div class="product-details">
        <div class="product-header">
            <h2 class="product-title">Product Title</h2>
            <a href="#" class="add-to-cart"><i class='bx bxs-cart-add'></i></i></a>
        </div>
        <div class="product-brand-price">
            <p class="product-brand">Brand Name</p>
            <p class="product-price">$29.99</p>
        </div>
    </div>
</div> -->

<?php include 'fetch_products.php'; ?>

</body>
</html>
