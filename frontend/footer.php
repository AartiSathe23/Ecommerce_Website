<footer>
        <div class="footer-content">
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
        document.getElementById("cust_id").addEventListener("click", function() {
            <?php if (is_logged_in()): ?>
                window.location.href = "profile.php";
            <?php else: ?>
                window.location.href = "cust_login.html";
            <?php endif; ?>
        });
        document.getElementById("wishlist").addEventListener("click", function() {
            window.location.href = "wishlist-page.php";
        });
        document.getElementById("cart").addEventListener("click", function() {
            window.location.href = "cart-page.php";
        });
    </script>
</body>
</html>
