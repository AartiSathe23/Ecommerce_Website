<?php
session_start();
header('Content-Type: application/json');
include 'db.php'; // Include your database connection file

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare the SQL statement to select the user by email
    $stmt = $conn->prepare("SELECT admin_id, name, email, password, address_line1, address_line2, city, state, postal_code, country, phone, pan FROM admin_management WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($admin_id, $name, $email, $hashed_password, $address_line1, $address_line2, $city, $state, $postal_code, $country, $phone, $pan);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Set session variables
            $_SESSION['admin_id'] = $admin_id;
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            $_SESSION['address_line1'] = $address_line1;
            $_SESSION['address_line2'] = $address_line2;
            $_SESSION['city'] = $city;
            $_SESSION['state'] = $state;
            $_SESSION['postal_code'] = $postal_code;
            $_SESSION['country'] = $country;
            $_SESSION['phone'] = $phone;
            $_SESSION['pan'] = $pan;

            $response['success'] = true;
            $response['message'] = "Login successful!";
        } else {
            $response['success'] = false;
            $response['message'] = "Invalid password.";
        }
    } else {
        $response['success'] = false;
        $response['message'] = "No user found with that email.";
    }

    $stmt->close();
}

$conn->close();
echo json_encode($response);
?>

