<?php
// logout.php
session_start();
session_unset();
session_destroy();
header("Location: cust_login.html");
exit;
?>
