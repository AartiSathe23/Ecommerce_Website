<?php
// Start the session
session_start();

// Function to check if the user is logged in
function is_logged_in() {
    return isset($_SESSION['cust_id']);
}
?>
    <header>
        <div class="logo-container">
            <img src="assets/logo1.png" alt="Logo" class="logo">
        </div>
        <div class="nav-container">
            <h1>Welcome to Essentia</h1>
            <nav>
                <a href="index.php" class="home">Home</a>
                <a href="men.php" class="men">Men</a>
                <a href="women.php" class="women">Women</a>
                <a href="electronic.php" class="electronics">Electronics</a>
                <a href="furniture.php" class="home">Home & Furniture</a>
                <a href="book.php" class="books">Books</a>
            </nav>
        </div>
        <div class="search-container">
            <input type="text" placeholder="Search" class="search-bar">
            <i class='bx bx-search search-icon'></i>
        </div>
        <div class="icons">
            <i class='bx bx-user-circle' id="cust_id"></i>
            <i class='bx bx-heart' id="wishlist"></i>
            <i class='bx bx-cart' id="cart"></i>
        </div>
    </header>
