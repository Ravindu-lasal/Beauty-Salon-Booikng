<?php
include 'includes/header.php';
include 'includes/navigation.php';
?>


    <!-- Page Header Start -->
    <div class="container-fluid page-header py-1 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-3 text-white text-uppercase mb-3 animated slideInDown">Appointment</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center text-uppercase mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Appointment</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Appointment Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5" style="max-width: 600px;">
                <p class="d-inline-block bg-secondary text-primary py-1 px-4">Book Now</p>
                <h1 class="text-uppercase">Make An Appointment</h1>
            </div>
            <form action="./auth/book_appointment.php" method="POST">
                <div class="row g-5">
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                        <div class="d-flex flex-column">
                            <div class="row g-3">
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control bg-transparent" id="name" name="name" placeholder="Your Name">
                                            <label for="name">Your Name</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="email" class="form-control bg-transparent" id="email" name="email" placeholder="Your Email">
                                            <label for="email">Your Email</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="tel" class="form-control bg-transparent" id="phone" name="phone" placeholder="Your Phone">
                                            <label for="phone">Your Phone</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="date" class="form-control bg-transparent" id="date" name="date" placeholder="Appointment Date">
                                            <label for="date">Appointment Date</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="time" class="form-control bg-transparent" id="time" name="time" placeholder="Appointment Time">
                                            <label for="time">Appointment Time</label>
                                        </div>
                                    </div>
                                    <?php
                                        // Fetch staff from the database
                                        $sql = "SELECT user_id, full_name, specialization FROM users WHERE role = 'staff' AND availability = 1";
                                        $result = $conn->query($sql);
                                        ?>

                                    <div class="col-12">
                                        <div class="form-floating">
                                            <select class="form-select bg-transparent" id="barber" name="user_id" aria-label="Select Barber" required>
                                                <option selected>Not select Beautician</option>
                                                <?php while($staff = $result->fetch_assoc()) { ?>
                                                    <option value="<?php echo $staff['user_id']; ?>">
                                                        <?php echo htmlspecialchars($staff['full_name']); ?> 
                                                        <?php if (!empty($staff['specialization'])) { echo " - " . htmlspecialchars($staff['specialization']); } ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                            <label for="barber">Selected Beautician</label>
                                        </div>
                                    </div>


                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea class="form-control bg-transparent" placeholder="Leave a message here" id="message" name="message" style="height: 100px"></textarea>
                                            <label for="message">Message</label>
                                        </div>
                                    </div>
                                </div>        
                        
                        </div>
                    </div>

                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                        <div class="bg-secondary h-100 d-flex flex-column justify-content-center p-5">
                            <p class="d-inline-flex bg-dark text-primary py-1 px-4 me-auto">Services</p>
                            <h1 class="text-uppercase mb-4">Select our services</h1>
                            <div class="d-flex flex-column justify-content-center ">
                                <?php
                                $sql = "SELECT * FROM services ORDER BY created_at DESC";
                                $result = $conn->query($sql);

                                if ($result && $result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                                            <input type="checkbox" name="services[]" id="<?php echo htmlspecialchars($row['service_name']); ?>" value="<?php echo htmlspecialchars($row['price']); ?>" class="service-checkbox" onchange="calculateTotal()">
                                            <h6 class="text-uppercase mb-0"><?php echo htmlspecialchars($row['service_name']); ?></h6>
                                            <span class="text-uppercase text-primary">LKR <?php echo number_format($row['price'], 2); ?></span>
                                        </div>
                                        <?php
                                    }
                                }else {
                                    echo "<p>No services available.</p>";
                                }

                                $conn->close();
                                ?>
                                
                                <div class="d-flex justify-content-between align-items-center border-bottom py-2 mt-3">
                                    <strong>Total:</strong>
                                    <span id="totalPrice" class="text-uppercase text-primary">LKR 0.00</span>
                                </div>

                                <script>
                                function calculateTotal() {
                                    let total = 0;
                                    document.querySelectorAll('.service-checkbox:checked').forEach(function(cb) {
                                        total += parseFloat(cb.value);
                                    });
                                    document.getElementById('totalPrice').textContent = 'LKR ' + total.toFixed(2);
                                }
                                </script>
                                
                                
                            </div>
                            
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary px-5 py-3 text-uppercase">Book Appointment</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Appointment End -->







    <!-- Footer Start -->
    <div class="container-fluid bg-secondary text-light footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-4 col-md-6">
                    <h4 class="text-uppercase mb-4">Get In Touch</h4>
                    <div class="d-flex align-items-center mb-2">
                        <div class="btn-square bg-dark flex-shrink-0 me-3">
                            <span class="fa fa-map-marker-alt text-primary"></span>
                        </div>
                        <span>123 Street, New York, USA</span>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="btn-square bg-dark flex-shrink-0 me-3">
                            <span class="fa fa-phone-alt text-primary"></span>
                        </div>
                        <span>+012 345 67890</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="btn-square bg-dark flex-shrink-0 me-3">
                            <span class="fa fa-envelope-open text-primary"></span>
                        </div>
                        <span>info@example.com</span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h4 class="text-uppercase mb-4">Quick Links</h4>
                    <a class="btn btn-link" href="">About Us</a>
                    <a class="btn btn-link" href="">Contact Us</a>
                    <a class="btn btn-link" href="">Our Services</a>
                    <a class="btn btn-link" href="">Terms & Condition</a>
                    <a class="btn btn-link" href="">Support</a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h4 class="text-uppercase mb-4">Newsletter</h4>
                    <div class="position-relative mb-4">
                        <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                        <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                    </div>
                    <div class="d-flex pt-1 m-n1">
                        <a class="btn btn-lg-square btn-dark text-primary m-1" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-lg-square btn-dark text-primary m-1" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-lg-square btn-dark text-primary m-1" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-lg-square btn-dark text-primary m-1" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>