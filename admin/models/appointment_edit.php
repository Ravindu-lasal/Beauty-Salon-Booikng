<div class="modal fade" id="editAppointmentModal<?= $row['appointment_id'] ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $row['appointment_id'] ?>" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="./auth/appointment_update.auth.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Update Appointment #<?= $row['appointment_id'] ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="location.reload()"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-4 align-items-start">
                        <!-- Left Column -->
                        <div class="col-md-6 border-end pe-md-4 mb-3 mb-md-0">
                            <h6 class="mb-3">Appointment Details</h6>
                            <div class="row gy-2">
                                <div class="col-12 border mt-2 bg-light p-2">
                                    <strong>Customer:</strong><br>
                                    <?= htmlspecialchars($row['customer_name']) ?>
                                </div>
                                <div class="col-4 border mt-2 bg-light p-2">
                                    <strong>Date:</strong><br>
                                    <?= htmlspecialchars($row['appointment_date']) ?>
                                </div>
                                <div class="col-4 border mt-2 bg-light p-2">
                                    <strong>Time:</strong><br>
                                    <?= htmlspecialchars($row['appointment_time']) ?>
                                </div>
                                <div class="col-4 border mt-2 bg-light p-2">
                                    <strong>Status:</strong><br>
                                    <?php
                                        if ($row['status'] == 'pending') {
                                            echo '<span class="badge bg-warning">Pending</span>';
                                        } elseif ($row['status'] == 'confirmed') {
                                            echo '<span class="badge bg-success">Confirmed</span>';
                                        } elseif ($row['status'] == 'cancelled') {
                                            echo '<span class="badge bg-danger">Cancelled</span>';
                                        } elseif ($row['status'] == 'completed') {
                                            echo '<span class="badge bg-info">Completed</span>';
                                        } else {
                                            echo htmlspecialchars($row['status']);
                                        }
                                    ?>
                                </div>
                                <div class="col-12 border mt-2 bg-light p-2">
                                    <strong>Staff Member:</strong><br>
                                    <?= htmlspecialchars($row['staff_name'] ?? 'Unassigned') ?>
                                </div>
                                <div class="col-12 border mt-2 bg-light p-2">
                                    <strong>Message:</strong><br>
                                    <?= htmlspecialchars($row['notes']) ?>
                                </div>
                                <div class="col-12 border mt-2 bg-light p-2">
                                    <strong>Created At:</strong><br>
                                    <?= htmlspecialchars($row['created_at']) ?>
                                </div>
                                
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-md-6 ps-md-4">
                            
                                <input type="hidden" name="appointment_id" value="<?= $row['appointment_id'] ?>">
                                <div class="mb-3">
                                    <label for="staffSelect<?= $row['appointment_id'] ?>" class="form-label">Assign Staff</label>
                                    <select id="staffSelect<?= $row['appointment_id'] ?>" name="staff_id" class="form-select">
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
                                </div>

                                <div class="mb-3">
                                    <h6>Select Services</h6>
                                    <?php
                                    $services_result = $conn->query("SELECT service_id, service_name, price FROM services");
                                    $selected_result = $conn->query("SELECT service_id FROM appointment_services WHERE appointment_id=" . $row['appointment_id']);
                                    $selected_services = [];
                                    while($sel = $selected_result->fetch_assoc()) {
                                        $selected_services[] = $sel['service_id'];
                                    }
                                    while($service = $services_result->fetch_assoc()):
                                    ?>
                                        <div class="form-check d-flex justify-content-between align-items-center mb-1">
                                            <div>
                                                <input class="form-check-input service-checkbox-<?= $row['appointment_id'] ?>" 
                                                    type="checkbox" name="services[]" 
                                                    value="<?= $service['service_id'] ?>" 
                                                    data-price="<?= $service['price'] ?>"
                                                    <?= in_array($service['service_id'], $selected_services) ? 'checked' : '' ?>
                                                    onchange="calculateTotal<?= $row['appointment_id'] ?>()">
                                                <label class="form-check-label">
                                                    <?= htmlspecialchars($service['service_name']) ?>
                                                </label>
                                            </div>
                                            
                                            <span class="ms-2"><?= number_format($service['price'], 2) ?></span>
                                            
                                        </div>
                                    <?php endwhile; ?>
                                    <div class="col-12 mt-6 border bg-light d-flex justify-content-between align-items-center my-3 p-1">
                                        <h6>Total Price: </h6>
                                        <span id="totalPrice<?= $row['appointment_id'] ?>">LKR 0.00</span>
                                    </div>
                                </div>
                           
                            

                            <script>
                                function calculateTotal<?= $row['appointment_id'] ?>() {
                                    let total = 0;
                                    document.querySelectorAll('.service-checkbox-<?= $row['appointment_id'] ?>:checked').forEach(function(cb) {
                                        total += parseFloat(cb.getAttribute('data-price')) || 0;
                                    });
                                    document.getElementById('totalPrice<?= $row['appointment_id'] ?>').textContent = 'LKR ' + total.toFixed(2);
                                }
                                window.addEventListener('DOMContentLoaded', (event) => {
                                    calculateTotal<?= $row['appointment_id'] ?>();
                                });
                            </script>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="location.reload();">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>