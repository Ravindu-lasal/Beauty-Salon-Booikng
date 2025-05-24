<?php
require_once '../../config/db.con.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize inputs
    $service_name = trim($_POST['service_name']);
    $price = $_POST['price'];
    $durations = $_POST['durations'];
    $description = trim($_POST['description']);

    // Optionally, add basic validation
    if (empty($service_name) || empty($price) || empty($durations) || empty($description)) {
        header("Location: {$_SERVER['HTTP_REFERER']}?error=missing_fields");
        exit;
    }

    if (!is_numeric($price) || !is_numeric($durations)) {
        header("Location: {$_SERVER['HTTP_REFERER']}?error=invalid_input");
        exit;
    }

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO services (service_name, description, price, duration_minutes) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssdi", $service_name, $description, $price, $durations);

    // Execute and check
    if ($stmt->execute()) {
        // Success
        header("Location: {$_SERVER['HTTP_REFERER']}?msg=service_added");
    } else {
        // Error
        header("Location: {$_SERVER['HTTP_REFERER']}?error=sql_error");
    }

    $stmt->close();
    $conn->close();
} else {
    // Handle direct access (optional)
    header("Location: {$_SERVER['HTTP_REFERER']}?error=invalid_request");
}
?>

