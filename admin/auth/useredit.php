<?php
require_once '../../config/db.con.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id      = $_POST['user_id'];  // Must be included in the form
    $username     = trim($_POST['username']);
    $full_name    = trim($_POST['full_name']);
    $email        = trim($_POST['email']);
    $phone        = trim($_POST['phone']);
    $role         = $_POST['role'];
    $hire_date      = !empty($_POST['hire_date']) ? $_POST['hire_date'] : null;

    // Prepare SQL for update
    $stmt = $conn->prepare("UPDATE users 
                            SET username = ?, role = ?, full_name = ?, phone = ?, email = ?, hire_date = ?
                            WHERE user_id = ?");

    if ($stmt === false) {
        die("SQL error: " . $conn->error);
    }

    $stmt->bind_param(
        "ssssssi",
        $username,
        $role,
        $full_name,
        $phone,
        $email,
        $hire_date,
        $user_id
    );

    if ($stmt->execute()) {
        header("Location: {$_SERVER['HTTP_REFERER']}?msg=updated");
        exit;
    } else {
        $error = urlencode("Failed to update user: " . $stmt->error);
        header("Location: {$_SERVER['HTTP_REFERER']}?error=$error");
        exit;
    }
}
?>
