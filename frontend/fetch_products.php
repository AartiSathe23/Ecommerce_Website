<?php
include 'db.php'; // This is your database connection script

// Fetch collections and sub-collections
$collections_query = "SELECT DISTINCT pro_col FROM admin_products";
$collections_result = $conn->query($collections_query);

while($collection = $collections_result->fetch_assoc()) {
    echo "<h2>" . $collection['pro_col'] . "</h2>";

    $sub_collections_query = "SELECT DISTINCT pro_sub_col FROM admin_products WHERE pro_col = '" . $collection['pro_col'] . "'";
    $sub_collections_result = $conn->query($sub_collections_query);

    while($sub_collection = $sub_collections_result->fetch_assoc()) {
        echo "<h3>" . $sub_collection['pro_sub_col'] . "</h3>";
        
        $products_query = "SELECT * FROM admin_products WHERE pro_col = '" . $collection['pro_col'] . "' AND pro_sub_col = '" . $sub_collection['pro_sub_col'] . "'";
        $products_result = $conn->query($products_query);

        while($product = $products_result->fetch_assoc()) {
            echo "<div class='product-card'>";
            echo "<img src='" . $product['pro_img'] . "' alt='Product Image'>";
            echo "<div class='product-details'>";
            echo "<div class='product-header'>";
            echo "<h2 class='product-title'>" . $product['pro_name'] . "</h2>";
            echo "<a href='#' class='add-to-cart'><i class='bx bxs-cart-add'></i></a>";
            echo "</div>";
            echo "<div class='product-brand-price'>";
            echo "<p class='product-brand'>" . $product['brand'] . "</p>";
            echo "<p class='product-price'>$" . $product['sell_price'] . "</p>";
            echo "</div>";
            // echo "<p class='product-description'>" . $product['pro_desc'] . "</p>";
            echo "</div>";
            echo "</div>";
        }
    }
}

$conn->close();
?>
