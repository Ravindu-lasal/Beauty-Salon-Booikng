<?php
require_once '../../config/db.con.php'; // Update path if needed

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username   = trim($_POST['username']);
    $full_name  = trim($_POST['full_name']);
    $email      = trim($_POST['email']);
    $password   = $_POST['password'];
    $phone      = trim($_POST['phone']);
    $role       = $_POST['role'];

    // Optional fields (for 'staff' role)
    $specialization = $_POST['specialization'] ?? null;
    $availability   = isset($_POST['availability']) ? 1 : null;

    // Hash the password
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Prepare insert statement
    $stmt = $conn->prepare("INSERT INTO users 
        (username, password_hash, role, full_name, phone, email, specialization, availability)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        $error = urlencode("SQL Prepare Failed: " . $conn->error);
        header("Location: users.php?error=$error");
        exit;
    }

    $stmt->bind_param(
        "sssssssi",
        $username,
        $password_hash,
        $role,
        $full_name,
        $phone,
        $email,
        $specialization,
        $availability
    );

    if ($stmt->execute()) {
        header("Location: {$_SERVER['HTTP_REFERER']}?msg=inserted");
        exit;
    } else {
        $error = urlencode("Insert Failed: " . $stmt->error);
        header("Location: {$_SERVER['HTTP_REFERER']}?error=$error");
        exit;
    }
}
?>
