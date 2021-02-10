<?php
session_start();
require_once '../config/config.php';
require_once '../config/checklogin.php';
admin_check_login();

require_once '../partials/head.php';
?>

<body>

    <!--  BEGIN NAVBAR  -->
    <?php require_once '../partials/admin_nav.php'; ?>
    <!--  END NAVBAR  -->

    <!--  BEGIN NAVBAR  -->
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
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="dashboard.php">Reports</a></li>
                                <li class="breadcrumb-item"><a href="academic_reports.php">Academic Reports</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>Lecturers Report</span></li>
                                </ol>
                        </nav>

                    </div>
                </li>
            </ul>
        </header>
    </div>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        <?php require_once '../partials/admin_sidebar.php'; ?>
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="row layout-top-spacing">
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                           
                            <hr>
                          

                            <div class="table-responsive mb-4 mt-4">
                                <table id="export" class="table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Number</th>
                                            <th>Name</th>
                                            <th>ID No</th>
                                            <th>Phone Number</th>
                                            <th>Email</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $ret =
                                            'SELECT * FROM `iCollege_lecturers`';
                                        $stmt = $mysqli->prepare($ret);
                                        $stmt->execute(); //ok
                                        $res = $stmt->get_result();
                                        while ($lec = $res->fetch_object()) { ?>
                                            <tr>
                                                <td><?php echo $lec->number; ?></td>
                                                <td><?php echo $lec->name; ?></td>
                                                <td><?php echo $lec->idno; ?></td>
                                                <td><?php echo $lec->phone; ?></td>
                                                <td><?php echo $lec->email; ?></td>
                                               
                                            </tr>
                                        <?php }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php require_once '../partials/footer.php'; ?>
        </div>
        <!--  END CONTENT AREA  -->
    </div>
    <!-- END MAIN CONTAINER -->
    <?php require_once '../partials/scripts.php'; ?>
</body>

</html>