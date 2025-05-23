    <!-- Edit Modal for this User -->
                                            <div class="modal fade" id="editUserModal<?php echo $row['user_id']; ?>" tabindex="-1" aria-labelledby="editUserLabel<?php echo $row['user_id']; ?>" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form method="POST" action="./auth/useredit.php">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editUserLabel<?php echo $row['user_id']; ?>">Edit User: <?php echo htmlspecialchars($row['username']); ?></h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">

                                                                <div class="mb-3">
                                                                    <label class="form-label">Username</label>
                                                                    <input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($row['username']); ?>" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Full Name</label>
                                                                    <input type="text" name="full_name" class="form-control" value="<?php echo htmlspecialchars($row['full_name']); ?>" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Email</label>
                                                                    <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($row['email']); ?>">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Phone</label>
                                                                    <input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars($row['phone']); ?>">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Role</label>
                                                                    <select name="role" class="form-select" required>
                                                                        <option value="admin" <?php if ($row['role'] === 'admin') echo 'selected'; ?>>Admin</option>
                                                                        <option value="staff" <?php if ($row['role'] === 'staff') echo 'selected'; ?>>Staff</option>
                                                                        <option value="customer" <?php if ($row['role'] === 'customer') echo 'selected'; ?>>Customer</option>
                                                                    </select>
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