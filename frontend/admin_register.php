<?php
session_start();
header('Content-Type: application/json');
include 'db.php'; // Include your database connection file

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $admin_id = mt_rand(11111,99999);
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password
    $phone_number = $_POST['phone'];
    $pan = $_POST['pan'];
    $address_line1 = $_POST['address_line1'];
    $address_line2 = $_POST['address_line2'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $postal_code = $_POST['postal_code'];
    $country = $_POST['country'];

    // Check if the email already exists
    $stmt = $conn->prepare("SELECT id FROM admin_management WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $response['success'] = false;
        $response['message'] = "Email already exists. Please choose a different email.";
    } else {
        // Email is available, proceed to insert the new user
        $stmt = $conn->prepare("INSERT INTO admin_management (admin_id, name, email, password, address_line1, address_line2, city, state, postal_code, country, phone, pan) VALUES (?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssssss", $admin_id, $name, $email, $password, $address_line1, $address_line2, $city, $state, $postal_code, $country, $phone_number, $pan);

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

