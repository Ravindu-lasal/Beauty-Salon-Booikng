<?php
require_once '../../config/db.con.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username   = trim($_POST['username']);
    $password   = $_POST['password'];
    $full_name  = trim($_POST['full_name']);
    $email      = trim($_POST['email']);
    $phone      = trim($_POST['phone']);
    $role       = $_POST['role'];
    $specialization = $_POST['specialization'] ?? null;
    $availability   = isset($_POST['availability']) ? (int)$_POST['availability'] : 0;
    $hire_date      = !empty($_POST['hire_date']) ? $_POST['hire_date'] : null;
    $image      = $_FILES['image'] ?? null;


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

    // Securely hash password
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // SQL Insert
    $stmt = $conn->prepare("INSERT INTO users 
        (username, password_hash, role, full_name, email, phone, specialization, availability, hire_date, image_path) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        $error = urlencode("Prepare failed: " . $conn->error);
        header("Location: {$_SERVER['HTTP_REFERER']}?error=$error");
        exit;
    }

    $stmt->bind_param(
        "sssssssiss",
        $username,
        $password_hash,
        $role,
        $full_name,
        $email,
        $phone,
        $specialization,
        $availability,
        $hire_date,
        $image_filename
    );

    if ($stmt->execute()) {
        header("Location: {$_SERVER['HTTP_REFERER']}?msg=staff_added");
    } else {
        $error = urlencode("Insert failed: " . $stmt->error);
        header("Location: {$_SERVER['HTTP_REFERER']}?error=$error");
    }

    $stmt->close();
    $conn->close();
}
?>
