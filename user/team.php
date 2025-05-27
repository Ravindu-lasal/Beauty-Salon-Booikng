<?php
include 'includes/header.php';
include 'includes/navigation.php';
?>


    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-3 text-white text-uppercase mb-3 animated slideInDown">Our Beautician</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center text-uppercase mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Our Beautician</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Team Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <p class="d-inline-block bg-secondary text-primary py-1 px-4">Our Beautician</p>
                <h1 class="text-uppercase">Meet Our Beautician</h1>
            </div>
            <?php
            // Connect to the database and fetch staff users
            $sql = "SELECT * FROM users WHERE role = 'staff'";
            $result = $conn->query($sql);
            ?>
            <div class="row g-4">
                <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="team-item">
                            <div class="team-img position-relative overflow-hidden">
                                <img class="img-fluid" src="./img/uploads/<?php echo htmlspecialchars($row['image_path']); ?>" alt=""
                                    onerror="this.onerror=null;this.src='img/team-4.jpg';">
                                <div class="team-social">
                                    <a class="btn btn-square" href=""><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-square" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-square" href=""><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                            <div class="bg-secondary text-center p-4">
                                <h5 class="text-uppercase"><?php echo htmlspecialchars($row['username']); ?></h5>
                                <span class="text-primary"><?php echo htmlspecialchars($row['specialization']); ?></span>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No staff members found.</p>
            <?php endif; ?>
               
            </div>
        </div>
    </div>
    <!-- Team End -->


<?php
include 'includes/footer.php';

?>