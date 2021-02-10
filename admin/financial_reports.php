<?php
session_start();
require_once('../config/config.php');
require_once('../config/checklogin.php');
admin_check_login();
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
                                <li class="breadcrumb-item"><a href="">Reports</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>Financial Reports</span></li>
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
        <?php require_once('../partials/admin_sidebar.php'); ?>
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT PART  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="row layout-top-spacing">


                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12 layout-spacing">
                        <a href="reports_credited_finances.php">
                            <div class="card">
                                <img src="../public/icons/credited.svg" class="card-img-top" alt="Credited">
                                <div class="card-body">
                                    <h5 class="card-title">Credited  Finances</h5>
                                </div>
                            </div>
                        </a>

                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12 layout-spacing">
                        <a href="reports_debited_finances.php">
                            <div class="card">
                                <img src="../public/icons/debited.svg" class="card-img-top" alt="Debited">
                                <div class="card-body">
                                    <h5 class="card-title">Debited Finances</h5>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12 layout-spacing">
                        <a href="reports_debited_finances.php">
                            <div class="card">
                                <img src="../public/icons/overall_payments.svg" class="card-img-top" alt="Overall Payments">
                                <div class="card-body">
                                    <h5 class="card-title">Overall Fee Payments</h5>
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