    <!-- Edit Modal for this User -->
                                            <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModal<?php echo $row['user_id']; ?>" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form method="POST" action="./auth/useradd.php">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editUserLabel">Add User:</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <div class="mb-3">
                                                                    <label class="form-label">Username</label>
                                                                    <input type="text" name="username" class="form-control" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Full Name</label>
                                                                    <input type="text" name="full_name" class="form-control" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Email</label>
                                                                    <input type="email" name="email" class="form-control" >
                                                                </div>
                                                                <div class="mb-3">
                                                                  <label for="form-label">Password</label>
                                                                  <input type="password" name="password" class="form-control" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Phone</label>
                                                                    <input type="text" name="phone" class="form-control" >
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Role</label>
                                                                    <select name="role" class="form-select" required>
                                                                        <option value="customer" selected>Customer</option>
                                                                        <option value="staff" >Staff</option>
                                                                        <option value="admin" >Admin</option>
                                                                        
                                                                        
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