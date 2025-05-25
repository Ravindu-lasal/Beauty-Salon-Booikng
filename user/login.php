<?php
include_once '../config/db.con.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        echo "<script>alert('Email and password are required.'); window.history.back();</script>";
    } else {
        // Get user with matching email
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            // Verify the password
            if (password_verify($password, $user['password_hash'])) {
                // Start session and set user data
                session_start();
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                // Redirect based on role
                if ($user['role'] === 'admin') {
                    echo "<script>alert('Login successful!'); window.location.href='../admin/index.php';</script>";
                } elseif ($user['role'] === 'staff') {
                    echo "<script>alert('Login successful!'); window.location.href='../admin/index.php';</script>";
                } elseif ($user['role'] === 'customer') {
                    echo "<script>alert('Login successful!'); window.location.href='../index.php';</script>";
                } else {
                    echo "<script>alert('Invalid role.'); window.history.back();</script>";
                }
            } else {
                echo "<script>alert('Invalid email or password.'); window.history.back();</script>";
            }
        } else {
            echo "<script>alert('Invalid email or password.'); window.history.back();</script>";
        }
    }
}

?>


<?php
include 'includes/header.php';
include 'includes/navigation.php';

?>



    <!-- User Login Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row justify-content-center align-items-center g-0" style="min-height: 60vh;">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="bg-secondary p-5">
                        <h1 class="text-uppercase text-center mb-4">User Login</h1>
                        <form action="" method="POST">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="email" class="form-control bg-transparent" id="email" name="email" placeholder="Your Email">
                                        <label for="email">Your Email</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="password" class="form-control bg-transparent" id="password" name="password">
                                        <label for="password">Your password</label>
                                    </div>
                                </div>
                                <div class="col-12 justify-content-between d-flex"> 
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" id="showPassword" onclick="togglePassword()">
                                        <label class="form-check-label" for="showPassword">
                                            Show your password
                                        </label>
                                    </div>
                                    <a href="register.php">Register</a>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit">Sign In</button>
                                </div>
                            </div>
                        </form>
                        <script>
                            function togglePassword() {
                                var pwd = document.getElementById("password");
                                pwd.type = pwd.type === "password" ? "text" : "password";
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- user login End -->



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