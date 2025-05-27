<?php
    $current_page = basename($_SERVER['PHP_SELF']);
?>
<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>" href="index.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Interface</div>
                
                <?php
                    // User Management
                    $user_pages = ['manageusers.php', 'managestaff.php'];
                    $user_active = in_array($current_page, $user_pages) ? 'active' : '';
                    $user_show = in_array($current_page, $user_pages) ? 'show' : '';
                ?>
                <a class="nav-link collapsed <?php echo $user_active; ?>" href="#" data-bs-toggle="collapse" data-bs-target="#UserManagement" aria-expanded="<?php echo $user_active ? 'true' : 'false'; ?>" aria-controls="UserManagement">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    User Management
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse <?php echo $user_show; ?>" id="UserManagement" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link <?php echo ($current_page == 'manageusers.php') ? 'active' : ''; ?>" href="./manageusers.php">All Users</a>
                        <a class="nav-link <?php echo ($current_page == 'managestaff.php') ? 'active' : ''; ?>"  href="./managestaff.php">Staff Manage</a>
                    </nav>
                </div>

                <?php
                    // Appointments
                    $app_pages = [
                        'appointment_pending.php',
                        'appointment_confirm.php',
                        'appointment_complete.php',
                        'appointment_cancelled.php'
                    ];
                    $app_active = in_array($current_page, $app_pages) ? 'active' : '';
                    $app_show = in_array($current_page, $app_pages) ? 'show' : '';
                ?>
                <a class="nav-link collapsed <?php echo $app_active; ?>" href="#" data-bs-toggle="collapse" data-bs-target="#appoinment" aria-expanded="<?php echo $app_active ? 'true' : 'false'; ?>" aria-controls="appoinment">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Appoinments
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse <?php echo $app_show; ?>" id="appoinment" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link <?php echo ($current_page == 'appointment_pending.php') ? 'active' : ''; ?>" href="./appointment_pending.php">Pending</a>
                        <a class="nav-link <?php echo ($current_page == 'appointment_confirm.php') ? 'active' : ''; ?>" href="./appointment_confirm.php">Confirmed</a>
                        <a class="nav-link <?php echo ($current_page == 'appointment_complete.php') ? 'active' : ''; ?>" href="./appointment_complete.php">Completed</a>
                        <a class="nav-link <?php echo ($current_page == 'appointment_cancelled.php') ? 'active' : ''; ?>" href="./appointment_cancelled.php">Cancelled</a>
                    </nav>
                </div>
                
                <div class="sb-sidenav-menu-heading">Addons</div>
                
                <a class="nav-link <?php echo ($current_page == 'services.php') ? 'active' : ''; ?>" href="services.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Services
                </a>
                <a class="nav-link <?php echo ($current_page == 'appointment.php') ? 'active' : ''; ?>" href="appointment.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Appointment
                </a>
            </div>
        </div>
    </nav>
</div>