<?php
require_once '../../config/db.con.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $appointment_id = $_POST['appointment_id'];
    $staff_id = !empty($_POST['staff_id']) ? $_POST['staff_id'] : NULL; // Allow null for unassigned
    $services = isset($_POST['services']) ? $_POST['services'] : [];

    // Update appointments table (assign staff_id)
    if ($staff_id !== NULL) {
        $stmt = $conn->prepare("UPDATE appointments SET staff_id = ? WHERE appointment_id = ?");
        $stmt->bind_param("ii", $staff_id, $appointment_id);
    } else {
        $stmt = $conn->prepare("UPDATE appointments SET staff_id = NULL WHERE appointment_id = ?");
        $stmt->bind_param("i", $appointment_id);
    }
    if (!$stmt->execute()) {
        echo "Error updating appointment: " . $stmt->error;
        exit;
    }
    $stmt->close();

    // Delete old services for this appointment
    $stmt = $conn->prepare("DELETE FROM appointment_services WHERE appointment_id = ?");
    $stmt->bind_param("i", $appointment_id);
    if (!$stmt->execute()) {
        echo "Error deleting old services: " . $stmt->error;
        exit;
    }
    $stmt->close();

    // Insert new services (if any)
    if (!empty($services)) {
        $stmt = $conn->prepare("INSERT INTO appointment_services (appointment_id, service_id) VALUES (?, ?)");
        foreach ($services as $service_id) {
            $stmt->bind_param("ii", $appointment_id, $service_id);
            if (!$stmt->execute()) {
                echo "Error adding service $service_id: " . $stmt->error;
                exit;
            }
        }
        $stmt->close();
    }

    echo "Appointment updated successfully!";
    header("Location: {$_SERVER['HTTP_REFERER']}?msg=appointment_updated");
    exit;
} else {
    echo "Invalid request.";
}
?>
