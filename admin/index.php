

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
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Primary Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Warning Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Success Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Danger Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area me-1"></i>
                                        Area Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Bar Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Today's Appointments
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
   
