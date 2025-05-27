<?php
require_once '../../config/db.con.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get and sanitize input
    $user_id     = intval($_POST['user_id']);
    $username    = trim($_POST['username']);
    $full_name   = trim($_POST['full_name']);
    $email       = trim($_POST['email']);
    $phone       = trim($_POST['phone']);
    $specialization = trim($_POST['specialization'] ?? '');
    $role        = trim($_POST['role']);
    $availability = isset($_POST['availability']) ? (int)$_POST['availability'] : 0;
    $hire_date   = !empty($_POST['hire_date']) ? $_POST['hire_date'] : null;
    $image       = $_FILES['image'] ?? null;

    $image_filename = null;
    if ($image && $image['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        $image_filename = uniqid('staff_', true) . '.' . $ext;
        $upload_dir = '../../user/img/uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        move_uploaded_file($image['tmp_name'], $upload_dir . $image_filename);
    }

    // Prepare update query
    $stmt = $conn->prepare("UPDATE users SET 
        username = ?, 
        full_name = ?, 
        email = ?, 
        phone = ?, 
        role = ?, 
        image_path = COALESCE(?, image_path),
        specialization = ?, 
        availability = ?, 
        hire_date = ?
        WHERE user_id = ?");

    if (!$stmt) {
        $error = urlencode("Prepare failed: " . $conn->error);
        header("Location: {$_SERVER['HTTP_REFERER']}?error=$error");
        exit;
    }

    $stmt->bind_param(
        "sssssssisi",
        $username,
        $full_name,
        $email,
        $phone,
        $role,
        $image_filename,
        $specialization,
        $availability,
        $hire_date,
        $user_id
    );

    if ($stmt->execute()) {
        header("Location: {$_SERVER['HTTP_REFERER']}?msg=updated");
    } else {
        $error = urlencode("Update failed: " . $stmt->error);
        header("Location:{$_SERVER['HTTP_REFERER']}?error=$error");
    }

    $stmt->close();
    $conn->close();
}
?>
