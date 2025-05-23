<?php
require_once '../config/db.con.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $table = $_GET['table'] ?? null;
    $id = $_GET['id'] ?? null;

    // Define allowed tables and their primary keys
    $allowedTables = [
        'users' => 'user_id',
        'staff' => 'staff_id',
        'services' => 'service_id',
        'appointments' => 'appointment_id',
        'appointment_services' => 'appointment_service_id',
        'payments' => 'payment_id',
        'feedback' => 'feedback_id'
    ];

    // Validate input
    if (!$table || !$id || !array_key_exists($table, $allowedTables)) {
        $error = urlencode("Invalid delete request.");
        header("Location: {$_SERVER['HTTP_REFERER']}?error=$error");
        exit;
    }

    $column = $allowedTables[$table];

    // Prepare and execute the delete statement
    $stmt = $conn->prepare("DELETE FROM `$table` WHERE `$column` = ?");
    if ($stmt === false) {
        $error = urlencode("SQL Error: " . $conn->error);
        header("Location: {$_SERVER['HTTP_REFERER']}?error=$error");
        exit;
    }

    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: {$_SERVER['HTTP_REFERER']}?msg=deleted");
        exit;
    } else {
        $error = urlencode("Unable to delete record: " . $stmt->error);
        // $error = urlencode("Unable to delete the record. Please try again later.");

        header("Location: {$_SERVER['HTTP_REFERER']}?error=$error");
        exit;
    }
}
?>
