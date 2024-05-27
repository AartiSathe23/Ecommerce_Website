<?php
session_start();

// Allow CORS
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$response = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['otp'])) {
        $entered_otp = $_POST['otp'];
        $stored_otp = $_SESSION['otp'];

        if ($entered_otp == $stored_otp) {
            $response['status'] = 'success';
            $response['message'] = 'OTP Verified Successfully!';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Invalid OTP. Please try again.';
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'OTP not provided.';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method.';
}

echo json_encode($response);
?>
