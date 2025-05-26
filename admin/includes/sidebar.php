<div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#UserManagement" aria-expanded="false" aria-controls="UserManagement">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                User Management
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="UserManagement" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="./manageusers.php">All Users</a>
                                    <a class="nav-link" href="./managestaff.php">Staff Manage</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#appoinment" aria-expanded="false" aria-controls="UserManagement">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Appoinments
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="appoinment" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="./manageusers.php">Pending</a>
                                    <a class="nav-link" href="./managestaff.php">Confirmed</a>
                                    <a class="nav-link" href="./managestaff.php">Completed</a>
                                    <a class="nav-link" href="./managestaff.php">Cancelled</a>
                                </nav>
                            </div>
                            
                            
                            <div class="sb-sidenav-menu-heading">Addons</div>
                            
                            <a class="nav-link" href="services.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Services
                            </a>
                            <a class="nav-link" href="appointment.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Appointment
                            </a>
                        </div>
                    </div>
                    
                </nav>
            </div>