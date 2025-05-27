<?php
// Detect path
if (strpos($_SERVER['PHP_SELF'], '/user/') !== false) {
    $baseURL = '';
    $homeLink = '../index.php';
} else {
    $baseURL = 'user/';
    $homeLink = 'index.php';
}

// Detect current page (filename)
$currentPage = basename($_SERVER['PHP_SELF']); 
?>



    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-secondary navbar-dark sticky-top py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
        <a href="#" class="navbar-brand ms-4 ms-lg-0">
            <h1 class="mb-0 text-primary text-uppercase"><i class="fa fa-spa me-3"></i>LOREAL</h1>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="<?php echo $homeLink; ?>" class="nav-item nav-link <?php echo ($currentPage == 'index.php') ? 'active' : ''; ?>">Home</a>
                <a href="<?php echo $baseURL; ?>about.php" class="nav-item nav-link <?php echo ($currentPage == 'about.php') ? 'active' : ''; ?>">About</a>
                <a href="<?php echo $baseURL; ?>service.php" class="nav-item nav-link <?php echo ($currentPage == 'service.php') ? 'active' : ''; ?>">Service</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle <?php echo (in_array($currentPage, ['price.php', 'team.php', 'open.php', 'testimonial.php', '404.php', 'appointment.php'])) ? 'active' : ''; ?>" data-bs-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu m-0">
                        <a href="<?php echo $baseURL; ?>price.php" class="dropdown-item <?php echo ($currentPage == 'price.php') ? 'active' : ''; ?>">Pricing Plan</a>
                        <a href="<?php echo $baseURL; ?>team.php" class="dropdown-item <?php echo ($currentPage == 'team.php') ? 'active' : ''; ?>">Our Barber</a>
                        <a href="<?php echo $baseURL; ?>open.php" class="dropdown-item <?php echo ($currentPage == 'open.php') ? 'active' : ''; ?>">Working Hours</a>
                        <a href="<?php echo $baseURL; ?>appointment.php" class="dropdown-item <?php echo ($currentPage == 'appointment.php') ? 'active' : ''; ?>">Appointment</a>  
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <div><hr class="dropdown-divider" /></div>
                            <a href="<?php echo $baseURL; ?>../auth/logout.php" class="dropdown-item">Sign Out</a>
                        <?php endif; ?>
                        
                    </div>
                </div>
                
                <a href="<?php echo $baseURL; ?>../auth/logout.php" class="nav-item nav-link">LogOut</a>
            </div>
            <a href="<?php echo $baseURL; ?>appointment.php" class="btn btn-primary rounded-0 py-2 px-lg-4 d-none d-lg-block">Appointment<i class="fa fa-arrow-right ms-3"></i></a>
        </div>


    </nav>
    <!-- Navbar End -->