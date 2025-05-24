

<?php include 'includes/header.php'; ?>

<?php include 'includes/navigation.php'; ?>
        
        <div id="layoutSidenav">
            
            <?php include 'includes/sidebar.php'; ?>
            
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Staff </h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">admin/staff</li>
                        </ol>
                        
                     
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="fas fa-table me-1"></i>
                                    All Staff
                                </div>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStaffModal">Add Staff Member</button>
                            </div>

                            <div class="card-body">
                                

                            <table id="datatablesSimple" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Username</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Role</th>
                                        <th>Specialization</th>
                                        <th>Availability</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Username</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Role</th>
                                        <th>Specialization</th>
                                        <th>Availability</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>

                                <?php
                                
                                $sql = "SELECT * FROM users WHERE role = 'staff' ORDER BY created_at DESC";
                                    $result = $conn->query($sql);
                                ?>

                                <tbody>      
                                     <?php if ($result->num_rows > 0): ?>
                                        <?php $i = 1;  while ($row = $result->fetch_assoc()): ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?= htmlspecialchars($row['username']) ?></td>
                                                <td><?= htmlspecialchars($row['full_name']) ?></td>
                                                <td><?= htmlspecialchars($row['email']) ?></td>
                                                <td><?= htmlspecialchars($row['phone']) ?></td>
                                                <td><?= htmlspecialchars($row['role']) ?></td>
                                                <td><?= htmlspecialchars($row['specialization']) ?></td>
                                                <td><?= $row['availability'] ? 'Yes' : 'No' ?></td>
                                                <td>
                                                    <div class="d-flex justify-content-center align-items-center gap-1 flex-nowrap">
                                                    <button 
                                                        class="btn btn-sm btn-primary editBtn"
                                                        data-user-id="<?php echo $row['user_id']; ?>"
                                                        data-full-name="<?php echo htmlspecialchars($row['full_name']); ?>"
                                                        data-email="<?php echo htmlspecialchars($row['email']); ?>"
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#editStaffModal<?php echo $row['user_id']; ?>">
                                                        Edit
                                                    </button>

                                                    <a href="delete.php?table=users&id=<?php echo $row['user_id']; ?>" 
                                                        class="btn btn-sm btn-danger" 
                                                        onclick="return confirm('Are you sure you want to delete this user?');">
                                                        Delete
                                                    </a>
                                                    </div>
                                                </td>

                                                <?php include 'models/staffedit.php'; ?>
                                                <?php include 'models/staffadd.php'; ?>

                                             </tr>
                                        <?php endwhile; ?>
                                    <?php else: ?>
                                        <tr><td colspan="10">No staff found.</td></tr>
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