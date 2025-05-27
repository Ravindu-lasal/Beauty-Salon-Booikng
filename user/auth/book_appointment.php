<?php
include '../../config/db.con.php'; // Your DB connection
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if the user is logged in
    session_start();
    if (!isset($_SESSION['user_id'])) {
        echo "You must be logged in to book an appointment.";
        exit;
    }

    // Validate and sanitize input
    $user_id = $_SESSION['user_id']; // Use session user_id
    $date = $_POST['date'] ?? null;
    $time = $_POST['time'] ?? null;
    $beautician_id = !empty($_POST['staff_id']) ? $_POST['staff_id'] : null;
    $message = $_POST['message'] ?? '';
    $services = $_POST['services'] ?? [];

    // Validate required fields except beautician_id
    if (empty($date) || empty($time) || empty($message) || empty($services)) {
        echo "<script>alert('Date, time, message, and at least one service are required.'); window.history.back();</script>";
        
        exit;
    }

    if (!empty($services)) {
        // Insert appointment (no total_price)
        $stmt = $conn->prepare("INSERT INTO appointments (user_id, staff_id, appointment_date, appointment_time, notes) VALUES (?, ?, ?, ?, ?)");
        // Use "i" for user_id, "i" or "null" for staff_id
        if ($beautician_id !== null) {
            $stmt->bind_param("iisss", $user_id, $beautician_id, $date, $time, $message);
        } else {
            // Use "NULL" for staff_id by setting it explicitly
            $stmt = $conn->prepare("INSERT INTO appointments (user_id, staff_id, appointment_date, appointment_time, notes) VALUES (?, NULL, ?, ?, ?)");
            $stmt->bind_param("isss", $user_id, $date, $time, $message);
        }

        if ($stmt->execute()) {
            $appointment_id = $stmt->insert_id;
            $stmt->close();

            // Insert selected services
            $stmt = $conn->prepare("INSERT INTO appointment_services (appointment_id, service_id) VALUES (?, ?)");
            foreach ($services as $service_id) {
                $stmt->bind_param("ii", $appointment_id, $service_id);
                $stmt->execute();
            }
            $stmt->close();

            echo "<script>alert('Appointment booked successfully.'); window.location.href='../my_appoinment.php';</script>";
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Please select at least one service.";
    }
}
$conn->close();
?>
