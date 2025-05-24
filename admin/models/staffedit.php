<!-- Edit Modal -->
        <div class="modal fade" id="editStaffModal<?php echo $row['user_id']; ?>" tabindex="-1" aria-labelledby="editStaffModalLabel<?php echo $row['user_id']; ?>" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form method="POST" action="./auth/staffedit.auth.php" id="editStaffForm<?php echo $row['user_id']; ?>">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editStaffModalLabel<?php echo $row['user_id']; ?>">Edit Staff - <?php echo htmlspecialchars($row['full_name']); ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                              <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                            <div class="mb-3 col-md-6">
                                <label for="username<?php echo $row['user_id']; ?>" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username<?php echo $row['user_id']; ?>" name="username" value="<?php echo htmlspecialchars($row['username']); ?>" required>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="fullName<?php echo $row['user_id']; ?>" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="fullName<?php echo $row['user_id']; ?>" name="full_name" value="<?php echo htmlspecialchars($row['full_name']); ?>" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email<?php echo $row['user_id']; ?>" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email<?php echo $row['user_id']; ?>" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="phone<?php echo $row['user_id']; ?>" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="phone<?php echo $row['user_id']; ?>" name="phone" value="<?php echo htmlspecialchars($row['phone']); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="specialization<?php echo $row['user_id']; ?>" class="form-label">Specialization</label>
                                <input type="text" class="form-control" id="specialization<?php echo $row['user_id']; ?>" name="specialization" value="<?php echo htmlspecialchars($row['specialization']); ?>">
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="role<?php echo $row['user_id']; ?>" class="form-label">Role</label>
                                <select class="form-select" id="role<?php echo $row['user_id']; ?>" name="role" required>
                                    <option value="admin" <?php if ($row['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                                    <option value="staff" <?php if ($row['role'] == 'staff') echo 'selected'; ?>>Staff</option>
                                    <option value="customer" <?php if ($row['role'] == 'customer') echo 'selected'; ?>>Customer</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="availability<?php echo $row['user_id']; ?>" class="form-label">Availability</label>
                                <select class="form-select" id="availability<?php echo $row['user_id']; ?>" name="availability">
                                    <option value="1" <?php if ($row['availability']) echo 'selected'; ?>>Yes</option>
                                    <option value="0" <?php if (!$row['availability']) echo 'selected'; ?>>No</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="hireDate<?php echo $row['user_id']; ?>" class="form-label">Hire Date</label>
                                <input type="date" class="form-control" id="hireDate<?php echo $row['user_id']; ?>" name="hire_date" value="<?php echo htmlspecialchars($row['hire_date']); ?>">
                            </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>