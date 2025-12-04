
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/PracticaNo9/views/styles/globalStyles.css">

    <script src="https://kit.fontawesome.com/aad8366bcb.js" crossorigin="anonymous"></script>

            <nav class="d-md-block sidebar">
                <div class="position-fixed pt-3">
                    <div class="d-flex align-items-center mb-3 text-decoration-none">
                        <img src="/PracticaNo9/resources/Medicore Logo.png" alt="" width="32" height="32" class="me-2">
                        <span class="fs-5 fw-bold text-primary-title">Medicore</span>
                    </div>
                <hr>

                <ul>
                    <!-- Dashboard - All roles -->
                    <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'admin'): ?>
                    <li class="nav-item pt-3">
                        <a href="/PracticaNo9/views/pages/admin/dashboard_admin.php" class="nav-link"><i class="fa-solid fa-house"></i>Inicio</a>
                    </li>
                    <?php elseif (isset($_SESSION['rol']) && $_SESSION['rol'] == 'doctor'): ?>
                    <li class="nav-item pt-3">
                        <a href="/PracticaNo9/views/pages/doctor/dashboard_doctor.php" class="nav-link"><i class="fa-solid fa-house"></i>Inicio</a>
                    </li>
                    <?php endif; ?>

                    <!-- Patients - Doctor, Admin and Receptionist -->
                    <?php if (isset($_SESSION['rol']) && ($_SESSION['rol'] == 'admin' || $_SESSION['rol'] == 'doctor' || $_SESSION['rol'] == 'receptionist')): ?>
                    <li class="nav-item pt-3">
                        <a href="/PracticaNo9/views/pages/doctor/patients.php" class="nav-link"><i class="fa-solid fa-hospital-user"></i>Pacientes</a>
                    </li>
                    <?php endif; ?>

                    <!-- Doctors - Admin only -->
                    <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'admin'): ?>
                    <li class="nav-item pt-3">
                        <a href="/PracticaNo9/views/pages/admin/doctors.php" class="nav-link"><i class="fa-solid fa-user-doctor"></i>Doctores</a>
                    </li>
                    <?php endif; ?>

                    <!-- Users - Admin only -->
                    <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'admin'): ?>
                    <li class="nav-item pt-3">
                        <a href="/PracticaNo9/views/pages/admin/users.php" class="nav-link"><i class="fa-solid fa-users"></i>Usuarios</a>
                    </li>
                    <?php endif; ?>

                    <!-- Specialties - Admin only -->
                    <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'admin'): ?>
                    <li class="nav-item pt-3">
                        <a href="/PracticaNo9/views/pages/admin/specialties.php" class="nav-link"><i class="fa-solid fa-book-medical"></i>Especialidades</a>
                    </li>
                    <?php endif; ?>

                    <!-- Appointments - Receptionist and Admin -->
                    <?php if (isset($_SESSION['rol']) && ($_SESSION['rol'] == 'admin' || $_SESSION['rol'] == 'receptionist')): ?>
                    <li class="nav-item pt-3">
                        <a href="/PracticaNo9/views/pages/receptionist/appointments.php" class="nav-link"><i class="fa-solid fa-calendar-check"></i>Citas médicas</a>
                    </li>
                    <?php endif; ?>

                    <!-- Fees and Payments - Receptionist and Admin -->
                    <?php if (isset($_SESSION['rol']) && ($_SESSION['rol'] == 'admin' || $_SESSION['rol'] == 'receptionist')): ?>
                    <li class="nav-item pt-3">
                        <a href="/PracticaNo9/views/pages/receptionist/fees_and_payments.php" class="nav-link"><i class="fa-solid fa-credit-card"></i>Pagos y tarifas</a>
                    </li>
                    <?php endif; ?>

                    <!-- Reports - Admin only -->
                    <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'admin'): ?>
                    <li class="nav-item pt-3">
                        <a href="#" class="nav-link"><i class="fa-solid fa-chart-bar"></i>Reportes</a>
                    </li>
                    <?php endif; ?>

                </ul>

                <hr>

                <ul>
                    <!-- Settings - All roles -->
                    <li class="nav-item mb-3">
                        <a href="#" class="nav-link"><i class="fa-solid fa-gear"></i>Configuración</a>
                    </li>
                    
                    <!-- Logout - All roles -->
                    <li class="nav-item">
                        <a href="#" id="logout" class="nav-link"><i class="fa-solid fa-right-from-bracket"></i>Cerrar sesión</a>
                    </li>
                </ul>
            </nav>

            <script src="/PracticaNo9/views/js/sidebar.js"></script>

