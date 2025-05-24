<?php
require_once '../../config/db.con.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $service_id = $_POST['service_id'];
    $service_name = trim($_POST['service_name']);
    $price = $_POST['price'];
    $durations = $_POST['durations'];
    $description = trim($_POST['description']);

    // Validation (recommended)
    if (empty($service_id) || empty($service_name) || empty($price) || empty($durations) || empty($description)) {
        header("Location: {$_SERVER['HTTP_REFERER']}?error=missing_fields");
        exit;
    }

    if (!is_numeric($price) || !is_numeric($durations)) {
        header("Location: {$_SERVER['HTTP_REFERER']}?error=invalid_input");
        exit;
    }

    // Prepare SQL update statement
    $stmt = $conn->prepare("UPDATE services SET service_name = ?, description = ?, price = ?, duration_minutes = ? WHERE service_id = ?");
    $stmt->bind_param("ssdii", $service_name, $description, $price, $durations, $service_id);

    if ($stmt->execute()) {
        header("Location: {$_SERVER['HTTP_REFERER']}?msg=service_updated");
    } else {
        header("Location: {$_SERVER['HTTP_REFERER']}?error=sql_error");
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: {$_SERVER['HTTP_REFERER']}?error=invalid_request");
}
?>
