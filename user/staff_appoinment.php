<?php
include 'includes/header.php';
include 'includes/navigation.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'staff') {
    // Redirect to index or show error message
    $_SESSION['error'] = "You do not have permission to access this page.";
    header("Location: ../index.php");
    exit;
}

$user_id = $_SESSION['user_id'] ?? null;

if ($user_id) {
    $sql = "SELECT a.appointment_id, a.appointment_date, a.appointment_time, a.status, a.created_at,
                   u.username AS customer_name, s.username AS staff_name
            FROM appointments a
            LEFT JOIN users u ON a.user_id = u.user_id
            LEFT JOIN users s ON a.staff_id = s.user_id
            WHERE a.staff_id = ?
            ORDER BY a.created_at DESC";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = false;
}
?>


<!-- Appointments Table Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <p class="d-inline-block bg-secondary text-primary py-1 px-4">Staff Member : <?php echo $_SESSION['username']; ?></p>
            <h1 class="text-uppercase">Appointments Assigned</h1>
        </div>
        <div class="row g-4">
            <table class="table table-bordered table-responsive">
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
                                    if ($row['status'] == 'cancelled') {
                                        echo '<span class="text-danger">Cancelled</span>';
                                    } else if ($row['status'] == 'completed') {
                                        echo '<span class="text-success">Completed</span>';
                                    } else if ($row['status'] == 'pending') {
                                        echo '<span class="text-warning">Pending</span>';
                                    } else {
                                        echo '<span class="text-primary">Active</span>';
                                    }
                                ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7">No appointments found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Appointments Table End -->

<?php include './includes/footer.php'; ?>
