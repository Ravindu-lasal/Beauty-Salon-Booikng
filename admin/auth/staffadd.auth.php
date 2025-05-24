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

    // Securely hash password
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // SQL Insert
    $stmt = $conn->prepare("INSERT INTO users 
        (username, password_hash, role, full_name, email, phone, specialization, availability, hire_date) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        $error = urlencode("Prepare failed: " . $conn->error);
        header("Location: {$_SERVER['HTTP_REFERER']}?error=$error");
        exit;
    }

    $stmt->bind_param(
        "sssssssis",
        $username,
        $password_hash,
        $role,
        $full_name,
        $email,
        $phone,
        $specialization,
        $availability,
        $hire_date
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
