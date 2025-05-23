<?php
require_once '../config/db.con.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../user/login.php");
    exit();
}

// Fetch user data from the database
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Check if the user is an admin
if ($user['role'] !== 'admin') {
    // User is not an admin, redirect to a different page
    header("Location: ../index.php?massage=your_not_write_roles");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">

       <!-- Toast (Updated to Support Error Styling) -->
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999">
        <div id="actionToast" class="toast align-items-center border-0" role="alert">
            <div class="d-flex">
            <div class="toast-body" id="toastMessage">Status Message</div>
            <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const toastEl = document.getElementById('actionToast');
                const toastMsg = document.getElementById('toastMessage');
                const params = new URLSearchParams(window.location.search);

                let message = '';
                let isError = false;

                if (params.has('msg')) {
                const msg = params.get('msg');
                switch (msg) {
                    case 'updated':
                    message = 'User updated successfully!';
                    break;
                    case 'deleted':
                    message = 'User deleted successfully!';
                    break;
                    default:
                    message = 'Action completed.';
                }
                }

                if (params.has('error')) {
                message = params.get('error');
                isError = true;
                }

                if (message) {
                toastMsg.textContent = message;
                toastEl.classList.remove('bg-success', 'bg-danger');
                toastEl.classList.add(isError ? 'bg-danger' : 'bg-success');

                const toast = new bootstrap.Toast(toastEl);
                toast.show();

                // Clean the URL
                window.history.replaceState({}, document.title, window.location.pathname);
                }
            });
        </script>



