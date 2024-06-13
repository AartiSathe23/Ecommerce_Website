<?php
include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce Website</title>
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.0/css/boxicons.min.css">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

</head>
<body>
<main>
    <div class="slider">
        <div class="slides">
            <img class="slide" src="assets/electro.jpg" alt="Slide 1">
            <img class="slide" src="assets/banner1.jpg" alt="Slide 2">
            <img class="slide" src="assets/banner4.jpg" alt="Slide 3">
            <img class="slide" src="assets/banner3.jpg" alt="Slide 4">
            <img class="slide" src="assets/banner2.jpg" alt="Slide 5">
        </div>
        <div class="dots">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
            <span class="dot" onclick="currentSlide(4)"></span>
            <span class="dot" onclick="currentSlide(5)"></span>
        </div>
    </div>
    <div class="main-content">
        <div class="banner">
            <div class="banner-text">
                <p>Picked Every Item with Care,<br><span>YOU MUST TRY.</span></p>
            </div>
            <img src="assets/model.png" alt="Model Image">
        </div>
        <div class="offers">
            <div class="b1">
                <p><span>SUMMER COLLECTION</span><br>Go and Check out</p>
                <img src="assets/b1.png" alt="Summer Collection">
            </div>
            <div class="b2">
                <p><span>40% OFF</span><br>Men's Collection</p>
                <img src="assets/b2.png" alt="Men's Collection">
            </div>
            <div class="b3">
                <p><span>60% OFF</span><br>Women's Collection</p>
                <img src="assets/b3.png" alt="Women's Collection">
            </div>
            <div class="b4">
                <img src="assets/b4.png" alt="Beauty Collection">
                <p><span>BEAUTY COLLECTION</span><br>Get 20% OFF</p>
            </div>
        </div>
    </div>
    <video class="responsive-video" src="assets/video.mp4" autoplay loop muted></video>

    <img src="assets/model.jpeg" alt="" width="376.3">
    <img src="assets/model2.jpeg" alt="" width="376.3">
    <img src="assets/model6.jpeg" alt="" width="376.3">
    <img src="assets/model4.jpeg" alt="" width="376.3">
    <!-- <img src="assets/model1.jpeg" height="668px" alt=""> -->

    <div class="main-content2">
        <h2>HOME DECOR</h2>
        <div class="decor2">
            <div class="decor-item">
                <img src="assets/room.jpg" width="501.4" alt="Room 1">
                <div class="overlay-content">
                    <h3>SPACE SAVING FURNITURE</h3>
                    <box-icon name='chevron-right-circle' id="furniture" color="white" size="45px"></box-icon>
                </div>
            </div>
            <div class="decor-item">
                <img src="assets/room1.jpg" width="501.4" alt="Room 2">
                <div class="overlay-content">
                    <h3>GARDENING</h3>
                    <box-icon name='chevron-right-circle' id="garden" color="white" size="45px"></box-icon>
                </div>
            </div>
            <div class="decor-item">
                <img src="assets/room4.jpg" width="501.4" alt="Room 3">
                <div class="overlay-content">
                    <h3>HOME BEAUTIFICATION</h3>
                    <box-icon name='chevron-right-circle' id="homedecor" color="white" size="45px"></box-icon>
                </div>
            </div>
        </div>
    </div>
    <video class="responsive-video" src="assets/video2.mp4" autoplay loop muted></video>
    
    <div class="para">
        <div class="feature">
            <img src="assets/support.png" alt="24/7 Support">
            <h3>24/7 Support</h3>
            <p>We are here to help you at any time.</p>
        </div>
        <div class="feature">
            <img src="assets/handshake.png" alt="Secure Payment">
            <h3>Secure Payment</h3>
            <p>We ensure secure payment with PEV.</p>
        </div>
        <div class="feature">
            <img src="assets/money.png" alt="100% Money Back">
            <h3>100% Money Back</h3>
            <p>30 days money back guarantee.</p>
        </div>
        <div class="feature">
            <img src="assets/fast-delivery.png" alt="Fast Delivery">
            <h3>Fast Delivery</h3>
            <p>Quick and reliable delivery service.</p>
        </div>
    </div>

    <div class="electro">
        <img src="assets/cam.png" width="700px" alt="">
        <div class="electro-content">
            <h3>CAPTURE YOUR MEMORIES</h3>
            <!-- <p>Get the best deals on cameras and accessories</p> -->
            <button class="explore-button" id="explore-button">Explore</button>
        </div>
    </div>

</main>
<?php include 'footer.php'; ?>
<script>
    let slideIndex = 0;
    showSlides();

    function showSlides() {
        let slides = document.getElementsByClassName("slides")[0];
        let dots = document.getElementsByClassName("dot");
        if (slideIndex >= dots.length) {slideIndex = 0} // Reset index if it exceeds the number of dots
        for (let i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides.style.transform = `translateX(${-100 * slideIndex}%)`; // Adjusted the calculation for the transform
        dots[slideIndex].className += " active";
        slideIndex++;
        setTimeout(showSlides, 3000); // Change image every 3 seconds
    }

    function currentSlide(n) {
        slideIndex = n - 1;
        showSlides();
    }

    document.getElementById("furniture").addEventListener("click", function() {
            window.location.href = "f-furniture.php";
        });

    document.getElementById("garden").addEventListener("click", function() {
            window.location.href = "f-garden.php";
        });

    document.getElementById("homedecor").addEventListener("click", function() {
            window.location.href = "f-homedecor.php";
        });

    document.getElementById("explore-button").addEventListener("click", function() {
            window.location.href = "e-camera.php"; // Change this to the URL you want to navigate to
        });
</script>

</body>
</html>



