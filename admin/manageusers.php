
<?php include 'includes/header.php'; ?>

<?php include 'includes/navigation.php'; ?>
        
        <div id="layoutSidenav">
            
            <?php include 'includes/sidebar.php'; ?>
            
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">All Users</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">admin/all usres</li>
                        </ol>
                        
                     
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="fas fa-table me-1"></i>
                                    All Users
                                </div>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">Add User</button>
                            </div>
                            
                            <div class="card-body">
                                

                            <table id="datatablesSimple">
                                <thead>
                                     <tr>
                                        <th>#</th>
                                        <th>Username</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Role</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
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
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </tfoot>
                                    <?php
                                    $sql = "SELECT * FROM users ORDER BY created_at DESC";
                                    $result = $conn->query($sql);
                                    ?>
                                <tbody>
                                    <?php if ($result->num_rows > 0): ?>
                                        <?php $i = 1; while ($row = $result->fetch_assoc()): ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo htmlspecialchars($row['username']); ?></td>
                                                <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                                <td><?php echo htmlspecialchars($row['phone']); ?></td>
                                                <td><?php echo htmlspecialchars($row['role']); ?></td>
                                                <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editUserModal<?php echo $row['user_id']; ?>">Edit</button>
                                                    <a href="delete.php?table=users&id=<?php echo $row['user_id']; ?>" 
                                                        class="btn btn-sm btn-danger" 
                                                        onclick="return confirm('Are you sure you want to delete this user?');">
                                                        Delete
                                                    </a>
                                                </td>
                                            </tr>

                                            <?php include 'models/useredit.php';?>
                                            <?php include 'models/useradd.php';?>

                                        <?php endwhile; ?>
                                    <?php else: ?>
                                        <tr><td colspan="8">No users found.</td></tr>
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

