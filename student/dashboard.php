<?php
session_start();
require_once('../config/config.php');
require_once('../config/checklogin.php');
student();
require_once('../partials/student_analytics.php');
require_once('../partials/head.php');
?>

<body>
    <!-- BEGIN LOADER -->
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    <?php require_once('../partials/admin_nav.php'); ?>
    <!--  END NAVBAR  -->

    <!--  BEGIN Breadcrumps Nav  -->
    <div class="sub-header-container">
        <header class="header navbar navbar-expand-sm">
            <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg></a>

            <ul class="navbar-nav flex-row">
                <li>
                    <div class="page-header">

                        <nav class="breadcrumb-one" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>Dashboard</span></li>
                            </ol>
                        </nav>

                    </div>
                </li>
            </ul>
        </header>
    </div>
    <!--  END Bread crupms Navbar  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        <?php require_once('../partials/student_sidebar.php'); ?>
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT PART  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="row layout-top-spacing">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 layout-spacing">
                        <a href="reports_students_enrollments.php">
                            <div class="card">
                                <img src="../public/icons/enrollments.svg" class="card-img-top" alt="Enrollments">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $enrolled; ?></h5>
                                    <h5 class="card-title">Enrolled Units</h5>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 layout-spacing">
                        <a href="fee_statements.php">
                            <div class="card">
                                <img src="../public/icons/credited.svg" class="card-img-top" alt="Credited">
                                <div class="card-body">
                                    <h5 class="card-title">Ksh <?php echo $billed; ?></h5>
                                    <h5 class="card-title">Total Billed</h5>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 layout-spacing">
                        <a href="fee_statements.php">
                            <div class="card">
                                <img src="../public/icons/debited.svg" class="card-img-top" alt="Debited">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $paid; ?></h5>
                                    <h5 class="card-title">Total Paid</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <?php require_once('../partials/footer.php'); ?>
        </div>
        <!--  END CONTENT PART  -->
    </div>
    <!-- END MAIN CONTAINER -->
    <?php require_once('../partials/scripts.php'); ?>

</body>

</html>