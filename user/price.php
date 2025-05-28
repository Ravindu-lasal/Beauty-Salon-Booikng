
<?php
include 'includes/header.php';
include 'includes/navigation.php';
?>


    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-3 text-white text-uppercase mb-3 animated slideInDown">Pricing Plan</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center text-uppercase mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Pricing Plan</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Price Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-0">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="bg-secondary h-100 d-flex flex-column justify-content-center p-5">
                        <p class="d-inline-flex bg-dark text-primary py-1 px-4 me-auto">Price & Plan</p>
                        <h1 class="text-uppercase mb-4">Check Out Our Beautician Services And Prices</h1>
                        <div>
                        <?php
                            $sql = "SELECT * FROM services";
                            $result = $conn->query($sql);
                            if ($result && $result->num_rows > 0):
                                while ($row = $result->fetch_assoc()):
                                    $serviceName = htmlspecialchars($row['service_name']);
                                    $servicePrice = htmlspecialchars($row['price']);
                        ?>

                             <div class="d-flex justify-content-between border-bottom py-2">
                                <h6 class="text-uppercase mb-0"><?= $serviceName ?></h6>
                                <span class="text-uppercase text-primary">Rs <?= $servicePrice ?></span>
                            </div>
                        <?php
                            endwhile;
                            else:
                                echo "<p>No services found.</p>";
                            endif;
                        ?>                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <div class="h-100">
                        <img class="img-fluid h-100" src="img/open.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Price End -->


<?php
include 'includes/footer.php';
?>