<?php
include 'includes/header.php';
include 'includes/navigation.php';
?>

<?php
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    echo "<script>alert('Please login to book an appointment.'); window.location.href='login.php';</script>";
    exit();
}
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
                                    <?php
                                    // Show name and email as readonly if user is logged in
                                    if (isset($_SESSION['user_id'])) {
                                        // Fetch user details from database
                                        $user_id = $_SESSION['user_id'];
                                        $user_sql = "SELECT full_name, email FROM users WHERE user_id = ?";
                                        $stmt = $conn->prepare($user_sql);
                                        $stmt->bind_param("i", $user_id);
                                        $stmt->execute();
                                        $stmt->bind_result($full_name, $email);
                                        $stmt->fetch();
                                        $stmt->close();
                                        ?>
                                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <input type="text" class="form-control bg-transparent" id="name" name="name" placeholder="Your Name" value="<?php echo htmlspecialchars($full_name); ?>" readonly>
                                                <label for="name">Your Name</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <input type="email" class="form-control bg-transparent" id="email" name="email" placeholder="Your Email" value="<?php echo htmlspecialchars($email); ?>" readonly>
                                                <label for="email">Your Email</label>
                                            </div>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
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
                                        <?php
                                    }
                                    ?>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="tel" class="form-control bg-transparent" id="phone" name="phone" placeholder="Your Phone">
                                            <label for="phone">Your Phone</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating position-relative">
                                            <input type="date" class="form-control bg-transparent" id="date" name="date" placeholder="Appointment Date">
                                            <label for="date">Appointment Date</label>
                                            <!-- Custom Icon (just for demonstration) -->
                                            <span onclick="document.getElementById('date').showPicker()" style="position: absolute; top: 40%; right: 10px; cursor: pointer;">
                                                📅
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-floating position-relative">
                                            <input type="time" class="form-control bg-transparent" id="time" name="time" placeholder="Appointment Time">
                                            <label for="time">Appointment Time</label>
                                            <!-- Custom Icon (just for demonstration) -->
                                            <span onclick="document.getElementById('time').showPicker()" style="position: absolute; top: 40%; right: 10px; cursor: pointer;">
                                                ⏰
                                            </span>
                                        </div>
                                    </div>

                                    <?php
                                        // Fetch staff from the database
                                        $sql = "SELECT user_id, full_name, specialization FROM users WHERE role = 'staff' AND availability = 1";
                                        $result = $conn->query($sql);
                                        ?>

                                    <div class="col-12">
                                        <div class="form-floating">
                                            <select class="form-select bg-transparent" id="barber" name="staff_id" aria-label="Select Barber">
                                                <option value="" >Not select Beautician</option>
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
                            <div class="d-flex justify-content-center flex-column">
                                <?php
                                $sql = "SELECT * FROM services ORDER BY created_at DESC";
                                $result = $conn->query($sql);
                                if ($result && $result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                                            <input type="checkbox"
                                                name="services[]"
                                                id="<?php echo htmlspecialchars($row['service_name']); ?>"
                                                value="<?php echo $row['service_id']; ?>"
                                                data-price="<?php echo htmlspecialchars($row['price']); ?>"
                                                class="service-checkbox"
                                                onchange="calculateTotal()"
                                                <?php
                                                    if (isset($_GET['select_id'])) {
                                                        $selected_ids = explode(',', $_GET['select_id']);
                                                        if (in_array($row['service_id'], $selected_ids)) {
                                                            echo 'checked';
                                                        }
                                                    }
                                                ?>
                                            >
                                            <h6 class="text-uppercase mb-0"><?php echo htmlspecialchars($row['service_name']); ?></h6>
                                            <span class="text-uppercase text-primary">LKR <?php echo number_format($row['price'], 2); ?></span>
                                        </div>
                                        <?php
                                    }
                                } else {
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
                                        total += parseFloat(cb.dataset.price);
                                    });
                                    document.getElementById('totalPrice').textContent = 'LKR ' + total.toFixed(2);
                                }

                                // Call calculateTotal on page load
                                window.addEventListener('DOMContentLoaded', (event) => {
                                    calculateTotal();
                                });
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


<?php
include 'includes/footer.php';
?>