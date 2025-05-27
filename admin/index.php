<?php
require_once '../config/db.con.php';

// Count queries for all cards
$sql_counts = [
    'users' => "SELECT COUNT(*) AS total FROM users",
    'staff' => "SELECT COUNT(*) AS total FROM users WHERE role='staff'",
    'services' => "SELECT COUNT(*) AS total FROM services",
    'appointments' => "SELECT COUNT(*) AS total FROM appointments",
    'pending' => "SELECT COUNT(*) AS total FROM appointments WHERE status='pending'",
    'confirmed' => "SELECT COUNT(*) AS total FROM appointments WHERE status='confirmed'",
    'completed' => "SELECT COUNT(*) AS total FROM appointments WHERE status='completed'",
    'cancelled' => "SELECT COUNT(*) AS total FROM appointments WHERE status='cancelled'",
];

// Fetch data
$counts = [];
foreach ($sql_counts as $key => $query) {
    $result = $conn->query($query);
    if ($result) {
        $row = $result->fetch_assoc();
        $counts[$key] = $row['total'];
    } else {
        $counts[$key] = 0;
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
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                         <style>
                            .counter-card {
                                color: white;
                                border-radius: 1rem;
                                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
                                transition: transform 0.3s;
                            }
                            .counter-card:hover {
                                transform: scale(1.05);
                            }

                            /* First row: black + gradient color */
                            .counter-card-dark {
                               background: linear-gradient(135deg, #6a11cb, #2575fc);
                            }

                            /* Second row: different gradient (blue-green) */
                            .counter-card-blue-green {
                                
                                background: linear-gradient(135deg, #f8fafc, #e0eafc);
                                color: #222;
                            }

                            .counter-icon {
                                font-size: 2rem;
                                opacity: 0.8;
                            }

                            .counter-value {
                                font-size: 2.5rem;
                                font-weight: bold;
                            }
                        </style>
                        
                        
                        <div class="container my-5">
                            <div class="row">
                                <div class="col-xl-3 col-md-6">
                                    <div class="card counter-card counter-card-dark p-4 text-center mb-4">
                                        <div class="counter-icon mb-2">
                                            <i class="bi bi-bar-chart-fill"></i>
                                        </div>
                                        <div class="counter-value"><?= $counts['users'] ?></div>
                                        <div>Users Registered</div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6">
                                    <div class="card counter-card counter-card-dark p-4 text-center mb-4">
                                        <div class="counter-icon mb-2">
                                            <i class="bi bi-bar-chart-fill"></i>
                                        </div>
                                        <div class="counter-value"><?= $counts['staff'] ?></div>
                                        <div>Staff Members</div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6">
                                    <div class="card counter-card counter-card-dark p-4 text-center mb-4">
                                        <div class="counter-icon mb-2">
                                            <i class="bi bi-bar-chart-fill"></i>
                                        </div>
                                        <div class="counter-value"><?= $counts['services'] ?></div>
                                        <div>All Services</div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6">
                                    <div class="card counter-card counter-card-dark p-4 text-center mb-4">
                                        <div class="counter-icon mb-2">
                                            <i class="bi bi-bar-chart-fill"></i>
                                        </div>
                                        <div class="counter-value"><?= $counts['appointments'] ?></div>
                                        <div>All Appointments</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-3 col-md-6">
                                    <div class="card counter-card counter-card-blue-green p-4 text-center mb-4">
                                        <div class="counter-icon mb-2">
                                            <i class="bi bi-bar-chart-fill"></i>
                                        </div>
                                        <div class="counter-value"><?= $counts['pending'] ?></div>
                                        <div>Pending Appointments</div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6">
                                    <div class="card counter-card counter-card-blue-green p-4 text-center mb-4">
                                        <div class="counter-icon mb-2">
                                            <i class="bi bi-bar-chart-fill"></i>
                                        </div>
                                        <div class="counter-value"><?= $counts['confirmed'] ?></div>
                                        <div>Confirmed Appointments</div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6">
                                    <div class="card counter-card counter-card-blue-green p-4 text-center mb-4">
                                        <div class="counter-icon mb-2">
                                            <i class="bi bi-bar-chart-fill"></i>
                                        </div>
                                        <div class="counter-value"><?= $counts['completed'] ?></div>
                                        <div>Completed Appointments</div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6">
                                    <div class="card counter-card counter-card-blue-green p-4 text-center mb-4">
                                        <div class="counter-icon mb-2">
                                            <i class="bi bi-bar-chart-fill"></i>
                                        </div>
                                        <div class="counter-value"><?= $counts['cancelled'] ?></div>
                                        <div>Cancelled Appointments</div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="card mb-4 mt-3">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                <b>Today's Appointments</b>
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
                                        <th>View</th>
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
                                        <th>View</th>
                                    </tr>
                                </tfoot>

                                <?php
                                    $sql = "SELECT a.*, u.username AS customer_name, s.username AS staff_name 
                                            FROM appointments a
                                            LEFT JOIN users u ON a.user_id = u.user_id
                                            LEFT JOIN users s ON a.staff_id = s.user_id
                                            WHERE a.appointment_date = CURDATE()
                                            ORDER BY a.appointment_time ASC";

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
                                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#viewAppointmentModal<?= $row['appointment_id'] ?>">View</button>
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
   
