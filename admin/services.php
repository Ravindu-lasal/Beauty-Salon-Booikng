
<?php include 'includes/header.php'; ?>

<?php include 'includes/navigation.php'; ?>
        
        <div id="layoutSidenav">
            
            <?php include 'includes/sidebar.php'; ?>
            
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Services</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">admin/all usres</li>
                        </ol>
                        
                     
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="fas fa-table me-1"></i>
                                    All Services
                                </div>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addServicesModal">Add Services</button>
                            </div>
                            
                            <div class="card-body">
                                

                            <table id="datatablesSimple">
                                <thead>
                                     <tr>
                                        <th>#</th>
                                        <th>Services Name</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Durations</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                     <tr>
                                        <th>#</th>
                                        <th>Services Name</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Durations</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </tfoot>
                                    <?php
                                    $sql = "SELECT * FROM services ORDER BY created_at DESC";
                                    $result = $conn->query($sql);
                                    ?>
                                <tbody>
                                    <?php if ($result && $result->num_rows > 0): ?>
                                        <?php $i = 1; ?>
                                        <?php while ($row = $result->fetch_assoc()): ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= htmlspecialchars($row['service_name']); ?></td>
                                                <td><?= htmlspecialchars($row['description']); ?></td>
                                                <td><?= number_format($row['price'], 2); ?></td>
                                                <td><?= htmlspecialchars($row['duration_minutes']); ?> mins</td>
                                                <td><?= htmlspecialchars($row['created_at']); ?></td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editServicesModal<?php echo $row['service_id']; ?>">Update</button>
                                                   
                                                    <a href="delete.php?table=services&id=<?= $row['service_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this service?');">Delete</a>
                                                </td>

                                                <?php include 'models/servicesadd.php'; ?>
                                                <?php include 'models/servicesedit.php'; ?>
                                            </tr>
                                        <?php endwhile; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="7" class="text-center">No services found.</td>
                                        </tr>
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

