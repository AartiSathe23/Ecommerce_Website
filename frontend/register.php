<?php
session_start();
header('Content-Type: application/json');
include 'db.php'; // Include your database connection file

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password
    $phone_number = $_POST['phone'];

    // Check if the username already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $response['success'] = false;
        $response['message'] = "Username already exists. Please choose a different username.";
    } else {
        // Username is available, proceed to insert the new user
        $stmt = $conn->prepare("INSERT INTO users (username, password, phone_number) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $password, $phone_number);

        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = "Registration successful!";
        } else {
            $response['success'] = false;
            $response['message'] = "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
echo json_encode($response);
?>
