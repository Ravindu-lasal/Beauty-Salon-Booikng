<?php
include 'includes/header.php';
include 'includes/navigation.php';


// Get user ID from session
$user_id = $_SESSION['user_id'] ?? null;

if ($user_id) {
    // Prepare SQL to fetch only this user's appointments
    $sql = "SELECT a.appointment_id, a.appointment_date, a.appointment_time, a.status, a.created_at,
                   u.username AS customer_name, s.username AS staff_name
            FROM appointments a
            LEFT JOIN users u ON a.user_id = u.user_id
            LEFT JOIN users s ON a.staff_id = s.user_id
            WHERE a.user_id = ?
            ORDER BY a.created_at DESC";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    // No user logged in
    $result = false;
}
?>

<?php

if (isset($_GET['cancelid'])) {
    $appointment_id = intval($_GET['cancelid']);

    $sql = "UPDATE appointments SET status = 'Cancelled' WHERE appointment_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $appointment_id);

    if ($stmt->execute()) {
        // Success: redirect back or show message
        echo "<script>alert('Appointment cancelled successfully.'); window.location.href='my_appoinment.php';</script>";
        exit;
    } else {
        echo "Error cancelling appointment.";
    }
}
?>


<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center py-5">
        <h1 class="display-3 text-white text-uppercase mb-3 animated slideInDown">My Appointment</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center text-uppercase mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                <li class="breadcrumb-item text-primary active" aria-current="page">My Appointment</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<!-- Appointments Table Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <p class="d-inline-block bg-secondary text-primary py-1 px-4">My Appointment</p>
            <h1 class="text-uppercase">Your Appointments</h1>
        </div>
        <div class="row g-4">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Staff</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i = 1;
                        if ($result && $result->num_rows > 0):
                            while ($row = $result->fetch_assoc()):
                    ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= htmlspecialchars($row['customer_name'] ?? 'N/A') ?></td>
                                    <td><?= htmlspecialchars($row['staff_name'] ?? 'N/A') ?></td>
                                    <td><?= htmlspecialchars($row['appointment_date']) ?></td>
                                    <td><?= htmlspecialchars($row['appointment_time']) ?></td>
                                    <td><?= htmlspecialchars($row['status']) ?></td>
                                    <td>
                                        <?php 
                                            if ($row['status'] == 'cancelled'){
                                                echo '<span class="text-danger">Cancelled</span>';
                                            } else if ($row['status'] == 'completed') {
                                                echo '<span class="text-success">Completed</span>';
                                            } else { 
                                                // Output the cancel button correctly
                                                echo '<a href="my_appoinment.php?cancelid=' . htmlspecialchars($row['appointment_id']) . '" class="btn btn-danger btn-sm">Cancel</a>';
                                            }
                                        ?>
                                    </td>
                                </tr>
                    <?php
                            endwhile;
                    ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7">No appointments found.</td>
                            </tr>
                    <?php
                        endif;
                    ?>

                    
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Appointments Table End -->

<?php include './includes/footer.php'; ?>
