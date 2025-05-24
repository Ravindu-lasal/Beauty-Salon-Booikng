<?php
require_once '../../config/db.con.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve and sanitize form inputs
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $date = $_POST['date'];
    $time = $_POST['time'];
    $staff_id = $_POST['staff_id'];
    $message = trim($_POST['message']);
    $services = isset($_POST['services']) ? $_POST['services'] : [];

    // Insert or retrieve user (assume user not logged in)
    $stmt = $conn->prepare("INSERT INTO users (full_name, email, phone, role) VALUES (?, ?, ?, 'customer')");
    $stmt->bind_param("sss", $name, $email, $phone);
    if (!$stmt->execute()) {
        die("Error inserting user: " . $conn->error);
    }
    $user_id = $conn->insert_id;
    $stmt->close();

    // Insert appointment
    $stmt = $conn->prepare("INSERT INTO appointments (user_id, staff_id, appointment_date, appointment_time, notes) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iisss", $user_id, $staff_id, $date, $time, $message);
    if (!$stmt->execute()) {
        die("Error inserting appointment: " . $conn->error);
    }
    $appointment_id = $conn->insert_id;
    $stmt->close();

    // Insert selected services
    if (!empty($services)) {
        $stmt = $conn->prepare("INSERT INTO appointment_services (appointment_id, service_id) VALUES (?, ?)");
        foreach ($services as $service_id) {
            $stmt->bind_param("ii", $appointment_id, $service_id);
            if (!$stmt->execute()) {
                die("Error inserting service: " . $conn->error);
            }
        }
        $stmt->close();
    }

    // Success
    header("Location: ../user/confirmation.php?success=1");
    exit;
} else {
    echo "Invalid request.";
}
?>
