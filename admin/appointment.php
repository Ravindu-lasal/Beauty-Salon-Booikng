

<?php include 'includes/header.php'; ?>
<?php include 'includes/navigation.php'; ?>

<?php
 if (isset($_GET['confirmid'])) {
    $appointment_id = $_GET['confirmid'];
    $update_sql = "UPDATE appointments SET status='confirmed' WHERE appointment_id='$appointment_id'";
    if ($conn->query($update_sql) === TRUE) {
        echo '<script>alert("Appointment confirmed successfully!"); window.location.href="appointment.php";</script>';
    }
    else {
        echo '<script>alert("Error confirming appointment: ' . $conn->error . '");</script>';
    }
    }
?>
        
        <div id="layoutSidenav">
            
            <?php include 'includes/sidebar.php'; ?>
            
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Appoinment Details</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">admin/appoinment</li>
                        </ol>
                        
                     
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="fas fa-table me-1"></i>
                                    All Appoinment
                                </div>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStaffModal">Add Appoinment</button>
                            </div>

                            <div class="card-body">
                                

                            <table id="datatablesSimple" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Username</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Staff Member</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <th>Billing</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Username</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Staff Member</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <th>Billing</th>
                                    </tr>
                                </tfoot>

                                <?php
                                    $sql = "SELECT a.*, u.username AS customer_name, s.username AS staff_name FROM appointments a
                                            LEFT JOIN users u ON a.user_id = u.user_id
                                            LEFT JOIN users s ON a.staff_id = s.user_id
                                            ORDER BY a.created_at DESC";
                                    $result = $conn->query($sql);
                                    ?>
                                <tbody>
                                    <?php if ($result && $result->num_rows > 0): ?>
                                    <?php $i = 1; while ($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= htmlspecialchars($row['customer_name']) ?></td>
                                        <td><?= $row['appointment_date'] ?></td>
                                        <td><?= $row['appointment_time'] ?></td>
                                        <td><?= $row['staff_name'] ?? 'Unassigned' ?></td>
                                        <td>
                                            <?php if ($row['status'] == 'pending'){
                                                echo '<a href="appointment.php?confirmid=' . $row['appointment_id'] . '" class="btn btn-success btn-sm">Confirm</a>';
                                            }
                                            elseif ($row['status'] == 'confirmed') {
                                                echo '<span class="badge bg-success">Confirmed</span>';
                                            } elseif ($row['status'] == 'cancelled') {
                                                echo '<span class="badge bg-danger">Cancelled</span>';
                                            } elseif ($row['status'] == 'completed') {
                                                echo '<span class="badge bg-info">Completed</span>';
                                            } ?>
                                        </td>
                                        <td>
                                            <div class="text-center d-flex flex-nowrap gap-2 justify-content-center">
                                            <?php if ($row['status'] == 'pending'){
                                                echo '<a href="appointment.php?canceledid=' . $row['appointment_id'] . '" class="btn btn-danger btn-sm">Cancel</a>';
                                            }
                                            elseif ($row['status'] == 'confirmed') {
                                                echo '<button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editAppointmentModal' . $row['appointment_id'] . '">Edit</button>';
                                                echo '<a href="appointment.php?canceledid=' . $row['appointment_id'] . '" class="btn btn-danger btn-sm">Cancel</a>';
                                            } elseif ($row['status'] == 'cancelled') {
                                                echo '<button class="btn btn-secondary btn-sm" disabled>Cancelled</button>';
                                            } elseif ($row['status'] == 'completed') {
                                                echo '<button class="btn btn-info btn-sm text-light" disabled>Completed</button>';
                                            } ?>
                                            </div>
                                           
                                        </td>
                                        <td>
                                            <div class="text-center d-flex flex-nowrap gap-2 justify-content-center">
                                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#viewAppointmentModal' . $row['appointment_id'] . '">View</button>
                                                <a href="" class="btn btn-primary btn-sm text-center">Manage</a>
                                            </div>                                            
                                        </td>
                                    </tr>

                                    <!-- Modal Form (preloaded) -->
                                    <div class="modal fade" id="editAppointmentModal<?= $row['appointment_id'] ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $row['appointment_id'] ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                        <form action="update_appointment.php" method="post">
                                            <div class="modal-header">
                                            <h5 class="modal-title">Edit Appointment #<?= $row['appointment_id'] ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="location.reload()"></button>
                                            </div>
                                            <div class="modal-body">
                                            <input type="hidden" name="appointment_id" value="<?= $row['appointment_id'] ?>">

                                            <label>Customer: <?= htmlspecialchars($row['customer_name']) ?></label><br>
                                            <label>Date: <?= $row['appointment_date'] ?> Time: <?= $row['appointment_time'] ?></label><br><br>

                                            <!-- Staff Dropdown -->
                                            <label>Assign Staff</label>
                                            <select name="staff_id" class="form-select">
                                                <option value="">-- Select Staff --</option>
                                                <?php
                                                $staff_result = $conn->query("SELECT user_id, username FROM users WHERE role='staff'");
                                                while($staff = $staff_result->fetch_assoc()):
                                                ?>
                                                <option value="<?= $staff['user_id'] ?>" <?= ($staff['user_id'] == $row['staff_id']) ? 'selected' : '' ?>>
                                                    <?= htmlspecialchars($staff['username']) ?>
                                                </option>
                                                <?php endwhile; ?>
                                            </select>

                                            <h5 class="mt-3">Select Services</h5>
                                            <?php
                                            $services_result = $conn->query("SELECT service_id, service_name, price FROM services");
                                            $selected_result = $conn->query("SELECT service_id FROM appointment_services WHERE appointment_id=" . $row['appointment_id']);
                                            $selected_services = [];
                                            while($sel = $selected_result->fetch_assoc()) { $selected_services[] = $sel['service_id']; }
                                            while($service = $services_result->fetch_assoc()):
                                            ?>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="services[]" value="<?= $service['service_id'] ?>"
                                                <?= in_array($service['service_id'], $selected_services) ? 'checked' : '' ?>>
                                                <label class="form-check-label">
                                                <?= htmlspecialchars($service['service_name']) ?> (LKR <?= number_format($service['price'], 2) ?>)
                                                </label>
                                            </div>
                                            <?php endwhile; ?>
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="location.reload();">Cancel</button>    <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                    </div>

                                    <?php endwhile; ?>
                                    <?php else: ?>
                                    <tr><td colspan="7">No appointments found.</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>

                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            
        </div>


<?php include 'includes/footer.php'; ?>