<?php
include 'includes/header.php';
include 'includes/navigation.php';
?>


    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-3 text-white text-uppercase mb-3 animated slideInDown">Service</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center text-uppercase mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Service</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <p class="d-inline-block bg-secondary text-primary py-1 px-4">Services</p>
                <h1 class="text-uppercase">What We Provide</h1>
            </div>
            <div class="row g-4">
                <?php
 
                    $sql = "SELECT * FROM services ORDER BY created_at DESC";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="service-item position-relative overflow-hidden bg-secondary d-flex h-100 p-5 ps-0">
                                    <div class="bg-dark d-flex flex-shrink-0 align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                        <img class="img-fluid rounded-circle" src="./img/services.png" alt="<?php echo htmlspecialchars($row['service_name']); ?>">
                                    </div>
                                    <div class="ps-4">
                                        <h3 class="text-uppercase mb-3"><?php echo htmlspecialchars($row['service_name']); ?></h3>
                                        <p><?php echo htmlspecialchars($row['description']); ?></p>
                                        <span class="text-uppercase text-primary">From LKR <?php echo number_format($row['price'], 2); ?></span>
                                    </div>
                                    <a class="btn btn-square" href="./appointment.php?select_id=<?php echo($row['service_id'])?>"><i class="fa fa-plus text-primary"></i></a>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo "<p>No services available.</p>";
                    }

                    $conn->close();
                ?>
                
            </div>
        </div>
    </div>
    <!-- Service End -->


<?php include './includes/footer.php'?>