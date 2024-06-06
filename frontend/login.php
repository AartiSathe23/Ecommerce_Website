<?php
session_start();
header('Content-Type: application/json');
include 'db.php'; // Include your database connection file

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password, phone_number FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password, $phone_number);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['phone_number'] = $phone_number;
            $response['success'] = true;
            $response['message'] = "Login successful!";
        } else {
            $response['success'] = false;
            $response['message'] = "Invalid password.";
        }
    } else {
        $response['success'] = false;
        $response['message'] = "No user found with that username.";
    }

    $stmt->close();
}

$conn->close();
echo json_encode($response);
?>
