<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ensure the session variables are set before using them
$name = isset($_SESSION['name']) ? $_SESSION['name'] : 'Guest';
?>

<nav class="sidebar vertical-scroll dark_sidebar  ps-container ps-theme-default ps-active-y">
    <div class="logo d-flex justify-content-between">
        <a href="index-2.html"><img src="assets/logo1.png" style="height= 100px" alt></a>
        <div class="sidebar_close_icon d-lg-none">
            <i class="ti-close"></i>
        </div>
    </div>
    <ul id="sidebar_menu">
        <li class>
            <a href="index.php" aria-expanded="false">
                <div class="icon_menu">
                    <img src="assets/menu-icon/dashboard.svg" alt>
                </div>
                <span>Dashboard</span>
            </a>
        </li>
        <li class>
            <a class="has-arrow" href="#" aria-expanded="false">
                <div class="icon_menu">
                    <img src="assets/menu-icon/2.svg" alt>
                </div>
                <span>Collections</span>
            </a>
            <ul>
                <li><a href="add-collections.php">Add Collections</a></li>
                <li><a href="view-collections.php">View Collections</a></li>
                <li><a href="add-sub-collections.php">Add Sub Collections</a></li>
                <li><a href="view-sub-collections.php">View Sub Collections</a></li>
            </ul>
        </li>
        <li class>
            <a class="has-arrow" href="#" aria-expanded="false">
                <div class="icon_menu">
                    <img src="assets/menu-icon/8.svg" alt>
                </div>
                <span>Products</span>
            </a>
            <ul>
                <li><a href="add-products.php">Add Products</a></li>
                <li><a href="view-products.php">View Products</a></li>
                <!-- <li><a href="Product_Details.html">Product Details</a></li>
                <li><a href="Cart.html">Cart</a></li>
                <li><a href="Checkout.html">Checkout</a></li> -->
            </ul>
        </li>
        <li class>
            <a class="has-arrow" href="#" aria-expanded="false">
                <div class="icon_menu">
                    <img src="assets/menu-icon/13.svg" alt>
                </div>
                <span>Customers</span>
            </a>
            <ul>
                <li><a href="view-customers.php">View Customers</a></li>
                <li><a href="customer-feedback.php">Customer Feedback</a></li>
            </ul>
        </li>
        <li class>
            <a class="has-arrow" href="#" aria-expanded="false">
                <div class="icon_menu">
                    <img src="assets/menu-icon/16.svg" alt>
                </div>
                <span>Orders</span>
            </a>
            <ul>
                <li><a href="view-orders.php">View Orders</a></li>
                <li><a href="pending-orders.php">Pending Orders</a></li>
                <li><a href="completed-orders.php">Completed Orders</a></li>
                <li><a href="order-returns.php">Order Returns</a></li>
                <li><a href="order-reports.php">Order Reports</a></li>
            </ul>
        </li>
        <li class>
            <a class="has-arrow" href="#" aria-expanded="false">
                <div class="icon_menu">
                    <img src="assets/menu-icon/6.svg" alt>
                </div>
                <span>Invoice</span>
            </a>
            <ul>
                <li><a href="view-invoices.php">View Invoices</a></li>
                <li><a href="generate-invoice.php">Generate Invoice</a></li>
                <li><a href="pending-invoices.php">Pending Invoices</a></li>
            </ul>
        </li>
        <!-- <li class>
            <a class="has-arrow" href="#" aria-expanded="false">
                <div class="icon_menu">
                    <img src="assets/menu-icon/9.svg" alt>
                </div>
                <span>Users</span>
            </a>
            <ul>
                <li><a href="wow_animation.html">Animate</a></li>
                <li><a href="Scroll_Reveal.html">Scroll Reveal</a></li>
                <li><a href="tilt.html">Tilt Animation</a></li>
            </ul>
        </li> -->
    </ul>
</nav>

<section class="main_content dashboard_part large_header_bg">
    <div class="container-fluid g-0">
        <div class="row">
            <div class="col-lg-12 p-0 ">
                <div class="header_iner d-flex justify-content-between align-items-center">
                    <div class="sidebar_icon d-lg-none">
                        <i class="ti-menu"></i>
                    </div>
                    <div class="serach_field-area d-flex align-items-center">
                        <!-- <div class="search_inner">
                            <form action="#">
                                <div class="search_field">
                                    <input type="text" placeholder="Search here...">
                                </div>
                                <button type="submit"> <img src="assets/icon/icon_search.svg" alt> </button>
                            </form>
                        </div> -->
                        <!-- <span class="f_s_14 f_w_400 ml_25 white_text text_white">Apps</span> -->
                    </div>
                    <div class="header_right d-flex justify-content-between align-items-center">
                        <div class="header_notification_warp d-flex align-items-center">
                            <li>
                                <a class="bell_notification_clicker nav-link-notify" href="#"> <img
                                        src="assets/icon/bell.svg" alt>
                                </a>

                                <div class="Menu_NOtification_Wrap">
                                    <div class="notification_Header">
                                        <h4>Notifications</h4>
                                    </div>
                                    <div class="Notification_body">

                                        <div class="single_notify d-flex align-items-center">
                                            <div class="notify_thumb">
                                                <a href="#"><img src="assets/staf/2.png" alt></a>
                                            </div>
                                            <div class="notify_content">
                                                <a href="#">
                                                    <h5>Cool Marketing </h5>
                                                </a>
                                                <p>Lorem ipsum dolor sit amet</p>
                                            </div>
                                        </div>

                                        <div class="single_notify d-flex align-items-center">
                                            <div class="notify_thumb">
                                                <a href="#"><img src="assets/staf/4.png" alt></a>
                                            </div>
                                            <div class="notify_content">
                                                <a href="#">
                                                    <h5>Awesome packages</h5>
                                                </a>
                                                <p>Lorem ipsum dolor sit amet</p>
                                            </div>
                                        </div>

                                        <div class="single_notify d-flex align-items-center">
                                            <div class="notify_thumb">
                                                <a href="#"><img src="assets/staf/3.png" alt></a>
                                            </div>
                                            <div class="notify_content">
                                                <a href="#">
                                                    <h5>what a packages</h5>
                                                </a>
                                                <p>Lorem ipsum dolor sit amet</p>
                                            </div>
                                        </div>

                                        <div class="single_notify d-flex align-items-center">
                                            <div class="notify_thumb">
                                                <a href="#"><img src="assets/staf/2.png" alt></a>
                                            </div>
                                            <div class="notify_content">
                                                <a href="#">
                                                    <h5>Cool Marketing </h5>
                                                </a>
                                                <p>Lorem ipsum dolor sit amet</p>
                                            </div>
                                        </div>

                                        <div class="single_notify d-flex align-items-center">
                                            <div class="notify_thumb">
                                                <a href="#"><img src="assets/staf/4.png" alt></a>
                                            </div>
                                            <div class="notify_content">
                                                <a href="#">
                                                    <h5>Awesome packages</h5>
                                                </a>
                                                <p>Lorem ipsum dolor sit amet</p>
                                            </div>
                                        </div>

                                        <div class="single_notify d-flex align-items-center">
                                            <div class="notify_thumb">
                                                <a href="#"><img src="assets/staf/3.png" alt></a>
                                            </div>
                                            <div class="notify_content">
                                                <a href="#">
                                                    <h5>what a packages</h5>
                                                </a>
                                                <p>Lorem ipsum dolor sit amet</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nofity_footer">
                                        <div class="submit_button text-center pt_20">
                                            <a href="#" class="btn_1">See More</a>
                                        </div>
                                    </div>
                                </div>

                            </li>
                            <li>
                                <a class="CHATBOX_open nav-link-notify" href="#"> <img src="assets/icon/msg.svg" alt>
                                </a>
                            </li>
                        </div>
                        <div class="profile_info">
                            <img src="assets/client_img.png" alt="#">
                            <div class="profile_info_iner">
                                <div class="profile_author_name">
                                    <h5><?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?></h5>
                                </div>
                                <div class="profile_info_details">
                                    <a href="profile.php">My Profile </a>
                                    <!-- <a href="#">Settings</a> -->
                                    <a href="logout.php">Log Out </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
