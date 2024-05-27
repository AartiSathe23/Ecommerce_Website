<?php
session_start();

// Allow CORS
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Generate a 4-digit OTP
$otp = rand(1000, 9999);

// Store OTP in session
$_SESSION['otp'] = $otp;

// Simulate sending OTP by displaying it (In practice, you would send this via SMS API)
echo json_encode(['otp' => $otp]);
?>
