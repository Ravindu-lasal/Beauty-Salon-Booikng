<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        echo "<script>alert('Email and password are required.'); window.history.back();</script>";
    } else {
        // Get user with matching email
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            // Verify the password
            if (password_verify($password, $user['password_hash'])) {
                // Start session and set user data
                session_start();
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                // Redirect based on role
                if ($user['role'] === 'admin') {
                    echo "<script>alert('Login successful!'); window.location.href='../admin/index.php';</script>";
                } elseif ($user['role'] === 'staff') {
                    echo "<script>alert('Login successful!'); window.location.href='../admin/index.php';</script>";
                } elseif ($user['role'] === 'customer') {
                    echo "<script>alert('Login successful!'); window.location.href='../index.php';</script>";
                } else {
                    echo "<script>alert('Invalid role.'); window.history.back();</script>";
                }
            } else {
                echo "<script>alert('Invalid email or password.'); window.history.back();</script>";
            }
        } else {
            echo "<script>alert('Invalid email or password.'); window.history.back();</script>";
        }
    }
}

?>