<?php
    require_once '../config/db.con.php';
    if (isset($_GET['confirmid'])) {
        $appointment_id = $_GET['confirmid'];
        $update_sql = "UPDATE appointments SET status='confirmed' WHERE appointment_id='$appointment_id'";
        if ($conn->query($update_sql) === TRUE) {
            echo '<script>alert("Appointment confirmed successfully!"); window.location.href="appointment_confirm.php";</script>';
        }
        else {
            echo '<script>alert("Error confirming appointment: ' . $conn->error . '");</script>';
        }
        }

    if (isset($_GET['canceledid'])) {
        $appointment_id = $_GET['canceledid'];
        $update_sql = "UPDATE appointments SET status='cancelled' WHERE appointment_id='$appointment_id'";
        if ($conn->query($update_sql) === TRUE) {
            // Redirect with success message in URL
            header("Location: appointment_confirm.php?msg=appointment_cancelled");
            exit();
        }    else {
            echo '<script>alert("Error cancelling appointment: ' . $conn->error . '");</script>';
        }
    }

    if (isset($_GET['completeid'])) {
        $appointment_id = $_GET['completeid'];
        $update_sql = "UPDATE appointments SET status='completed' WHERE appointment_id='$appointment_id'";
        if ($conn->query($update_sql) === TRUE) {
            // Redirect with success message in URL
            header("Location: appointment_confirm.php?msg=appointment_completed");
            exit();
        }
        else {
            echo '<script>alert("Error completing appointment: ' . $conn->error . '");</script>';
        }
    }

?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/navigation.php'; ?>


        
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
                                            WHERE a.status = 'confirmed'
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
                                                echo '<span class="badge bg-warning">Pending</span>';
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
                                                echo '<button class="btn btn-primary btn-sm" disabled>Edit</button>';
                                                echo '<a href="appointment_confirm.php?canceledid=' . $row['appointment_id'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to cancel this appointment?\')">Cancel</a>'; 
                                            }
                                            elseif ($row['status'] == 'confirmed') {
                                                echo '<button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editAppointmentModal' . $row['appointment_id'] . '">Edit</button>';
                                                echo '<a href="appointment_confirm.php?canceledid=' . $row['appointment_id'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to cancel this appointment?\')">Cancel</a>'; 
                                            } elseif ($row['status'] == 'cancelled') {
                                                echo '<button class="btn btn-secondary btn-sm" disabled>Cancelled</button>';
                                            } elseif ($row['status'] == 'completed') {
                                                echo '<button class="btn btn-info btn-sm text-light">Completed</button>';
                                            } ?>
                                            </div>
                                           
                                        </td>
                                        <td>
                                            <div class="text-center d-flex flex-nowrap gap-2 justify-content-center">
                                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#viewAppointmentModal<?= $row['appointment_id'] ?>">View</button>
                                                <?php
                                                if ($row['status'] == 'pending') {
                                                    echo '<a href="appointment_confirm.php?confirmid=' . $row['appointment_id'] . '" class="btn btn-success btn-sm">Confirm</a>';
                                                }
                                                elseif ($row['status'] == 'confirmed') {
                                                echo '<a href="appointment_confirm.php?completeid=' . $row['appointment_id'] . '" class="btn btn-info btn-sm" onclick="return confirm(\'Are you sure you want to complete this appointment?\')">Complete</a>'; 
                                                }
                                                elseif ($row['status'] == 'cancelled') {
                                                    echo '<button class="btn btn-secondary btn-sm" disabled>Invoice</button>';
                                                }
                                                elseif ($row['status'] == 'completed') {
                                                    echo '<a href="billing.php?billingid=' . $row['appointment_id'] . '" class="btn btn-primary btn-sm"> Invoice </a>';
                                                }
                                                ?>
                                            </div>                                            
                                        </td>
                                    </tr>

                                    <?php include 'models/appointment_edit.php'; ?>
                                    <?php include 'models/appointment_view.php'; ?>

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
            </div>
            
        </div>


<?php include 'includes/footer.php'; ?>