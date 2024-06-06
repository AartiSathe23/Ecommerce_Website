<?php
// Start the session
session_start();

// Function to check if the user is logged in
function is_logged_in() {
    return isset($_SESSION['user_id']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce Website</title>
    <link rel="stylesheet" href="styles/w-tshirt.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.0/css/boxicons.min.css">
</head>
<body>
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
                <!-- <a href="" class="sports">Sports & Fitness</a> -->
            </nav>
        </div>
        <div class="search-container">
            <input type="text" placeholder="Search" class="search-bar">
            <i class='bx bx-search search-icon'></i>
        </div>
        <div class="icons">
            <i class='bx bx-user-circle' id="user"></i>
            <i class='bx bx-cart' id="cart"></i>
        </div>
    </header>
    <main>
        <div class="main-content">
            <div class="banner">
                <p>T-SHIRTS</p>
            </div>
        </div>
    </main>
    <footer>
        <div class="footer-content">
            <!-- <img src="assets/logo1.png" alt=""> -->
            <div class="footer-section about">
                <img src="assets/logo1.png" alt="">
                <p>Essentia is your go-to place for the latest in fashion, electronics, home decor, and more. <br>We are committed to providing the best quality products and customer service.</p>
            </div>
            <div class="footer-section links">
                <h2>Quick Links</h2>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="men.php">Men</a></li>
                    <li><a href="women.php">Women</a></li>
                    <li><a href="electronic.php">Electronics</a></li>
                    <li><a href="furniture.php">Home & Furniture</a></li>
                    <li><a href="book.php">Books</a></li>
                </ul>
            </div>
            <div class="footer-section customer-service">
                <h2>Customer Service</h2>
                <ul>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Shipping & Returns</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms & Conditions</a></li>
                </ul>
            </div>
            <div class="footer-section contact">
                <h2>Contact Us</h2>
                <p>Email: support@essentia.com</p>
                <p>Phone: +123 456 7890</p>
            </div>
            <div class="footer-section newsletter">
                <h2>Newsletter</h2>
                <p>Subscribe to our newsletter to get the latest updates.</p>
                <form action="#">
                    <input type="email" placeholder="Your email address" required>
                    <button type="submit">Subscribe</button>
                </form>
            </div>
            <div class="footer-section social-media">
                <h2>Follow Us</h2>
                <div class="social-icons">
                    <a href="#"><i class='bx bxl-facebook'></i></a>
                    <a href="#"><i class='bx bxl-twitter'></i></a>
                    <a href="#"><i class='bx bxl-instagram'></i></a>
                    <a href="#"><i class='bx bxl-linkedin'></i></a>
                </div>
            </div>
        </div><hr>
        <div class="footer-bottom">
            <img src="assets/logo1.png" alt="">
            <p>&copy; 2024 Essentia. All Rights Reserved.</p>
        </div>
    </footer>
    <script>
        document.getElementById("user").addEventListener("click", function() {
            <?php if (is_logged_in()): ?>
                window.location.href = "profile.php";
            <?php else: ?>
                window.location.href = "login.html";
            <?php endif; ?>
        });
        document.getElementById("cart").addEventListener("click", function() {
            window.location.href = "cart.html";
        });
    </script>
</body>
</html>
