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
                                <li class="breadcrumb-item active" aria-current="page"><span>Academic Reports</span></li>
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
                        <a href="reports_courses.php">
                            <div class="card">
                                <img src="../public/icons/courses.svg" class="card-img-top" alt="Courses">
                                <div class="card-body">
                                    <h5 class="card-title">Courses Offered</h5>
                                </div>
                            </div>
                        </a>

                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12 layout-spacing">
                        <a href="reports_academic_units.php">
                            <div class="card">
                                <img src="../public/icons/units.svg" class="card-img-top" alt="Units">
                                <div class="card-body">
                                    <h5 class="card-title">Academic Units</h5>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12 layout-spacing">
                        <a href="reports_teaching_allocations.php">
                            <div class="card">
                                <img src="../public/icons/teaching_allocation.svg"  class="card-img-top" alt="Teaching Allocations">
                                <div class="card-body">
                                    <h5 class="card-title">Teaching Allocations</h5>
                                </div>
                            </div>
                        </a>

                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12 layout-spacing">
                        <a href="reports_timetables.php">
                            <div class="card">
                                <img src="../public/icons/timetable.svg" class="card-img-top" alt="Time Table">
                                <div class="card-body">
                                    <h5 class="card-title">Timetables</h5>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12 layout-spacing">
                        <a href="reports_students_enrollments.php">
                            <div class="card">
                                <img src="../public/icons/enrollments.svg" class="card-img-top" alt="Enrollments">
                                <div class="card-body">
                                    <h5 class="card-title">Student Enrollments</h5>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12 layout-spacing">
                        <a href="reports_student_perfomances.php">
                            <div class="card">
                                <img src="../public/icons/exam.svg" class="card-img-top" alt="Exams">
                                <div class="card-body">
                                    <h5 class="card-title">Exam Performances</h5>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12 layout-spacing">
                        <a href="reports_lects.php">
                            <div class="card">
                                <img src="../public/icons/lecs.svg" class="card-img-top" alt="Lecturers">
                                <div class="card-body">
                                    <h5 class="card-title">Lecturers Records</h5>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12 layout-spacing">
                        <a href="reports_students.php">
                            <div class="card">
                                <img src="../public/icons/students.svg" class="card-img-top" alt="Students">
                                <div class="card-body">
                                    <h5 class="card-title">Students Records</h5>
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